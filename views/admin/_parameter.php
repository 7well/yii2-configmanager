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
 * @var julatools\user\models\User $user
 */

?>

<?= $form->field($parameter, 'parametername')->textInput(['maxlength' => 255]) ?>
<?= $form->field($parameter, 'value')->textInput(['maxlength' => 255]) ?>
<?= $form->field($parameter, 'defaultvalue')->textInput(['maxlength' => 255]) ?>
<?= $form->field($parameter, 'bootstrap')->checkBox() ?>
