<?php
use yii\base\Configurable;
use backend\models\sort;
use yii\widgets\ActiveForm;
use yii\web\Linkable;
use yii\widgets\LinkPager;
/** @var yii\web\View $this */
use yii\helpers\Html;
$this->title = 'Task for freematiq';
?>
<div class="site-index">
<div class="site-about">
<ul class="list-group">
<ul class="list-group list-group-horizontal">
  <li class="list-group-item" style="width: 150px">Login</li>
  <li class="list-group-item" style="width: 150px">Total money:</li>
</ul>

<?php foreach ($models as $model):?> 
<ul class="list-group list-group-horizontal">
<li class="list-group-item" style="width: 150px"><?php echo $model->login?></li>
<li class="list-group-item" style="width: 150px"><?php echo $model->sum?></li>
</ul>
<?endforeach;?>

<?php $form = ActiveForm::begin(); ?>

<?php $lol = new sort(); ?>
<?= $form->field($lol, 'sort')->radioList(array(1=>'default',2=>'login', 3=>'balance')); ?>
<div class="form-group">
<?= Html::submitButton('Sort', ['class' => 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>



<?php
// display pagination
echo LinkPager::widget([
    'pagination' => $pages,
]); ?>
</div>
   
</div>
