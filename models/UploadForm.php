<?php
/**
 * Created by PhpStorm.
 * User: pipeda
 * Date: 28.11.2020
 * Time: 20:51
 *
 */
namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model
{
    public $file;
    public $name;
    public function rules()
    {
        return [
            [['file'], 'file', 'maxFiles' => 10],
        ];
    }
    public function attributeLabels()
    {
        return [
            'name' => 'Название',
            'file'=>  'Файл'
        ];
    }
}
