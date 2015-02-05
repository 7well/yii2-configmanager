<?php

/*
 * This file is part of the 7well project.
 *
 * (c) 7well project <http://github.com/7well>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View              $this
 * @var 7well\user\models\User $user
 */

$this->title = Yii::t('configmanager', 'Create a config-set');
$this->params['breadcrumbs'][] = ['label' => Yii::t('configmanager', 'Config'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="panel panel-default">
    <div class="panel-heading">
        <?= Html::encode($this->title) ?>
    </div>
    <div class="panel-body">
        <?php $form = ActiveForm::begin([
            'enableAjaxValidation'   => true,
            'enableClientValidation' => false
        ]); ?>

        <?= $this->render('_config', ['form' => $form, 'config' => $config]) ?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('configmanager', 'Save'), ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
