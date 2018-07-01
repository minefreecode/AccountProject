<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\economic_account_act\models\Order */
$account = Yii::$app->getRequest()->getQueryParam('account_id');
$this->title = 'Создать заказ';
$this->params['breadcrumbs'][] = ['label' => 'Счет №'.$account];
$this->params['breadcrumbs'][] = ['label' => 'Заказы'];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php echo Html::a('Счет №'.$account, ['account/update', 'id' => $account ], ['class' => 'btn btn-lg btn-success']);  ?>

<?php echo Html::a('Заказы', ['index', 'account_id' => $account], ['class' => 'btn btn-lg btn-success']);  ?>

		
<div class="order-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
