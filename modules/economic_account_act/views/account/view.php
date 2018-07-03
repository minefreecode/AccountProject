<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\modules\economic_account_act\models\Order;
use app\modules\economic_account_act\models\Service;
use app\components\helpers\cSumInWords;

//Появляется таблица
function html_table($account, $orders)
{		
 if (count($orders) > 0): 	
	echo $table = <<<'HEADER'
    <table border='1'>
		<thead>
        <tr>
        <th>№</th>
        <th>Наименование</th>
        <th>Ед. изм</th>
        <th>Кол-во</th>
        <th>Цена</th>
        <th>Сумма</th>
    </tr>
		<thead>
HEADER;

 $count = 0;
 
 //Калькуляция количества в просмотре 
 $quant = 0;
 
  //Калькуляция суммы в просмотре 
 $summ_all = 0;
 
 foreach ($orders as  $ordr):  
	$sum = $ordr -> service -> price * $ordr ->  quantity;//Сумма заказа вычисляется для просмотра
    echo '<tr>'.
	'<td>'.++$count.'</td>'.
	'<td>'.$ordr -> service -> name.'</td>'.
	'<td>'.$ordr -> service -> measurement_unit.'</td>'.
	'<td>'.$ordr -> quantity.'</td>'.
	'<td>'.$ordr -> service -> price .'</td>'.
	'<td>'.$sum.'</td>'.
	'</tr>';
	$quant = $quant + $ordr -> quantity;
	$summ_all =  $summ_all + $sum;
 endforeach;

 //Появляются итоги
     echo '<tr>'.
	'<td colspan="3" >Итоги</td>'.
	'<td>'.$quant  .'</td>'.
	'<td></td>'.
	'<td>'.$summ_all.'</td>'.
	'</tr>';
	
  echo '</tbody>'.
	'</table>';
 
  
  //Сумма прописью
  $money = cSumInWords::sRubles($summ_all);
  echo '<br>Сумма прописью: '. $money.' Без НДС.' ;
 endif; 
}

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
		//Появляется продавец
		echo $model -> attributeLabels()['seller_id'].': '.$model -> seller -> full_name.'<br>';
		echo $model -> seller -> attributeLabels()['address'].': '.$model -> seller -> address.'<br>';
		echo $model -> seller -> attributeLabels()['inn'].': '.$model -> seller -> inn.'<br>';
		echo $model -> seller -> attributeLabels()['current_account'].': '.$model->seller->current_account.'<br>';
		echo $model -> seller -> attributeLabels()['correspondent_account'].': '.$model->seller->correspondent_account.'<br>';
		echo $model -> seller -> attributeLabels()['rcbic'].': '.$model->seller->rcbic.'<br>';
		echo $model -> seller -> attributeLabels()['bank'].': '.$model->seller->bank.'<br><br>';
		
		//Появляется покупатель
		echo $model -> attributeLabels()['buyer_id'].': '.$model -> buyer -> full_name.'<br>';
		echo $model -> buyer -> attributeLabels()['address'].': '.$model -> buyer -> address.'<br>';
		echo $model -> buyer -> attributeLabels()['inn'].': '.$model -> buyer -> inn.'<br>';
		echo $model -> buyer -> attributeLabels()['kipp'].': '.$model->buyer->kipp.'<br>';
		echo $model -> buyer -> attributeLabels()['current_account'].': '.$model->buyer->current_account.'<br>';
		echo $model -> buyer -> attributeLabels()['correspondent_account'].': '.$model->buyer->correspondent_account.'<br>';
		echo $model -> buyer -> attributeLabels()['rcbic'].': '.$model->buyer->rcbic.'<br>';
		echo $model -> buyer -> attributeLabels()['bank'].': '.$model->buyer->bank.'<br><br>';
		
		echo '<center><b>Счет № '.$model -> id.' от '.$model->date1.'<b></center><br>';
		
		//Появляется таблица
		html_table($model, $orders);

		echo '<br><br><br>Индивидуальный предприниматель&nbsp&nbsp&nbsp&nbsp&nbsp_____________&nbsp&nbsp&nbsp&nbsp&nbsp(____________).' ;
	?>

</div>
