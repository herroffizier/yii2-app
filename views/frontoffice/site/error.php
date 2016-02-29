<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<h1><?= Html::encode($this->title) ?></h1>

<?= nl2br(Html::encode($message)) ?>
