<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\economic_account_act\models\Service */

$this->title = 'Создать услугу';
$this->params['breadcrumbs'][] = ['label' => 'Услуги', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="service-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
