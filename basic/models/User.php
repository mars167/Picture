<?php

namespace app\models;

use yii\db\ActiveRecord;

class User extends ActiveRecord
{

    public $rememberme;

    public static function tablename(){
        return "user";
    }

    public function scenarios(){
        return [
            'login' => ['uid','name','password','login_time'],
            'signup' => ['uid','name','password','avatar','profile','sex','email','regist_time','login_time'],
            'updata' => ['uid','name','avatar','profile','sex','email']
        ];
    }



    public  function  rules(){
        return  [
            [['name','password','sex','email'],'required','message'=>'请填写此项','on'=>['signup','updata']],
            [['name','password'],'required','message'=>'请填写此项','on'=>'login'],
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

    public function updata($data,$scenario = 'updata'){
        $this->scenario = $scenario;
    }


    public function getUser(){

    }
}
