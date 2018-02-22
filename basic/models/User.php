<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\web\UploadedFile;
use yii\imagine\Image;
class User extends ActiveRecord
{
    public $avatarFile;
    public $rememberme;

    public static function tablename(){
        return "user";
    }

    public function scenarios(){
        return [
            'login' => ['uid','name','password','login_time'],
            'signup' => ['uid','name','password','avatar','profile','sex','email','regist_time','login_time'],
            'update' => ['uid','name','avatar','profile','sex','email']
        ];
    }



    public  function  rules(){
        return  [
            [['name','password','sex','email'],'required','message'=>'请填写此项','on'=>'signup'],
            [['name','password'],'required','message'=>'请填写此项','on'=>'login'],
            ['avatarFile','file','maxSize'=>1024*100,'maxFiles'=>1,'extensions'=>'png,jpg','on'=>'update'],
            ['avatarFile','required','message'=>'图片为空','on'=>'update'],
            ['name','validateName','on'=>'signup'],
            ['rememberme','boolean','on'=>'login'],
            ['password','validatePassword','message'=>'密码错误','on'=>'login'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => '用户名',
            'password'=>'密码',
            'email'=>'邮箱地址',
            'avatar'=>'头像',
            'sex'=>'性别',
            'profile'=>'个人简介',
            'regist_time'=>'注册时间',
            'login_time'=>'登录时间',
            'rememberme'=>'记住我',
            'avatarFile'=>'修改头像',
        ];
    }

    public function validatePassword($attribute,$params){
        $user = self::findeByName($this->name);
        $hash = $user->password;
//        $password = \Yii::$app->getSecurity()->generatePasswordHash($this->password,10);
        if (!\Yii::$app->getSecurity()->validatePassword($this->password,$hash)){
            $this->addError($attribute,'用户名或密码错误');
        }
    }


    public function validateName($attribute,$params){
        $user = User::findeByName($this->name);
        if($user != null){
            $this->addError($attribute,'用户名已存在');
        }
    }
    public function validateAvatarPath($attribute,$params){

    }


    public static function findeByUid($uid){
        return static::findOne(['uid'=>$uid]);
    }


    public static function findeByName($name){
        return static::findOne(['name'=>$name]);
    }

    public  function signup($data,$scenario = 'signup'){
        $this->scenario = $scenario;
        if ($this->load($data) && $this->validate()){
            $hash = \Yii::$app->getSecurity()->generatePasswordHash($this->password,10);
            $this->password = $hash;
            $datetime = new \DateTime;
            $this->regist_time = $datetime->format('Y-m-d H:i:s');
            $this->login_time = $this->regist_time;
            if ($this->save()){
                \Yii::$app->session['islogin'] = 1;
                \Yii::$app->session['uid'] = $this->uid;
                \Yii::$app->session['name'] = $this->name;
                return true;
            }
        }
        return false;
    }

    public function login($data,$scenario = 'login'){
        $this->scenario = $scenario;
        if($this->load($data)&&$this->validate()){
            $user = self::findeByName($this->name);
            $datetime = new \DateTime;
            \Yii::$app->session['islogin'] = 1;
            \Yii::$app->session['uid'] = $user->uid;
            \Yii::$app->session['name'] = $user->name;
            $user->login_time = $datetime->format('Y-m-d H:i:s');
            if($user->update(false)) {
                return true;
            }


        }
        return false;
    }

    public function updateAvatar($data,$scenario = 'update'){
        $this->scenario = $scenario;
        //加删除旧图像功能
        if ($this->load($data)&&$this->validate()){
            $datatime = new \DateTime;
            $filename = $datatime->format('YmdHis');
            $this->avatarFile = UploadedFile::getInstance($this,'avatarFile');
            $user = self::findeByUid(\Yii::$app->session['uid']);
            $user->avatar = $filename.'.'.$this->avatarFile->extension;
            $user->profile = $this->profile;
            if ($user->update(false)){
                $this->avatarFile->saveAs(\Yii::$app->basePath.'/uploads/'.$filename.'.'.$this->avatarFile->extension);
                return true;
            }
        }
        return false;

    }


    public function saveAvatar($srcImage,$aimImage){
        Image::thumbnail($srcImage,100,100)->save($aimImage,['quality'=>100]);
    }
}
