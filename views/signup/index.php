<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Регистрация';

?>
<div class="center-block">
    <div class="registration-form regular-form">
        <?php $form = ActiveForm::begin([
            'id' => 'registration-form',
            'fieldConfig' => [
                'template' => "{label}\n{input}\n{error}",
                'labelOptions' => ['class' => 'control-label'],
            ],
        ]); ?>
            <h3 class="head-main head-task">Регистрация нового пользователя</h3>
            <div class="form-group"></div>
            <?= $form->field($model, 'name')->textInput(); ?>
            <div class="half-wrapper">
                <div class="form-group">
                    <?= $form->field($model, 'email')->textInput(); ?>
                </div>
                <div class="form-group">
                    <?= $form->field($model, 'city_id')->dropDownList($city)->label('Город'); ?>
                </div>
            </div>
            <div class="form-group">
                <?= $form->field($model, 'password')->passwordInput(); ?>
            </div>
            <div class="form-group">
                <?= $form->field($model, 'repeat_password')->passwordInput(); ?>
            </div>
            <div class="form-group">
                <?= $form->field($model, 'is_executor', ['template' => "{input}\n{label}"])->checkbox(['label' => ''], false)->label('Собираюсь откликаться на заказы'); ?>
            </div>
            <?= Html::submitButton('Создать аккаунт', ['class' => 'button button--blue']); ?>
        <?php ActiveForm::end(); ?>
    </div>
</div>
