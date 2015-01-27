<?php

/*
 * This file is part of the Julatools project.
 *
 * (c) Julatools project <http://github.com/julatools>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View              $this
 * @var julatools\user\models\User $user
 */

$this->title = Yii::t('configmanager', 'Add Parameter to Config-Set');
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

        <?= $this->render('_configparameter', ['form' => $form, 'config' => $configparameter]) ?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('configmanager', 'Save'), ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
