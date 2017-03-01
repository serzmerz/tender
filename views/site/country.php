<?php

/**
 * This view render address list
 */

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

?>
<h2>Добавить адрес:</h2>
<a href="index.php?r=site/create" class="btn btn-primary">Добавить</a>
<h2>Список адресов:</h2>

<ul>

    <?php foreach ($countries as $country): ?>

        <li>

            <?= Html::encode("
        Название: {$country->name} 
        Страна: {$country->country} 
        Город: {$country->city} 
        Адрес: {$country->address} ") ?>

            <a href="http://www.google.com.ua/maps/place/
            <?php echo $country->address ?>
            ,+<?php echo $country->city ?>
            ,+<?php echo $country->country ?>/"
               target="_blank">Предпросмотр</a> |
            <a href="index.php?r=site/delete&id=<?= $country->id ?>">Удалить</a>

        </li>

    <?php endforeach; ?>

</ul>


