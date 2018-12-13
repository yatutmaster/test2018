<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "notes".
 *
 * @property int $id
 * @property string $title
 * @property int $status
 */
class Notes extends \yii\db\ActiveRecord
{
    const ACTIVE_NOTE = 1;
    
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'notes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['status','id'], 'integer'],
            [['status','id'], 'integer','on' => self::ACTIVE_NOTE],
            [['status','id'], 'required', 'on' => self::ACTIVE_NOTE],
            [['id'], 'exist', 'on' => self::ACTIVE_NOTE],
            [['status'],'integer', 'min' => 0, 'max' => 1, 'on' => self::ACTIVE_NOTE],
            [['title'], 'string', 'max' => 50],
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::ACTIVE_NOTE] = ['id', 'status'];
        return $scenarios;
    }
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Записи',
            'status' => 'Status',
        ];
    }


    public function setNote()
    {

        $this->status = self::ACTIVE_NOTE;
        $this->save();


    }
    public function updateNote()
    {

        $note = self::findOne($this->id);
        $note->status = $this->status;
        return $note->save();

    }

}
