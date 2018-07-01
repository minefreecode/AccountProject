<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use  app\modules\economic_account_act\models\Account;
/* @var $this yii\web\View */
/* @var $searchModel app\\modules\economic_account_act\models\AccountSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Счета';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="account-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать счет', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
			 [
            'header' => $searchModel -> attributeLabels()['seller_id'],
            'attribute' => 'seller.full_name'
			],
			[
            'header' => $searchModel -> attributeLabels()['buyer_id'],
            'attribute' => 'buyer.full_name'
			],
            'measurement_unit',
            'quantity',
            'price',
			'date1',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
