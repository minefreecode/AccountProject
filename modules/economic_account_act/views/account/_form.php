<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\modules\economic_account_act\models\Subject;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model app\modules\economic_account_act\models\Account */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="account-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'seller_id')->dropDownList(
      ArrayHelper::map(Subject::find()->all(), 'id', 'full_name')) ?>
	  
	<?= $form->field($model, 'buyer_id')->dropDownList(
      ArrayHelper::map(Subject::find()->all(), 'id', 'full_name')) ?>
	  
    <?= $form->field($model, 'measurement_unit')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'quantity')->textInput() ?>

    <?= $form->field($model, 'price')->textInput() ?>

<!--?= $form->field($model, 'date1')->textInput() ?-->
	<?= DateTimePicker::widget([
      'name' => 'Account[date1]',
      'value' => date('d-m-y'),
	
      'options' => ['placeholder' => 'Выберите дату ...'],
      'pluginOptions' => [
          'format' => 'dd-mm-yy',
          'todayHighlight' => true,
			 'autoclose' => true,
			 'changeMonth' => true,
        'changeYear' => true,
		'changeHour' => false
      ]
  ]);
	?>
		
    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
