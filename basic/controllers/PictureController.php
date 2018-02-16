<?php
/**
 * Created by PhpStorm.
 * User: mars
 * Date: 2018/2/17
 * Time: 上午12:22
 */

namespace app\controllers;


use yii\web\Controller;

class PictureController extends Controller
{
    public function actionIndex(){


        return $this->render('index');
    }
}