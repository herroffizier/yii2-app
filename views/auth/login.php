<?php
// @codingStandardsIgnoreFile

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

$this->title = 'Вход';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-lg-offset-4 col-lg-4">
        <div class="row">
            <h1><?= Html::encode($this->title) ?></h1>

            <hr/>
        </div>

        <?php $form = ActiveForm::begin([
            'id' => 'login-form',
            'options' => ['class' => 'form-horizontal'],
            'fieldConfig' => [
                'template' => '<div class="row"><div class="col-lg-4">{label}</div><div class="col-lg-8">{input}{error}</div></div>',
            ],
        ]); ?>

        <?= $form->field($model, 'username') ?>

        <?= $form->field($model, 'password')->passwordInput() ?>

        <?= $form->field($model, 'rememberMe', ['template' => '<div class="row"><div class="col-lg-offset-4 col-lg-8">{input}{error}</div></div>'])->checkbox() ?>

        <div class="row pull-right">
            <?= Html::submitButton('Вход', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
