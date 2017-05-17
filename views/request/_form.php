<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Request */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="request-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'cost')->textInput() ?>

    <?= $form->field($model, 'deadline')->textInput() ?>

    <?= $form->field($model, 'company')->label('Company:')->dropDownList(\app\models\Company::dropdown(), ['style' => 'width:300px', 'id' => 'name',
        'prompt' => 'Select the company',
    ]); ?>

    <?= $form->field($model, 'id_tender')->label('Tender:')->dropDownList(\app\models\Tenders::dropdown(), ['style' => 'width:300px', 'id' => 'name',
        'prompt' => 'Select the tender',
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
