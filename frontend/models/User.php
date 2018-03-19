<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 21.01.17
 * Time: 16:31
 */

namespace frontend\models;


class User extends \common\models\User
{
    public $orderid;
    public $operation_id;
    public $cookie;
    public function rules()
    {
        return [
            [['name'], 'required','message' => 'укажите пожалуйста свое имя'],
            [['famaly'], 'required','message' => 'укажите пожалуйста свое фамилию'],
            [['tel'], 'required','message' => 'укажите пожалуйста свой телефон'],
            [['email'], 'required','message' => 'укажите пожалуйста свой email'],
            [['created_at', 'updated_at'], 'integer'],
            [['name', 'tel', 'cookie','adress'], 'string', 'max' => 510],
            [['email','famaly','officeNewPost','sity'], 'string', 'max' => 255],
        ];
    }
}