<?php
use yii\helpers\Url;

$action = $this->context->action->id;
?>
<ul class="nav nav-pills">
    <li <?= ($action === 'index') ? 'class="active"' : '' ?>>
        <a href="<?= Url::to(['/ideas/spis?id='.$id]) ?>">
            <?php if($action == 'edit' || $action == 'photos') : ?>
                <i class="glyphicon glyphicon-chevron-left font-12"></i>
            <?php endif; ?>
            Cписок файлов
        </a>
    </li>
    <li> <?= ($action === 'create') ? 'class="active"' : '' ?><a href="<?= Url::to(['/ideas/view?id='.$id]) ?>">Добавить файл</a></li>
</ul>
<br/>
