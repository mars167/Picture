<?php
/**
 * Created by PhpStorm.
 * User: mars
 * Date: 2018/2/13
 * Time: 下午9:50
 */

namespace app\controllers;


use app\models\Fellow;
use app\models\Photoes;
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
        $user = $model->findeByUid(\Yii::$app->session['uid']);

        $fans = (new \yii\db\Query())
            ->from('fellow')
            ->where(['f_uid' =>\Yii::$app->session['uid'] ])
            ->count();
        $fellow = (new \yii\db\Query())
            ->from('user')
            ->where(['uid' => \Yii::$app->session['uid']])
            ->count();

        return $this->render('profile',['user'=>$user,'fans'=>$fans,'fellow'=>$fellow]);
    }

    public function actionUpdate(){
        $model = new User;
        if (isset(\Yii::$app->session['islogin'])){
            $user = $model->findeByUid(\Yii::$app->session['uid']);
        }else{
            $this->redirect(['member/login']);
            \Yii::$app->end();
        }

        if (\Yii::$app->request->isPost){
            if ($model->updateAvatar(\Yii::$app->request->post())){
                $this->redirect(['member/profile']);
                \Yii::$app->end();
            }
        }

        $user = $model->findeByUid(\Yii::$app->session['uid']);
        return $this->render('update',['model'=>$model,'user'=>$user]);
    }

    public function actionFanslist(){
        $model = new Fellow;
        $uid = \Yii::$app->session['uid'];
        $list = $model->findMyFellowByUid($uid);

        return $this->render('fanslist',['model'=>$model,'list'=>$list]);
    }

    public function actionFellowlist(){
        $model = new Fellow;
        $uid = \Yii::$app->session['uid'];
        $list = $model->findFellow($uid);

        return $this->render('fellowlist',['model'=>$model,'list'=>$list]);
    }
    //关注
    public function actionFellow(){
        if (\Yii::$app->request->isPost){
            $post = \Yii::$app->request->post();
            $model = new Fellow;
            $model->uid = $post['uid'];
            $model->f_uid = $post['f_uid'];
            if ($model->save()){
                return true;
            }
        }
        return false;

    }
    //取消关注
    public function actionDelete(){
        if (\Yii::$app->request->isPost){
            $post = \Yii::$app->request->post();
            Fellow::findOne(['uid'=>$post['uid'],'f_uid'=>$post['f_uid']])->delete();
        }
    }

    public function actionCard(){
        $model = new User;
        $photo = new Photoes;
        $get = \Yii::$app->request->get();
        $uid = $get['uid'];
        $user = $model->findeByUid($uid);
        return $this->render('card',['model'=>$model,'photo'=>$photo,'user'=>$user]);
    }

}