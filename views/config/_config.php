<?php

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

<?= $form->field($config, 'title')->textInput(['maxlength' => 255]) ?>
<?= $form->field($config, 'comment')->textInput(['maxlength' => 255]) ?>
<?= $form->field($config, 'parent_ID')->textInput(['maxlength' => 255]) ?>
