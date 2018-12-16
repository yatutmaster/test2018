<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\Notes;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    // public function behaviors()
    // {
    //     return [
    //         'access' => [
    //             'class' => AccessControl::className(),
    //             'only' => ['logout'],
    //             'rules' => [
    //                 [
    //                     'actions' => ['logout'],
    //                     'allow' => true,
    //                     'roles' => ['@'],
    //                 ],
    //             ],
    //         ],
    //         'verbs' => [
    //             'class' => VerbFilter::className(),
    //             'actions' => [
    //                 'logout' => ['post'],
    //             ],
    //         ],
    //     ];
    // }

    /**
     * {@inheritdoc}
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
     * @return string
     */
    public function actionIndex()
    {

        $model = new Notes();

        $notes = Notes::find()
                ->orderBy('id desc')
                ->asArray()
                ->all();
        return $this->render('index', [
            'model' => $model,
            'notes' => $notes
        ]);

    }

    public function actionAddnote ()
    {
        if(Yii::$app->request->isPost)
        {
            $model = new Notes();
        
            if($model->load(Yii::$app->request->post()))
                $model->setNote();

        }
        return $this->goHome();


    }

    public function actionChangenote ($id,$status)
    {

        $model = new Notes();
        $model->setScenario(Notes::ACTIVE_NOTE);
        $model->attributes = Yii::$app->request->get();

        if($model->validate())
        {
            if(!$model->delete())
                return $model->errors;

        }
        
        return $this->goHome();

    }

}
