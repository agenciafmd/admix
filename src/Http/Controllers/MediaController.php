<?php

namespace Agenciafmd\Admix\Http\Controllers;

use League\Glide\ServerFactory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use League\Glide\Responses\LaravelResponseFactory;

class MediaController extends Controller
{
    public function show($path)
    {
        //http://glide.thephpleague.com/1.0/api/quick-reference/
        //media/c4/ca/42/irineu-junior-qnljj.jpeg?w=500&h=300&fit=crop&q=85
        //media/1/w.300/h.300/q.80/fit.crop/fm.pjpg/d34cc023-61f3-3aa1-998b-7f7bb5fdd53a.png

        $filename = basename($path);
        $params = explode('/', dirname($path));

        $options = [];
        $folders = [];
        foreach ($params as $param) {
            if (strstr($param, '.')) {
                $boom = explode('.', $param);
                $options[$boom[0]] = $boom[1];
            } else {
                $folders[] = $param;
            }
        }

        $basePath = implode('/', $folders) . '/' . $filename;

        $server = ServerFactory::create([
            'response' => new LaravelResponseFactory(app('request')),
            'source' => Storage::disk('public')->getDriver(),
            'cache' => Storage::disk('local')->getDriver(),
            'cache_path_prefix' => '.cache',
            //'group_cache_in_folders' => false
        ]);

        @mkdir(public_path('media/') . dirname($path), 0775, true);

        try {
            $imagePath = $server->makeImage($basePath, $options);
            $imageBase = $server->getCache()->read($imagePath);
            file_put_contents(public_path("media/{$path}"), $imageBase);

            return $server->getImageResponse($basePath, $options);
        }
        catch (\Exception $exception) {
            $basePath = 'image-placeholder.gif';
            $imagePath = $server->makeImage($basePath, $options);
            $imageBase = $server->getCache()->read($imagePath);
            file_put_contents(public_path("media/{$path}"), $imageBase);

            return $server->getImageResponse($basePath, $options);
        }
    }
}
