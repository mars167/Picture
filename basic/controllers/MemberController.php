<?php
/**
 * Created by PhpStorm.
 * User: mars
 * Date: 2018/2/13
 * Time: 下午9:50
 */

namespace app\controllers;


use app\models\User;
use yii\web\Controller;

class MemberController extends Controller
{
    public function actionSignup(){
        if (isset(\Yii::$app->session['islogin'])){
            $this->redirect(['member/logout']);
            \Yii::$app->end();
        }
        $model = new User;
        if ($model->signup(\Yii::$app->request->post()) ){
            $this->redirect(['member/profile']);
            \Yii::$app->end();
        }

        return $this->render('signup',['model'=>$model]);
    }

    public function actionLogin(){
        if (isset(\Yii::$app->session['islogin'])){
            $this->redirect(['member/logout']);
            \Yii::$app->end();
        }
        $model = new User;
        if ($model->login(\Yii::$app->request->post())){
            $this->redirect(['member/profile']);
            \Yii::$app->end();
        }

        return $this->render('login',['model'=>$model]);
    }

    public function actionLogout(){
        \Yii::$app->session->removeAll();
        if (!isset(\Yii::$app->session['islogin'] )){
            $this->redirect(['member/login']);
           \Yii::$app->end();
        }
        $this->goBack();
    }

    public function actionProfile(){
        $model = new User;
        if (isset(\Yii::$app->session['islogin'])){
            $user = $model->findeByUid(\Yii::$app->session['uid']);
        }else{
            $this->redirect(['member/login']);
            \Yii::$app->end();
        }

        return $this->render('profile',['user'=>$user]);
    }
}