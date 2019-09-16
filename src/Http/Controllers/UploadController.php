<?php

namespace Agenciafmd\Admix\Http\Controllers;

use App\Http\Controllers\Controller;
use Collective\Html\FormFacade as Form;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\Models\Media;

class UploadController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->hasFile('file')) {
            return [
                'status' => 'error',
            ];
        }

        $files = $request->file('file');

        if (!is_array($files)) {
            $files = [
                $files,
            ];
        }

        $tmpPath = storage_path('admix/tmp');
        @mkdir($tmpPath, 0775, true);

        $response = [];
        foreach ($files as $file) {
            $fileInfo = pathinfo($file->getClientOriginalName());
            $fileName = Str::slug(Str::limit($fileInfo['filename'], 50, '') . '-' . rand(1, 999)) . '.' . $file->getClientOriginalExtension();
            $file->move($tmpPath, $fileName);

            $response[] = [
                'status' => 'success',
                'name' => $fileName,
                'collection' => $request->get('collection'),
                'uuid' => uniqid(),
            ];
        }

        return $response;
    }

    public function destroy(Request $request)
    {
        if (Media::where('custom_properties->uuid', $request->get('key'))
            ->first()
            ->delete()) {
            return [];
        }

        return [
            'message' => 'A imagem não pode ser apagada',
        ];
    }

    public function metaForm($uuid)
    {
        $media = Media::where('custom_properties->uuid', $uuid)
            ->first();

        $html = Form::open(['route' => ['admix.upload.meta.post', $uuid], 'id' => 'formUploadMetaPost']);

        try {
            foreach (app()->make('languages') as $k => $language) {
                $html .= Form::bsText($language->name, 'meta[' . $language->locale . ']', ($media->getCustomProperty("meta.{$language->locale}")) ?? null);
            }
        } catch (\Exception $e) {
            $html .= Form::bsText('Descrição', 'meta[' . app()->getLocale() . ']', ($media->getCustomProperty("meta." . app()->getLocale())) ?? null);
        }

        $html .= Form::close();

        return $html;
    }

    public function metaPost($uuid)
    {
        $media = Media::where('custom_properties->uuid', $uuid)
            ->first();
        $media->setCustomProperty('meta', request()->get('meta', ''));
        $media->save();
    }

    public function sort()
    {
        $images = request('stack');

        foreach ($images as $order => $image) {
            Media::whereJsonContains('custom_properties->uuid', $image['key'])
                ->update([
                    'order_column' => $order,
                ]);
        }
    }

    public function medium()
    {
        $file = request()->get('file');

        $fileinfo = explode(";base64,", $file);
        $extention = strtolower(str_replace('data:image/', '', $fileinfo[0]));

        if (!in_array($extention, $this->allowedExtentions())) {
            return '';
        }

        $file = str_replace(' ', '+', $fileinfo[1]);
        $filename = 'editor/' . date('Y/m/') . time() . '.' . $extention;

        Storage::put($filename, base64_decode($file), 'public');

        return Storage::url($filename);
    }

    private function allowedExtentions()
    {
        return [
            'png',
            'jpg',
            'jpeg',
            'webpg',
        ];
    }
}