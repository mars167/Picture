<?php
use app\assets\AppAsset;
use yii\helpers\Html;
use yii\helpers\Url;

AppAsset::register($this);

?>
<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo Html::encode($this->title); ?></title>
    <?php
    $this->registerMetaTag(['name'=>'viewport','content'=>'width=device-width, initial-scale=1']);
    $this->registerMetaTag(['http-requiv'=>'Content-Type','content'=>'text/html; charset=utf-8']);
    $this->registerMetaTag(['name'=>'author','content'=>'Mars167']);
    $this->registerMetaTag(['name'=>'description','content'=>'Picture']);
    ?>
    <?php $this->head(); ?>
</head>



<?php $this->beginBody(); ?>
<body>
    <div id="container">
        <div id="header" class="fixed-top clearfix">
            <div class="row">
                <div class="col-2">
                    <a href="<?=Url::to(['picture/update'])?>" id="postNewBtn"><span class="oi oi-plus"></span></a>
                </div>
                <div class="col-8">
                    <img src="picture/images/logo.png" alt="logo" id="logo" data-toggle="tooltip" data-placement="right" title="点我回顶部" data-container="#header">
                </div>
                <div class="col-2">
                    <a href="<?=Url::to(['member/profile'])?>" id="userBtn"><span class="oi oi-person"></span></a>
                </div>
            </div>
        </div>

        <div id="tagNav" class="fixed-top clearfix">
            <div class="row">
                <div class="col-4 <?=$this->title=='最新'?'active':''?>">
                    <a href="<?=Url::to(['picture/index'])?>">最新</a>
                </div>
                <div class="col-4 <?=$this->title=='热门'?'active':''?>">
                    <a href="<?=Url::to(['picture/hotphotoes'])?>">热门</a>
                </div>
                <div class="col-4 <?=$this->title=='关注'?'active':''?>">
                    <a href="<?=Url::to(['picture/fellowphotoes'])?>">关注</a>
                </div>
            </div>
        </div>

        <?=$content?>

    </div>
</body>
<?php $this->endBody(); ?>

</html>
<?php
$js = <<<JS
    $(function () {
        $('#logo').tooltip();
    })

    $(window).scroll(function(){
        if( $(this).scrollTop() > 500){
            $('#logo').tooltip('show');
        }else{
            $('#logo').tooltip('hide');
        }
    });

    $('#logo').click(function(){
        $(window).scrollTop(0);
    });


JS;
$this->registerJs($js);

?>

<?php $this->endPage();?>
