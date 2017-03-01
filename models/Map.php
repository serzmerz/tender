<?php
/**
 * This model get and set data in db about address
 * validate form with rules
 */

namespace app\models;


use yii\db\ActiveRecord;

class Map extends ActiveRecord
{
    public function rules()
    {
        return [
            [['name', 'country', 'city', 'address'], 'required'],
            ['address', 'match', 'pattern' => '/^[а-яёА-Яё\s]+,\s\d+$/u'],
            ['address', 'string', 'length' => [1, 60]],
            ['name', 'string', 'length' => [1, 60]],
        ];
    }

}