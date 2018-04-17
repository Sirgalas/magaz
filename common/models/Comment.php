<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "abh_commentsystem".
 *
 * @property integer $id
 * @property string $text
 * @property string $title
 * @property integer $created_at
 * @property integer $public
 * @property integer $what
 * @property integer $id_gods
 * @property integer $ratind_id
 * @property integer $user_id
 */
class Comment extends \yii\db\ActiveRecord
{
    public $strtotimes;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'abh_commentsystem';
    }

    public function getRating(){
        return $this->hasOne(Rating::className(),['id'=>'ratind_id']);
    }

    public function getUser(){
        return $this->hasOne(User::className(),['id'=>'user_id']);
    }
    public function getGods(){
        return $this->hasOne(Gods::className(),['id'=>'id_gods']);
    }

    public function getGoods($id_goods){
        $goods=Gods::findOne($id_goods);
        if(isset($goods)) {
            return $goods->title;
        }else{
            return false;
        }
    }
    public function getUsers($user_id){
        $user=User::findOne($user_id);
        return $user->username;
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at', 'user_id',], 'required'],
            [['created_at', 'public', 'what', 'id_gods', 'ratind_id', 'user_id'], 'integer'],
            [['text', 'title'], 'string', 'max' => 510],
            [['strtotimes'],'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'text' => Yii::t('backend','TEXT_COMMENT'),
            'title' => Yii::t('backend','TITLE_COMMENT'),
            'created_at' => Yii::t('backend','CREATE_AT'),
            'public' => Yii::t('backend','PUBLIC'),
            'what' => Yii::t('backend','WHAT'),
            'id_gods' => Yii::t('backend','THE_GOODS'),
            'ratind_id' => 'Ratind ID',
            'user_id' => Yii::t('backend','THE_USER'),
        ];
    }
}
