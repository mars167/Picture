<?php
/**
 * Created by PhpStorm.
 * User: mars
 * Date: 2018/3/7
 * Time: 下午5:38
 */

namespace app\models;


use yii\db\ActiveRecord;

class Likes extends ActiveRecord
{
    public static function tableName(){
        return 'likes';
    }

    public function attributeLabels(){
        return[
            'p_id'=>'图片id',
            'uid'=>'点赞者id',
        ];
    }



    public function rules(){
        return [
            [['p_id','uid'],'required'],
        ];
    }

    public function like($p_id,$uid){
        $this->p_id = $p_id;
        $this->uid = $uid;
        if ($this->save()){
            return true;
        }
        return false;
    }
    public function isLike($p_id,$uid){
        if (self::findOne(['p_id'=>$p_id,'uid'=>$uid])){
            return true;
        }
        return false;
    }
}