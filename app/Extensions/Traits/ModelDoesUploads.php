<?php

namespace App\Extensions\Traits;


use App\Extensions\Utils\UploadManager;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

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

    private static function doUpload(Model $model)
    {
        if (!empty($model->uploadable)) {
            foreach ($model->uploadable as $uploadable_field) {
                if (request()->hasFile($uploadable_field)) {
                    $upload_path = UploadManager::init()->saveFile(request()->file($uploadable_field));

                    $model->setAttribute($uploadable_field, $upload_path);
                } elseif ($model->$uploadable_field instanceof UploadedFile) {
                    $upload_path = UploadManager::init()->saveFile($model->$uploadable_field);

                    $model->setAttribute($uploadable_field, $upload_path);
                }
            }
        }
    }

}
