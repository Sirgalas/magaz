<?php
namespace backend\models;
use yii\imagine\Image;
use yii\base\Model;
use Yii;
class Imageresize extends Model{
    public function imagerisizegods($uploadPath,$filenames,$model){
        $path = $uploadPath;
        $img = Image::getImagine()->open($path . '' . $filenames);
        $size = $img->getSize();
        $ratio = $size->getWidth() / $size->getHeight();
        Image::thumbnail($path . $filenames, 122,122)->save($path . 'avatar-' . $model->name, ['quality' => 90]);//+
        $heightgods = round( 187 / $ratio);
        $heightgods = round( 180 / $ratio);
        Image::thumbnail($path . $filenames, 180,$heightgods)->save($path . 'recomended-' . $model->name, ['quality' => 90]);//+
        return true;
    }
    public function imagerisizenews($uploadPath,$filenames,$model){
        $path = $uploadPath;
        $img = Image::getImagine()->open($path . '' . $filenames);
        $size = $img->getSize();
        $ratio = $size->getWidth() / $size->getHeight();
        $heightgods = round( 187 / $ratio);
        Image::thumbnail($path . $filenames, 180,$heightgods)->save($path . 'gods-' . $model->name, ['quality' => 90]);//+ news
        $heightgods = round( 180 / $ratio);
        Image::thumbnail($path . $filenames, 510,345)->save($path . 'news-' . $model->name, ['quality' => 90]);//+ news

        return true;
    }
    
    /*public function imagerisizepars($uploadPath,$filenames){
        $path = $uploadPath;
        $img = Image::getImagine()->open($path . '' . $filenames);
        $size = $img->getSize();
        $ratio = $size->getWidth() / $size->getHeight();
        $height = round( 530 / $ratio);
        Image::thumbnail($path . '/' . $filenames, 292,$height)->save($path . 'fancy-' . $filenames, ['quality' => 90]);
        Image::thumbnail($path . '/' . $filenames, 122,122)->save($path . 'avatar-' . $filenames, ['quality' => 90]);
        $heightgods = round( 187 / $ratio);
        Image::thumbnail($path . '/' . $filenames, 187,$heightgods)->save($path . 'gods-' . $filenames, ['quality' => 90]);
        Image::thumbnail($path . '/' . $filenames, 179,156)->save($path . 'action-' . $filenames, ['quality' => 90]);
        Image::thumbnail($path . '/' . $filenames, 510,345)->save($path . 'news-' . $filenames, ['quality' => 90]);
        Image::thumbnail($path . '/' . $filenames, 260,517)->save($path . 'onegods-' . $filenames, ['quality' => 90]);
        Image::thumbnail($path . '/' . $filenames, 141,285)->save($path . 'onegodscarusel-' . $filenames, ['quality' => 90]);
        $heightrec = round( 87 / $ratio);
        Image::thumbnail($path . '/' . $filenames, 87,$heightrec)->save($path . 'recomented-' . $filenames, ['quality' => 90]);
        Image::thumbnail($path . '/' . $filenames, 90,90)->save($path . 'mini-' . $filenames, ['quality' => 90]);

        return true;
    }*/

}