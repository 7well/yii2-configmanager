<?php

/*
 * This file is part of the Jultatools project.
 *
 * (c) Julatools project <http://github.com/julatools>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View                 $this
 * @var julatools\configmanager\models\Parameter    $parameter
 * @var julatools\configmanager\Module         $module
 */

$configparameter = $model;
$this->title = Yii::t('configmanager', 'Update Config-Parameter');
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
        <?= $this->render('_configparameter', ['form' => $form, 'config' => $configparameter]) ?>
        <?= Html::submitButton(Yii::t('configmanager', 'Save'), ['class' => 'btn btn-primary btn-sm']) ?>
    </div>
</div>






<?php ActiveForm::end(); ?>
