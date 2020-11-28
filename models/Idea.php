<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "idea".
 *
 * @property int $id
 * @property string $name
 * @property string $opis
 */
class Idea extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'idea';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'opis'], 'required'],
            [['opis'], 'string'],
            [['name'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'opis' => 'Описание',
        ];
    }
}
