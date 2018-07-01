<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\economic_account_act\models\Account */

$this->title = 'Счет № '.$model->id;
$this->params['breadcrumbs'][] = ['label' => 'Счета', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="account-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить элемент?',
                'method' => 'post',
            ],
        ]) ?>
    </p>


	
	<?php
		echo $model -> attributeLabels()['seller_id'].': '.$model -> seller -> full_name.'<br>';
		echo $model -> seller -> attributeLabels()['address'].': '.$model -> seller -> address.'<br>';
		echo $model -> seller -> attributeLabels()['inn'].': '.$model -> seller -> inn.'<br>';
		echo $model -> seller -> attributeLabels()['current_account'].': '.$model->seller->current_account.'<br>';
		echo $model -> seller -> attributeLabels()['correspondent_account'].': '.$model->seller->correspondent_account.'<br>';
		echo $model -> seller -> attributeLabels()['rcbic'].': '.$model->seller->rcbic.'<br>';
		echo $model -> seller -> attributeLabels()['bank'].': '.$model->seller->bank.'<br><br>';
		
				echo $model -> attributeLabels()['buyer_id'].': '.$model -> buyer -> full_name.'<br>';
		echo $model -> buyer -> attributeLabels()['address'].': '.$model -> buyer -> address.'<br>';
		echo $model -> buyer -> attributeLabels()['inn'].': '.$model -> buyer -> inn.'<br>';
		echo $model -> buyer -> attributeLabels()['kipp'].': '.$model->buyer->kipp.'<br>';
		echo $model -> buyer -> attributeLabels()['current_account'].': '.$model->buyer->current_account.'<br>';
		echo $model -> buyer -> attributeLabels()['correspondent_account'].': '.$model->buyer->correspondent_account.'<br>';
		echo $model -> buyer -> attributeLabels()['rcbic'].': '.$model->buyer->rcbic.'<br>';
		echo $model -> buyer -> attributeLabels()['bank'].': '.$model->buyer->bank.'<br><br>';
		
		echo '<center><b>Счет № '.$model -> id.' от '.$model->date1.'<b></center><br>';
	?>

</div>
