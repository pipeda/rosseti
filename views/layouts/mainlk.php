<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="wrapper">
    <header>
        <div class="container">
            <div class="header-data">
                <div class="logo">
                    <a href="https://arsalexeev.ru/rosseti_form" title="">
                        <img src="<?= Yii::$app->request->baseUrl . '/media/rs.png'?>" class=" img-responsive" >

                    </a>
                </div>
                <nav>
                    <ul>
                        <li>
                            <a href="/lk/" title="">
                                Главная
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>
    <main>
        <div class="main-section">
            <div class="container-fluid">
                <div class="main-section-data">
                    <div class="row">
                        <div class="col-lg-2 col-md-4 pd-left-none no-pd">
                            <div class="main-left-sidebar no-margin">
                                <div class="user-data full-width">
                                    <div class="user-profile">
                                        <div class="username-dt">
                                            <div class="usr-pic">
                                                <img src="<?= Yii::$app->request->baseUrl . '/media/chel.png'?>" class=" img-responsive" >

                                            </div>
                                        </div>
                                        <div class="user-specs">
                                            <h2>Семенов Семен Семеныч</h2>
                                            <h3>89141940880</h3>
                                            <h3>Начальник</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-8 no-pd">
                            <div class="main-ws-sec">
                                <div class="posts-section">
                                    <div class="post-bar">
                                        <div class="post_topbar">
                                        </div>
                                        <div class="job_descp">
                                            <?= $content ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 pd-right-none no-pd">
                            <div class="right-sidebar">
                                <div class="widget widget-jobs">
                                    <div class="sd-title">
                                        <h3>Популярные идеи</h3>
                                        <i class="la la-ellipsis-v"></i>
                                    </div>
                                    <div class="jobs-list">
                                        <div class="job-info">
                                            <div class="job-details">
                                                <h3>Индикаторная отвёртка</h3>
                                                <p> Индикаторная отвёртка обладает прозрачной рукояткой с индикатором внутри, который показывает наличие или отсутствие тока...
                                                </p>
                                            </div>
                                        </div>
                                        <div class="job-info">
                                            <div class="job-details">
                                                <h3>Индикаторная отвёртка</h3>
                                                <p> Индикаторная отвёртка обладает прозрачной рукояткой с индикатором внутри, который показывает наличие или отсутствие тока...
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </main>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
