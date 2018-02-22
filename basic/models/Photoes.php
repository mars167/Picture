<?php
/**
 * Created by PhpStorm.
 * User: mars
 * Date: 2018/2/20
 * Time: 上午11:20
 */

namespace app\models;


use yii\db\ActiveRecord;

class Photoes extends ActiveRecord
{
    public static function tableName(){
        return 'photoes';
    }

}