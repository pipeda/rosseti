<?php
use yii\helpers\Url;

$action = $this->context->action->id;
?>
<ul class="nav nav-pills">
    <li> <?= ($action === 'ideas') ? 'class="active"' : '' ?><a href="<?= Url::to(['/site/']) ?>">Мои предложения</a></li>
    <li <?= ($action === 'index') ? 'class="active"' : '' ?>>
        <a href="<?= Url::to(['/ideas/spis?id='.$id]) ?>">
            <?php if($action == 'edit' || $action == 'photos') : ?>
                <i class="glyphicon glyphicon-chevron-left font-12"></i>
            <?php endif; ?>
            Cписок файлов
        </a>
    </li>
    <li> <?= ($action === 'create') ? 'class="active"' : '' ?><a href="<?= Url::to(['/ideas/view?id='.$id]) ?>">Добавить файл</a></li>
    <li> <?= ($action === 'edit') ? 'class="active"' : '' ?><a href="#">Редактировать</a></li>
</ul>
<br/>
