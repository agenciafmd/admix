<?php

namespace Agenciafmd\Admix\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\Models\Media;
use Collective\Html\FormFacade as Form;

class UploadController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->hasFile('file')) {
            return [
                'status' => 'error'
            ];
        }

        $file = $request->file('file');

        $tmpPath = storage_path('admix/tmp');
        @mkdir($tmpPath, 0775, true);

        $fileInfo = pathinfo($file->getClientOriginalName());
        $fileName = Str::slug(Str::limit($fileInfo['filename'], 50, '') . '-' . rand(1, 999)) . '.' . $file->getClientOriginalExtension();
        $file->move($tmpPath, $fileName);

        return [
            'status' => 'success',
            'name' => $fileName,
            'collection' => $request->get('collection'),
            'uuid' => uniqid()
        ];
    }

    public function destroy(Request $request)
    {
        if (Media::where('custom_properties->uuid', $request->get('key'))
            ->first()
            ->delete()) {
            return [];
        }

        return [
            'message' => 'A imagem não pode ser apagada'
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
        $media = Media::where('custom_properties->uuid', $uuid)->first();
        $media->setCustomProperty('meta', request()->get('meta', ''));
        $media->save();
    }

//    public function sort()
//    {
//        $images = request('stack');
//
//        foreach ($images as $order => $image) {
//            Media::where('uuid', $image['key'])
//                ->update([
//                    'order' => $order,
//                ]);
//        }
//
//        Media::first()
//            ->touch();
//    }
}