<?php
use yii\helpers\ArrayHelper;
use julatools\configmanager\models\Config;
/*
 * This file is part of the Julatools project.
 *
 * (c)2015 Julatools project <http://github.com/julatools>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

/**
 * @var yii\widgets\ActiveForm    $form
 * @var julatools\user\models\Config $config
 */
?>

<?= $form->field($config, 'config_ID')->dropDownList(ArrayHelper::map(Config::find()->all(), 'ID', 'title'), ['prompt'=>'---Select---']) ?>

