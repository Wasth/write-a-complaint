<?php

namespace app\controllers;

use app\models\Claim;
use app\models\SigninForm;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\ErrorAction;
use yii\web\NotFoundHttpException;

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
                        'roles' => ['?'],
                        'denyCallback' => function ($rule, $action) {
                            return $action->controller->redirect(['/']);
                        },
                    ],
                    [
                        'allow' => true,
                        'actions' => ['logout', 'newclaim', 'myclaims'],
                        'roles' => ['@'],
                        'denyCallback' => function ($rule, $action) {
                            return $action->controller->redirect(['/']);
                        },
                    ],
                ],
                'denyCallback' => function ($rule, $action) {
                    throw new NotFoundHttpException();
                },
            ]
        ];
    }

    public function actions()
    {
        $actions = parent::actions();

        $actions['error'] = [
            'class' => ErrorAction::className()
        ];

        return $actions;
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
        $claims = Claim::find()->orderBy('id DESC')->limit(8)->all();
        return $this->render('index', [
            'claims' => $claims
        ]);
    }

    public function actionNewclaim()
    {
        $model = new Claim();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate() && $model->save(false)) {
                return $this->redirect(['site/claim', 'id' => $model->id]);
            }
        }

        return $this->render('newclaim', [
            'model' => $model,
        ]);
    }

    public function actionClaim($id)
    {
        if($claim = Claim::findOne($id)){
            return $this->render('claim',
                ['claim' => $claim]
            );
        }
        throw new NotFoundHttpException();
    }

    public function actionMyclaims()
    {
        $claims = Claim::find()->where(['user_id' => Yii::$app->user->id])->all();

        return $this->render('myclaims',
            [
                'claims' => $claims,
            ]
        );
    }

    public function actionRemove($id){
        if($claim = Claim::findOne($id)) {
            if($claim->user_id == Yii::$app->user->id) {
                $claim->delete();
                return $this->redirect(['site/myclaims']);
            }
        }

        throw new NotFoundHttpException();

    }

    public function actionTest(){
        Yii::$app->response->sendFile('test/test.txt');
//        return $this->render('index');
    }
}
