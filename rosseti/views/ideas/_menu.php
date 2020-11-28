<?php
use yii\helpers\Url;

$action = $this->context->action->id;

$backTo = null;
$indexUrl = Url::to(['/ideas/pending']);
$processedUrl = Url::to(['/ideas/processed']);
$sentUrl = Url::to(['/ideas/sent']);
$completedUrl = Url::to(['/ideas/completed']);
$failsUrl = Url::to(['/ideas/fails']);

if($action === 'view')
{
    $returnUrl = $this->context->getReturnUrl($indexUrl);

    if(strpos($returnUrl, 'processed') !== false){
        $backTo = 'processed';
        $processedUrl = $returnUrl;
    } elseif(strpos($returnUrl, 'sent') !== false) {
        $backTo = 'sent';
        $sentUrl = $returnUrl;
    } elseif(strpos($returnUrl, 'completed') !== false) {
        $backTo = 'completed';
        $completedUrl = $returnUrl;
    } elseif(strpos($returnUrl, 'fails') !== false) {
        $backTo = 'fails';
        $failsUrl = $returnUrl;
    } else {
        $backTo = 'index';
        $indexUrl = $returnUrl;
    }
}
?>
<ul class="nav nav-pills">
    <li <?= ($action === 'index') ? 'class="active"' : '' ?>>
        <a href="<?= $indexUrl ?>">
            <?php if($backTo === 'index') : ?>
                <i class="glyphicon glyphicon-chevron-left font-12"></i>
            <?php endif; ?>
            Ожидает
            <?php if($this->context->pending > 0) : ?>
                <span class="badge"><?= $this->context->pending ?></span>
            <?php endif; ?>
        </a>
    </li>
    <li <?= ($action === 'processed') ? 'class="active"' : '' ?>>
        <a href="<?= $processedUrl ?>">
            <?php if($backTo === 'processed') : ?>
                <i class="glyphicon glyphicon-chevron-left font-12"></i>
            <?php endif; ?>
          В обработке
            <?php if($this->context->processed > 0) : ?>
                <span class="badge"><?= $this->context->processed ?></span>
            <?php endif; ?>
        </a>
    </li>
    <li <?= ($action === 'sent') ? 'class="active"' : '' ?>>
        <a href="<?= $sentUrl ?>">
            <?php if($backTo === 'sent') : ?>
                <i class="glyphicon glyphicon-chevron-left font-12"></i>
            <?php endif; ?>
          на согласовании
            <?php if($this->context->sent > 0) : ?>
                <span class="badge"><?= $this->context->sent ?></span>
            <?php endif; ?>
        </a>
    </li>
    <li <?= ($action === 'completed') ? 'class="active"' : '' ?>>
        <a href="<?= $completedUrl ?>">
            <?php if($backTo === 'completed') : ?>
                <i class="glyphicon glyphicon-chevron-left font-12"></i>
            <?php endif; ?>
      согласованно
        </a>
    </li>
    <li <?= ($action === 'fails') ? 'class="active"' : '' ?>>
        <a href="<?= $failsUrl ?>">
            <?php if($backTo === 'fails') : ?>
                <i class="glyphicon glyphicon-chevron-left font-12"></i>
            <?php endif; ?>
           ошибка
        </a>
    </li>
</ul>
<br/>