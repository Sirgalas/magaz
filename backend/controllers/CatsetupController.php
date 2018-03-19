<?php

namespace backend\controllers;

use backend\modules\yandex\models\Category;
use Yii;
use common\models\FrontendSetup;
use backend\models\FrontendSetupSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Translit;
use common\models\Image;
use yii\filters\AccessControl;
/**
 * CatsetupController implements the CRUD actions for FrontendSetup model.
 */
class CatsetupController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'allow' => true,
                        'roles' => ['admin','moderator'],
                    ],
                ],
                'denyCallback' => function($rule, $action) {
                    Yii::$app->session->setFlash('info', 'У вас нет прав доступа');
                    return $action->controller->redirect('/admin/user/security/login');
                },
            ],
        ];
    }

    /**
     * Lists all FrontendSetup models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FrontendSetupSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single FrontendSetup model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new FrontendSetup model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new FrontendSetup();
        $category= Category::find()->all();
        $basePath='frontendImage/catsetup/';
        $imageModel=new Image();
        $transliterator= new Translit();
        if (Yii::$app->request->isAjax) {
            $fileName = 'file';
            $uploadPath =Yii::getAlias('@frontend/web/image/').$basePath;
            if (isset($_FILES[$fileName])) {
                if (file_exists($uploadPath)) {
                } else {
                    mkdir($uploadPath, 0775, true);
                }
                $file = \yii\web\UploadedFile::getInstanceByName($fileName);
                $filenames=$transliterator->traranslitImg($file);
                if ($file->saveAs($uploadPath . '/' . $filenames)) {
                    $imageModel->path = $basePath;
                    $imageModel->name=$filenames;
                    $image=$imageModel->id;
                    $imageModel->save();
                    return $this->render('create', [
                        'model'     => $model,
                        'category'  => $category
                    ]);

                }
            }
        }
        if ($model->load(Yii::$app->request->post())) {
            $page=Yii::$app->request->post('FrontendSetup');
            if(isset($page['key_setup'])){
                $varFr=$model->catsetup($page['vaelye'],Yii::getAlias('@frontendWebroot/image/').$basePath);
                $model->vaelye=$varFr;
                $model->save();
            }
            return $this->redirect(['index', 'FrontendSetupSearch[description]' => 'catsetup']);
        } else {
            return $this->render('create', [
                'model'     => $model,
                'category'  => $category
            ]);
        }
    }

    /**
     * Updates an existing FrontendSetup model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $category= Category::find()->all();
        $basePath='frontendImage/catsetup/';
        $imageModel=new Image();
        $transliterator= new Translit();
        if (Yii::$app->request->isAjax) {
            $fileName = 'file';
            $uploadPath =Yii::getAlias('@frontend/web/image/').$basePath;
            if (isset($_FILES[$fileName])) {
                if (file_exists($uploadPath)) {
                } else {
                    mkdir($uploadPath, 0775, true);
                }
                $file = \yii\web\UploadedFile::getInstanceByName($fileName);
                $filenames=$transliterator->traranslitImg($file);
                if ($file->saveAs($uploadPath . '/' . $filenames)) {
                    $imageModel->path = $basePath;
                    $imageModel->name=$filenames;
                    $image=$imageModel->id;
                    $imageModel->save();
                    return $this->render('create', [
                        'model'     => $model,
                        'category'  => $category
                    ]);

                }
            }
        }
        if ($model->load(Yii::$app->request->post())) {
            $page=Yii::$app->request->post('FrontendSetup');
            if(isset($page['key_setup'])){
                $varFr=$model->catsetup($page['vaelye'],Yii::getAlias('@frontendWebroot/image/').$basePath);
                $model->vaelye=$varFr;
                $model->save();
            }
            return $this->redirect(['index', 'FrontendSetupSearch[description]' => 'catsetup']);
        } else {
            return $this->render('update', [
                'model' => $model,
                'category'  => $category
            ]);
        }
    }

    /**
     * Deletes an existing FrontendSetup model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the FrontendSetup model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return FrontendSetup the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = FrontendSetup::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
