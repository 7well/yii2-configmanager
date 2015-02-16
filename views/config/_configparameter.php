<?php
use yii\helpers\ArrayHelper;
use chd7well\configmanager\models\Parameter;
/*
 * This file is part of the chd7well project.
 *
 * (c)2015 chd7well project <http://github.com/chd7well>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

/**
 * @var yii\widgets\ActiveForm    $form
 * @var chd7well\user\models\Config $config
 */

?>

<?= $form->field($config, 'parameter_ID')->dropDownList(ArrayHelper::map(Parameter::find()->all(), 'ID', 'parametername')) ?>
<?= $form->field($config, 'value')->textInput() ?>

