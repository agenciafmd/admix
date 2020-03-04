<?php

namespace Agenciafmd\Admix\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\Models\Media;

class UploadController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->hasFile('file')) {
            return response('Arquivo não recebido', 400);
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

        $modelName = strtolower(class_basename($media->model_type));
        $collectionName = $media->collection_name;

        $html = '<form method="POST" action="' . route('admix.upload.meta.post', $uuid) . '" accept-charset="UTF-8" id="formUploadMetaPost" onsubmit="return event.preventDefault();">';
        $html .= '<input name="_token" type="hidden" value="' . csrf_token() . '">';

        if (config("upload-configs.{$modelName}.{$collectionName}.meta")) {
            foreach (config("upload-configs.{$modelName}.{$collectionName}.meta") as $field) {
                $html .= '<li class="list-group-item mb-4">
                        <div class="row gutters-sm">
                            <label for="Descrição" class="col-xl-3 col-form-label pt-0 pt-xl-2">' . ucfirst($field['label']) . '</label>
                            <div class="col-xl-5">';
                if (isset($field['options']) && is_array($field['options'])) {
                    $html .= '<select class="form-control" name="meta[' . $field['name'] . ']">
                        <option value="">-</option>';
                    foreach ($field['options'] as $option) {
                        $html .= '<option value="' . $option . '" ' . (($media->getCustomProperty("meta." . $field['name']) == $option) ? 'selected' : '') . '>' . $option . '</option>';
                    }
                    $html .= '</select>';
                } else {
                    $html .= '<input class="form-control" name="meta[' . $field['name'] . ']" type="text" value="' . (($media->getCustomProperty("meta." . $field['name'])) ?? '') . '">';
                }

                $html .= '
                                <div class="invalid-feedback">
                                    o campo ' . strtolower($field['label']) . ' é obrigatório
                                </div>
                            </div>
                        </div>
                    </li>';
            }
        } else {
            try {
                foreach (app()->make('languages') as $k => $language) {
                    $html .= '<li class="list-group-item">
                        <div class="row gutters-sm">
                            <label for="' . $language->name . '" class="col-xl-3 col-form-label pt-0 pt-xl-2">' . $language->name . '</label>
                            <div class="col-xl-5">
                                <input class="form-control" name="meta[' . $language->locale . ']" type="text" value="' . (($media->getCustomProperty("meta.{$language->locale}")) ?? '') . '">
                                <div class="invalid-feedback">
                                    o campo ' . strtolower($language->name) . ' é obrigatório
                                </div>
                            </div>
                        </div>
                    </li>';
                }
            } catch (\Exception $e) {
                $html .= '<li class="list-group-item">
                        <div class="row gutters-sm">
                            <label for="Descrição" class="col-xl-3 col-form-label pt-0 pt-xl-2">Descrição</label>
                            <div class="col-xl-5">
                                <input class="form-control" name="meta[' . app()->getLocale() . ']" type="text" value="' . (($media->getCustomProperty("meta." . app()->getLocale())) ?? '') . '">
                                <div class="invalid-feedback">
                                    o campo descrição é obrigatório
                                </div>
                            </div>
                        </div>
                    </li>';
            }
        }

        $html .= '</form>';

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
