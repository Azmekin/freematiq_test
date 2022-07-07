<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use backend\models\transac;
/** @var yii\web\View $this */
$this->title = 'Test task for the best company (freematiq)';
?>
<div class="site-index">
    <?php $form = ActiveForm::begin(); ?>

    <?php $lol = new transac(); ?>
    <?=  $form->field($lol, 'login')->textInput([
                            ])->label('Enter login')?>
<?=  $form->field($lol, 'sum')->textInput([
                                 'type' => 'number'
                            ])->label('Enter money')?>
    <?= $form->field($lol, 'type')->radioList(array(false=>'Send',true=>'Take from')); ?>
<div class="form-group">
    <?= Html::submitButton('Send money', ['class' => 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>



</div>