<?php
/**
 * Created by PhpStorm.
 * User: mars
 * Date: 2018/2/17
 * Time: 上午12:22
 */

namespace app\controllers;


use app\models\Fellow;
use app\models\Likes;
use app\models\Photoes;
use yii\filters\AccessControl;
use yii\web\Controller;

class PictureController extends Controller
{


    public function beforeAction($action){
        return true;
    }

    public function actionIndex(){
        $model = new Photoes;

        return $this->render('index',['model'=>$model]);
    }

    public function actionUpdate(){
        $model = new Photoes;
        if (\Yii::$app->request->isPost){
            $post = \Yii::$app->request->post();
            $model->updateImage($post);
        }

        return $this->render('update',['model'=>$model]);
    }

    public function actionHotphotoes(){
        $model = new Photoes;

        return $this->render('hotphotoes',['model'=>$model]);
    }

    public function actionMyphotoes(){
        $model = new Photoes;

        return $this->render('myphotoes',['model'=>$model]);
    }

    public function actionFellowphotoes(){
        $model = new Photoes;

        return $this->render('fellowphotoes',['model'=>$model]);
    }

    public function actionLike(){
        $model = new Photoes;
        $likeRecord = new Likes;
        if (\Yii::$app->request->isPost){
            $post = \Yii::$app->request->post();
            $model = Photoes::findOne(['id'=>$post['id']]);
            $model->likes = $post['like'];
            if ($model->save(false)&&$likeRecord->like($post['id'],$post['uid'])){
                return true;
            }
        }
        return false;
    }
}