<?php
namespace frontend\controllers;

use dektrium\user\Finder;
use dektrium\user\models\Profile;
use dektrium\user\models\SettingsForm;
use dektrium\user\models\User;
use dektrium\user\Module;
use dektrium\user\traits\AjaxValidationTrait;
use dektrium\user\traits\EventTrait;
use dektrium\user\controllers\SettingsController as BaseSettingsController;
use common\models\Adduserfeild;
use common\models\Image;
use yii\web\UploadedFile;
use backend\models\Imageresize;
use backend\models\Translit;
use Yii;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
class SettingsController extends BaseSettingsController{
    public function actionProfile()
    {
        $model=User::findOne(Yii::$app->user->id);
        if(empty($model)){
        $model = new User();}
        $imageModel=new Image();
        $transliterator= new Translit();
        $imagine= new Imageresize();
        $basepath='user/'.date('Y').'/'.date('m').'/';
        if (Yii::$app->request->isAjax) {
            $fileName = 'file';
            $uploadPath =Yii::getAlias('@frontend/web/image/').$basepath;
            if (isset($_FILES[$fileName])) {
                if (file_exists($uploadPath)) {
                } else {
                    mkdir($uploadPath, 0775, true);
                }
                $file = \yii\web\UploadedFile::getInstanceByName($fileName);
                $filenames=$transliterator->traranslitImg($file);
                if ($file->saveAs($uploadPath . '/' . $filenames)) {
                    $imagine->imagerisizeUser($uploadPath,$filenames,$file);
                    return $this->render('profile', [
                        'model'     => $model,
                    ]);
                }
            }
        }
        if($model->load(Yii::$app->request->post())){
            $profuser=Yii::$app->request->post('User');
            if(isset($profuser['avatar'])) {
                if ($model->avatar != $profuser['avatar']) {
                    $filenames = $transliterator->traranslitImg($profuser['avatar']);
                    $model->avatar = $basepath . '' . $filenames;
                }
            }
            if(isset($profuser['name'])) {
                if ($model->name != $profuser['name']) {
                    $model->name = $profuser['name'];
                }
            }
            if(isset($profuser['addres'])) {
                if ($model->addres != $profuser['addres']) {
                    $model->addres = $profuser['addres'];
                }
            }
            if(isset($profuser['tel'])) {
                if ($model->tel != $profuser['tel']) {
                    $model->tel = $profuser['tel'];
                }
            }
            if(isset($profuser['email'])) {
                if ($model->email != $profuser['email']) {
                    $model->email= $profuser['email'];
                }
            }
            $model->id=Yii::$app->user->id;
            $model->save();
        }
        return $this->render('profile', [
            'model' => $model,
        ]);
    }

    public function actionAccount()
    {
        /** @var SettingsForm $model */
        $model = \Yii::createObject(SettingsForm::className());
        $modelUserfeild=User::findOne(Yii::$app->user->id);
        if(empty($model)){
            $modelUserfeild = new User();}
        $event = $this->getFormEvent($model);
        $this->performAjaxValidation($model);
        $this->trigger(self::EVENT_BEFORE_ACCOUNT_UPDATE, $event);
        if ($model->load(\Yii::$app->request->post()) && $model->save()) {
            \Yii::$app->session->setFlash('success', \Yii::t('user', 'Your account details have been updated'));
            $this->trigger(self::EVENT_AFTER_ACCOUNT_UPDATE, $event);
            return $this->refresh();
        }
        return $this->render('account', [
            'model'             => $model,
            'modelUserfeild'    => $modelUserfeild
        ]);
    }
    public function actionDisconnect($id)
    {
        $account = $this->finder->findAccount()->byId($id)->one();

        if ($account === null) {
            throw new NotFoundHttpException();
        }
        if ($account->user_id != \Yii::$app->user->id) {
            throw new ForbiddenHttpException();
        }

        $event = $this->getConnectEvent($account, $account->user);

        $this->trigger(self::EVENT_BEFORE_DISCONNECT, $event);
        $account->delete();
        $this->trigger(self::EVENT_AFTER_DISCONNECT, $event);

        return $this->redirect(['networks']);
    }
}