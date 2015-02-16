<?php

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

<?= $form->field($config, 'title')->textInput(['maxlength' => 255]) ?>
<?= $form->field($config, 'comment')->textInput(['maxlength' => 255]) ?>
<?= $form->field($config, 'parent_ID')->textInput(['maxlength' => 255]) ?>
