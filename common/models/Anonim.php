<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "abh_anonim".
 *
 * @property integer $id
 * @property string $name
 * @property string $tel
 * @property string $email
 * @property string $cookie
 * @property integer $created_at
 * @property integer $update_at
 */
class Anonim extends \yii\db\ActiveRecord
{

    public $orderid;
    public $operation_id;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'abh_anonim';
    }

    const SCENARIO_ALL = 'create';
    const SCENARIO_REQUIRE = 'createrequired';

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_ALL] = ['cookie', 'created_at'];
        $scenarios[self::SCENARIO_REQUIRE] = ['cookie', 'created_at','name','famaly','tel','email'];
        return $scenarios;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cookie', 'created_at'], 'required'],
            [['name'], 'required','message' => 'укажите пожалуйста свое имя'],
            [['famaly'], 'required','message' => 'укажите пожалуйста свое фамилию'],
            [['tel'], 'required','message' => 'укажите пожалуйста свой телефон'],
            [['email'], 'required','message' => 'укажите пожалуйста свой email'],
            [['created_at', 'update_at'], 'integer'],
            [['name', 'tel', 'cookie'], 'string', 'max' => 510],
            [['email','famaly','officeNewPost','sity'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'tel' => 'Tel',
            'email' => 'Email',
            'cookie' => 'Cookie',
            'created_at' => 'Created At',
            'update_at' => 'Update At',
        ];
    }
}
