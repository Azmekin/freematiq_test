<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use frontend\models\usrBalance;
/** @var yii\web\View $this */
$this->title = 'Test task for the best company (freematiq)';
?>
<div class="site-index">
<?foreach ($model as $user):?>
    <input class="form-control" id="numbsec" type="text" value="Balance:<?=$user->sum?>" aria-label="Disabled input example" disabled readonly>
    <?endforeach;?>

    <?php $form = ActiveForm::begin(); ?>

    <?php $lol = new usrBalance(); ?>
<?=  $form->field($lol, 'sum')->textInput([
                                 'type' => 'number'
                            ])->label('Enter money')?>
<div class="form-group">
    <?= Html::submitButton('Send money', ['class' => 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>



</div>
