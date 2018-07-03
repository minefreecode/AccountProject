<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\modules\economic_account_act\models\Subject;
use kartik\datetime\DateTimePicker;
use app\modules\economic_account_act\models\Service;

/* @var $this yii\web\View */
/* @var $model app\modules\economic_account_act\models\Account */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="account-form">

    <?php $form = ActiveForm::begin(); 

	?>


	<?= $form->field($model, 'seller_id')->dropDownList(
      ArrayHelper::map(Subject::find()->all(), 'id', 'full_name')) ?>
	  
	<?= $form->field($model, 'buyer_id')->dropDownList(
      ArrayHelper::map(Subject::find()->all(), 'id', 'full_name')) ?>
	  
	<!--?=$form->field($model, 'services')->listBox( $services,['multiple' => 'true',
    ]) ?-->

<!--?= $form->field($model, 'date1')->textInput() ?-->
	<?= DateTimePicker::widget([
      'name' => 'Account[date1]',
      'value' => date('y-m-d'),
	
      'options' => ['placeholder' => 'Выберите дату ...'],
      'pluginOptions' => [
          'format' => 'yy-mm-dd',
          'todayHighlight' => true,
			 'autoclose' => true,
			 'changeMonth' => true,
        'changeYear' => true,
		'changeHour' => false
      ]
  ]);
	?>
		
    <div class="form-group">
        <?= Html::submitButton('Далее', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
