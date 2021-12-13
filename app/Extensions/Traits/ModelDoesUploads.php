<?php

namespace App\Extensions\Traits;


use App\Extensions\Utils\UploadManager;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Schema;

/**
 * @property string[] $uploadable attributes that are uploadable
 */
trait ModelDoesUploads
{

//    private $uploadable = [];


    public static function bootModelDoesUploads()
    {
        static::saving(function (Model $model) {
            static::doUpload($model);
        });
    }

    private static function doUpload(Model $model): void
    {
        if (!empty($model->uploadable)) {
            foreach ($model->uploadable as $uploadable_field) {
                if (request()->hasFile($uploadable_field)) {
                    $file = request()->file($uploadable_field);
                    $upload_path = UploadManager::init()->saveFile($file);
                    $model->setAttribute($uploadable_field, $upload_path);

                    if (Schema::hasColumn($model->getTable(), 'filename')) {
                        $filename = $file->getClientOriginalName();
                        $model->setAttribute('filename', $filename);
                    }
                } elseif ($model->$uploadable_field instanceof UploadedFile) {
                    $upload_path = UploadManager::init()->saveFile($model->$uploadable_field);

                    if (Schema::hasColumn($model->getTable(), 'filename')) {
                        $filename = $model->$uploadable_field->getClientOriginalName();
                        $model->setAttribute('filename', $filename);
                    }
                    $model->setAttribute($uploadable_field, $upload_path);
                }
            }
        }
    }

}
