<?php
use yii\base\Configurable;
use yii\web\Linkable;
use yii\widgets\LinkPager;
/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'Operations';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
<ul class="list-group">
<ul class="list-group list-group-horizontal">
<li class="list-group-item" style="width: 150px">Who</li>
<li class="list-group-item" style="width: 150px">Which</li>
  <li class="list-group-item" style="width: 150px">Count</li>
  <li class="list-group-item" style="width: 150px">When</li>
  <li class="list-group-item" style="width: 150px">Type</li>

</ul>

<?php foreach ($models as $model):?> 
<ul class="list-group list-group-horizontal">
<li class="list-group-item" style="width: 150px"><?php echo $model->login?></li>
<li class="list-group-item" style="width: 150px"><?php echo $model->final_login?></li>
<li class="list-group-item" style="width: 150px"><?php echo $model->sum?></li>
<li class="list-group-item" style="width: 150px"><?php echo $model->date?></li>
<?php if ($model->type):?>
<li class="list-group-item" style="width: 150px">Send</li>
<?php elseif (!$model->type):?>
<li class="list-group-item" style="width: 150px">Get</li>
<?endif?>
</ul> 
<?endforeach;?>

<?php
// display pagination
echo LinkPager::widget([
    'pagination' => $pages,
]); ?>
</div>
