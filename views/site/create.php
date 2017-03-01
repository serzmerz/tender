<?php

/**
 * This view render form for create new address
 */

use app\models\City;
use app\models\Country;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

?>

<h1>Создать</h1>
<div class="row">
    <div class="col-md-12">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'name')->label('Название места:') ?>

        <?= $form->field($model, 'country')->label('Страна:')->dropDownList(Country::dropdown(),
            ['style' => 'width:300px',
                'prompt' => 'Выберите страну',
                'onchange' => '
                $.post( "' . 'index.php?r=site/list&id=' . '"+$(this).val(), function( data ) {
                  $( "select#city" ).html( data );
                });
                 '
            ]);
        ?>

        <?= $form->field($model, 'city')->label('Город:')->dropDownList(City::dropdown(), ['style' => 'width:300px', 'id' => 'city',
            'prompt' => 'Выберите город',
        ]); ?>

        <?= $form->field($model, 'address')->label('Адрес:')->textInput(array('placeholder' => 'Например: Харьковская, 2')) ?>

        <div class="form-group">
            <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>
