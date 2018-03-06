<?php
/**
 * Created by PhpStorm.
 * User: mars
 * Date: 2018/2/26
 * Time: 下午10:50
 */

namespace app\models;


use function React\Promise\all;
use yii\db\ActiveRecord;
use yii\db\Query;

class Fellow extends ActiveRecord
{
    public static function tableName(){
        return 'fellow';
    }

    public function attributeLabels(){
        return[
            'uid'=>'用户id',
            'f_uid'=>'关注者的id',
        ];
    }



    public function rules(){
        return [
            [['uid','f_uid'],'required'],
        ];
    }

    public function findPhotoesByUid($uid){


    }

    public function findFellowByUId($uid){
        return self::findBySql('SELECT f_uid FROM fellow WHERE uid = '.$uid)->all();
}

    public function findMyFellowByUid($uid){
        return self::findAll(['f_uid'=>$uid]);
    }





}