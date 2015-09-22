<?php
// @codingStandardsIgnoreFile

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use yii\helpers\Url;
use app\assets\BackOfficeAsset;
use app\helpers\StringHelper;
/* @var $this \yii\web\View */
/* @var $content string */
BackOfficeAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= StringHelper::makeTitle($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>
    <div class="wrap">
        <?php
            NavBar::begin([
                'brandLabel' => Yii::$app->id,
                'brandUrl' => Url::to(['backoffice/dashboard/index']),

                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);

            $controllers = [
            ];

            $items = [];
            foreach ($controllers as $controller => $label) {
                if (!Yii::$app->user->can($controller)) {
                    continue;
                }

                if (is_array($label)) {
                    $items[] = $label;
                } else {
                    $items[] = ['label' => $label, 'url' => [$controller], 'active' => $this->context->id === $controller];
                }
            }

            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => array_merge($items, [
                    Yii::$app->user->isGuest ?
                        ['label' => 'Войти', 'url' => ['frontoffice/auth/login']] :
                        ['label' => 'Выйти ('.Yii::$app->user->identity->email.')',
                            'url' => ['frontoffice/auth/logout'],
                            'linkOptions' => ['data-method' => 'post']],
                ]),
            ]);
            NavBar::end();
        ?>

        <div class="container">
            <?= Breadcrumbs::widget([
                'homeLink' => ['url' => ['backoffice/dashboard/index'], 'label' => 'Главная'],
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p class="pull-left">&copy; <?= date('Y') ?></p>
            <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
