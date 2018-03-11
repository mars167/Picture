<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'picture/css/bootstrap.min.css',
        'picture/open-iconic/font/css/open-iconic-bootstrap.css',
        'picture/css/common.css',
        'picture/css/index.css',
        'picture/css/userList.css',
    ];
    public $js = [
        'picture/js/jquery-3.1.1.js',
        'picture/js/popper.min.js',
        'picture/js/bootstrap.min.js',

    ];
    public $depends = [

    ];
}
