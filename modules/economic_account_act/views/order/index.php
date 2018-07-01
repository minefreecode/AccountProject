<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\economic_account_act\models\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->params['breadcrumbs'][] = ['label' => 'Счет №'.Yii::$app->getRequest()->getQueryParam('account_id')];
$this->title = 'Заказы по счету №'.$account_id;
$this->params['breadcrumbs'][] = $this->title;

$account = Yii::$app->getRequest()->getQueryParam('account_id');

echo Html::a('Счет №'.$account, ['account/update', 'id' => $account ], ['class' => 'btn btn-lg btn-success']);  
?>
<div class="order-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать заказ', ['create',  'account_id' => $account_id], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'quantity',
            'account_id',
            'service_id',

            ['class' => 'yii\grid\ActionColumn', 'template'=>'{delete}' ],
        ],
    ]); ?>
</div>
