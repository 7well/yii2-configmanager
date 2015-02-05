<?php

/*
 * This file is part of the Jultatools project.
 *
 * (c) 7well project <http://github.com/7well>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View                 $this
 * @var 7well\configmanager\models\Parameter    $parameter
 * @var 7well\configmanager\Module         $module
 */

$parameter = $model;
$this->title = Yii::t('configmanager', 'Update parameter');
$this->params['breadcrumbs'][] = ['label' => Yii::t('configmanager', 'Parameter'), 'url' => ['index']];
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
        <?= $this->render('_parameter', ['form' => $form, 'parameter' => $parameter]) ?>
        <?= Html::submitButton(Yii::t('configmanager', 'Save'), ['class' => 'btn btn-primary btn-sm']) ?>
    </div>
</div>






<?php ActiveForm::end(); ?>
