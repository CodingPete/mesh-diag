<?php

namespace app\controllers;

use app\models\Sample;
use app\models\Testcase;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\JsonResponseFormatter;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

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
                'only' => ['logout'],
                'rules' => [
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
     * @return string
     */
    public function actionIndex($testcase = 0)
    {
        $allow_create = false;

        if(!Yii::$app->user->isGuest) $allow_create = !$allow_create;


        return $this->render('index', [
            'allow_create' => $allow_create,
            'testcases' => Testcase::find()->all(),
            'samples' => Sample::findAll([
                "testcases_id" => intval($testcase)
            ])
        ]);
    }

    public function actionSample() {
        Yii::$app->response->format = Response::FORMAT_JSON;
        return Sample::find()
            ->with('proximities')
            ->with('remotes')
            ->where([
                "testcases_id" => intval(
                    Yii::$app->request->post("testcase_id")
                ),
                "timestamp" => date(
                    "Y-m-d H:i:s",
                    Yii::$app->request->post("timestamp")
                )
            ])
            ->asArray()
            ->all();
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
