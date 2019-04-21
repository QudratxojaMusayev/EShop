<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $name;
?>
<div class="container text-center site-error">
<div class="logo-404">
    <a href="<?= Url::home(); ?>"><?= Html::img('@web/images/home/logo.png', ['alt' => 'Logo']) ?></a>
</div>
<div class="content-404">
    <img src="/images/404/404.png" class="img-responsive" alt="" />
    <h1><b>OPPS!</b> We Couldn’t Find this Page</h1>
    <p><?= nl2br(Html::encode($message)) ?></p>
    <h2 class="back-home"><a href="<?= Url::home(); ?>">Bring me back home</a></h2>
</div>
</div>
