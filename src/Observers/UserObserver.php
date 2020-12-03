<?php

namespace Agenciafmd\Admix\Observers;

use Agenciafmd\Admix\Models\User;

class UserObserver
{
    public function saved(User $user)
    {
        $this->media($user);
    }

    private function media($model)
    {
        $request = request();

        if (!$request->media) {
            return false;
        }

        foreach ($request->media as $media) {
            if (is_array($media['collection'])) {
                $collection = reset($media['collection']);
                $file = storage_path('admix/tmp') . "/" . reset($media['name']);

                $model->doUploadMultiple($file, $collection);

            } else {
                $collection = $media['collection'];
                $file = storage_path('admix/tmp') . "/{$media['name']}";

                $model->doUpload($file, $collection);
            }
        }

        return true;
    }
}