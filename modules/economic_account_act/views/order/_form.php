<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\economic_account_act\models\Service;
use app\modules\economic_account_act\models\Account;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\modules\economic_account_act\models\Order */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-form">

    <?php $form = ActiveForm::begin(); 
		$model -> account_id = Yii::$app->getRequest()->getQueryParam('account_id');
	?>
  
	<?= $form->field($model, 'service_id')->dropDownList(
			ArrayHelper::map(Service::find()->all(), 'id', function($element) {
			return $element->name.', Цена:			'.$element['price'].' ('.$element['measurement_unit'].')';
	})) ?>
	


	<?= $form->field($model, 'account_id')->textInput( ['readOnly'=> true]) ?>
		  
		
    <?= $form->field($model, 'quantity')->textInput() ?>

	
    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
