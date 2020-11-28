<?php

namespace app\modules\file\models;

use Yii;
use yii\behaviors\SluggableBehavior;
use app\behaviors\SeoBehavior;
use app\behaviors\SortableModel;

/**
 * This is the model class for table "igor_files".
 *
 * @property int $file_id
 * @property string $title
 * @property string $file
 * @property string $mime_type
 * @property int|null $playtime
 * @property int $size
 * @property string|null $slug
 * @property int|null $downloads
 * @property int|null $time
 * @property int|null $order_num
 * @property int $status
 */
class File extends \app\components\ActiveRecord
{
    /**
     * {@inheritdoc}
     */

    public static function tableName()
    {
        return 'igor_files';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [

            [['file'], 'file', 'extensions' => 'png, jpg, mp4'],
            ['title', 'required'],
            ['title', 'string', 'max' => 128],
            ['mime_type', 'string', 'max' => 255],
            [['playtime'], 'integer'],
            ['title', 'trim'],
            ['slug', 'match', 'pattern' => self::$SLUG_PATTERN, 'message' => 'Slug can contain only 0-9, a-z and "-" characters (max: 128).'],
            ['slug', 'default', 'value' => null],
            [['downloads', 'size'], 'integer'],
            ['time', 'default', 'value' => time()]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'file_id' => 'File ID',
            'title' => 'Название',
            'file' => 'File',
            'size' => 'Size',
            'slug' => 'Slug',
            'playtime'=>'Время показа',
            'mime_type'=>'mime_type',
            'downloads' => 'Downloads',
            'time' => 'Time',
            'order_num' => 'Order Num',
            'status' => 'Status',
        ];
    }
    public function behaviors()
    {
        return [
            SortableModel::className(),
            'seoBehavior' => SeoBehavior::className(),
            'sluggable' => [
                'class' => SluggableBehavior::className(),
                'attribute' => 'title',
                'ensureUnique' => true
            ]
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if(!$insert && $this->file !== $this->oldAttributes['file']){
                @unlink(Yii::getAlias('@webroot').$this->oldAttributes['file']);
            }
            return true;
        } else {
            return false;
        }
    }

    public function afterDelete()
    {
        parent::afterDelete();

        @unlink(Yii::getAlias('@webroot').$this->file);
    }
}
