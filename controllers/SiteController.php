<?php

namespace app\controllers;

use app\models\Claim;
use app\models\SigninForm;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Controller;

class SiteController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['signin', 'signup', 'logout', 'newclaim', 'myclaims'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['signin', 'signup'],
                        'roles' => ['?']
                    ],
                    [
                        'allow' => true,
                        'actions' => ['logout', 'newclaim', 'myclaims'],
                        'roles' => ['@']
                    ],
                ]
            ]
        ];
    }

    public function actionSignin()
    {
        $model = new SigninForm();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate() && $model->signin()) {
                return $this->goHome();
            }
        }

        return $this->render('signin', [
            'model' => $model,
        ]);
    }

    public function actionSignup()
    {
        $model = new \app\models\SignupForm();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate() && $model->signup()) {
                return $this->goHome();
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->redirect(Url::home());
    }

    public function actionIndex()
    {
        $claims = Claim::find()->limit(8)->all();
        return $this->render('index', [
            'claims' => $claims
        ]);
    }

    public function actionNewclaim()
    {
        $model = new \app\models\Claim();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate() && $model->save(false)) {
                return $this->redirect(['site/claim', 'id' => $model->id]);
            }
        }

        return $this->render('newclaim', [
            'model' => $model,
        ]);
    }

    public function actionClaim($id){
        $claim = Claim::findOne($id);
        return $this->render('claim',
            ['claim' => $claim]
        );
    }
}
