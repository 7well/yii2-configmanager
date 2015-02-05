<?php
use yii\helpers\ArrayHelper;
use 7well\configmanager\models\Config;
/*
 * This file is part of the 7well project.
 *
 * (c)2015 7well project <http://github.com/7well>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

/**
 * @var yii\widgets\ActiveForm    $form
 * @var 7well\user\models\Config $config
 */
?>

<?= $form->field($config, 'config_ID')->dropDownList(ArrayHelper::map(Config::find()->all(), 'ID', 'title'), ['prompt'=>'---Select---']) ?>

