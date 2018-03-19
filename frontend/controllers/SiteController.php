<?php
namespace frontend\controllers;

use Yii;
use common\models\Post;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\Comment;
use common\models\FrontendSetup;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $comments= Comment::getDb()->cache(function (){
            return Comment::find()->where('what=0')->with('rating','user')->limit(20)->orderBy(['id'=>SORT_DESC])->all();
        });

        $page= Post::getDb()->cache(function (){
            return  Post::find()->with('images')->orderBy(['id'=>SORT_DESC])->limit(10)->all();
        });
           
        $FrontSet=FrontendSetup::find()->where(['in','key_setup',['Врехняя','Средняя','Нижняя','Левая','Центр','Правая']])->all();
        return $this->render('index',[
            'comments'  =>  $comments,
            'pages'     =>  $page,
            'FrontSet'  =>  $FrontSet
        ]);
    }
    public function actionError()
    {
        $exception = Yii::$app->errorHandler->exception;
        if ($exception !== null) {
            return $this->render('error', ['exception' => $exception]);
        }
    }

}
