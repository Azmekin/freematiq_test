<?php
use yii\widgets\ActiveForm;
use backend\models\excel;
use yii\helpers\Html;

/** @var yii\web\View $this */

$this->title = 'Task for freematiq';
?>
<div class="site-index">
<?php $form = ActiveForm::begin(['options'=>['enctype' => 'multipart/form-data']]);?>
<? $model = new excel();?>
<?= $form->field($model, 'file') ->fileInput()->label('Excel file');?>
<div class="form-group">
<?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>
</div>
