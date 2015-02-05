<?php

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

<?= $form->field($config, 'title')->textInput(['maxlength' => 255]) ?>
<?= $form->field($config, 'comment')->textInput(['maxlength' => 255]) ?>
<?= $form->field($config, 'parent_ID')->textInput(['maxlength' => 255]) ?>
