<?php

/*
 * This file is part of the Jultatools project.
 *
 * (c) chd7well project <http://github.com/chd7well>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View                 $this
 * @var chd7well\configmanager\models\Parameter    $parameter
 * @var chd7well\configmanager\Module         $module
 */

$config = $model;
$this->title = Yii::t('configmanager', 'Update Config');
$this->params['breadcrumbs'][] = ['label' => Yii::t('configmanager', 'Config'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>


<?php $form = ActiveForm::begin([
    'enableAjaxValidation'   => true,
    'enableClientValidation' => false
]); ?>

<!-- 
<div class="panel panel-default">
    <div class="panel-body">
        <?= Html::submitButton(Yii::t('configmanager', 'Save'), ['class' => 'btn btn-primary btn-sm']) ?>
        
    </div>
</div>-->

<div class="panel panel-default">
    <div class="panel-heading">
        <?= Html::encode($this->title) ?>
    </div>
    <div class="panel-body">
        <?= $this->render('_config', ['form' => $form, 'config' => $config]) ?>
        <?= Html::submitButton(Yii::t('configmanager', 'Save'), ['class' => 'btn btn-primary btn-sm']) ?>
    </div>
</div>






<?php ActiveForm::end(); ?>
