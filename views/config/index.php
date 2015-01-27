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
use yii\grid\GridView;
use yii\widgets\Pjax;
use julatools\configmanager\models\Config;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var julatools\user\models\UserSearch $searchModel
 */

$this->title = Yii::t('configmanager', 'Manage Configuration(Config-Sets)');
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?> <?= Html::a(Yii::t('configmanager', 'Create a Config-Set'), ['create'], ['class' => 'btn btn-success']) ?></h1>


<?php Pjax::begin() ?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel'  => $searchModel,
    'layout'  => "{items}\n{pager}",
    'columns' => [
        'title',
        'comment',
        'parent_ID',
        [
        'header' => Yii::t('configmanager', 'details'),
        'value' => function ($model) {
                    return Html::a(Yii::t('configmanager', 'Edit details'), ['details', 'id' => $model->ID], [
                    		'class' => 'btn btn-xs btn-success btn-block',
                    		'data-method' => 'post',
                    ]);
                
            },
            'format' => 'html',
        ],
		/*
        [
            'attribute' => 'created_at',
            'value' => function ($model) {
                return Yii::t('user', '{0, date, MMMM dd, YYYY HH:mm}', [$model->created_at]);
            }
        ],
        [
            'header' => Yii::t('user', 'Confirmation'),
            'value' => function ($model) {
                if ($model->isConfirmed) {
                    return '<div class="text-center"><span class="text-success">' . Yii::t('user', 'Confirmed') . '</span></div>';
                } else {
                    return Html::a(Yii::t('user', 'Confirm'), ['confirm', 'id' => $model->id], [
                        'class' => 'btn btn-xs btn-success btn-block',
                        'data-method' => 'post',
                        'data-confirm' => Yii::t('user', 'Are you sure you want to confirm this user?'),
                    ]);
                }
            },
            'format' => 'raw',
            'visible' => Yii::$app->getModule('user')->enableConfirmation
        ],
        [
            'header' => Yii::t('user', 'Block status'),
            'value' => function ($model) {
                if ($model->isBlocked) {
                    return Html::a(Yii::t('user', 'Unblock'), ['block', 'id' => $model->id], [
                        'class' => 'btn btn-xs btn-success btn-block',
                        'data-method' => 'post',
                        'data-confirm' => Yii::t('user', 'Are you sure you want to unblock this user?')
                    ]);
                } else {
                    return Html::a(Yii::t('user', 'Block'), ['block', 'id' => $model->id], [
                        'class' => 'btn btn-xs btn-danger btn-block',
                        'data-method' => 'post',
                        'data-confirm' => Yii::t('user', 'Are you sure you want to block this user?')
                    ]);
                }
            },
            'format' => 'raw',
        ],*/
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{update} {delete} {details}',
        ],
    ],
]); ?>

<?php Pjax::end() ?>
