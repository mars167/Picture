<?php
/**
 * Created by PhpStorm.
 * User: mars
 * Date: 2018/2/20
 * Time: 上午11:20
 */

namespace app\models;


use yii\db\ActiveRecord;
use yii\web\UploadedFile;

class Photoes extends ActiveRecord
{
    public $imageFile;
    public $imageTitle;

    public static function tableName(){
        return 'photoes';
    }

    public function attributeLabels(){
        return[
            'imageFile'=>'上传照片',
            'imageTitle'=>'照片标题',
            'likes'=>'喜欢次数',
            'update_time'=>'上传时间',
        ];
    }

    public function scenarios(){
        return [
            'update'=>['title','photo','update_time'],
            'change'=>['title'],
        ];
    }

    public function rules(){
        return [
            ['imageFile','image','extensions'=>'png,jpg,gif','message'=>'请选择png/jpg/gif格式的图片上传','on'=>'update'],
            ['imageFile','required','message'=>'请添加图片','on'=>'update'],
        ];
    }

    public function updateImage($date,$scenario='update'){
        $this->scenario = $scenario;
        $path = \Yii::$app->basePath.'/uploads/photoes/';
        if($this->load($date)){
            if ($this->imageTitle != null){
                $this->title = $this->imageTitle;
            }
            $this->imageFile = UploadedFile::getInstance($this,'imageFile');
            $datatime = new \DateTime;
            $session = \Yii::$app->session;
            $imageName = $datatime->format('YmdHis').$session['name'].'.'.$this->imageFile->extension;
            $srcImage = $path.$imageName;
            if ($this->imageFile->saveAs($srcImage)){
                $this->photo = $imageName;
                $this->uid = $session['uid'];
                $this->update_time = $datatime->format('Y-m-d H-i-s');
                return $this->save();
            }
        }
        return false;
    }

    public function showByTime(){
        $result = $result = static::find()->orderBy('update_time DESC')->all();
        return $result;

    }

    public function showByLikes(){
        $result =  $result = static::find()->orderBy('likes DESC')->all();
        return $result;
    }

    public function showByFellow($fuid){

    }

    public function showByUid($uid){
        $result = static::find()->where(['uid'=>$uid])->orderBy('update_time DESC')->all();
        return $result;
    }
}