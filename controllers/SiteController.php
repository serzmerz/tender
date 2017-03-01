<?php

namespace app\controllers;

use app\models\City;
use app\models\Country;
use app\models\Map;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;

class SiteController extends Controller
{

    /**
     * redirect on country list
     * @return \yii\web\Response
     */
    public function actionIndex()
    {
        return $this->redirect(['country']);
    }


    /**
     * return about page
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * create new address and redirect on country list
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Map();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $countryName = Country::findOne(Yii::$app->request->post()['Map']['country']);
            $model->country = $countryName->name;
            $model->save();

            return $this->redirect(['country']);

        } else {
            return $this->render('create', ['model' => $model]);
        }
    }

    /**
     * rendering page with country list
     * @return string
     */
    public function actionCountry()
    {

        $query = Map::find();
        $countries = $query->all();

        return $this->render('country', ['countries' => $countries]);
    }

    /**
     * return list with city in selected country by id
     * @param $id
     */
    public function actionList($id)
    {

        $countcity = City::find()->where(['id_country' => $id])->count();
        $city = City::find()->where(['id_country' => $id])->orderBy('id DESC')->all();

        if ($countcity > 0) {
            foreach ($city as $result) echo "<option value='" . $result->name . "'>" . $result->name . "</option>";
        } else {
            echo "<option>-</option>";
        }
    }

    /**
     * delete selected address
     * @param $id
     * @return \yii\web\Response
     */
    public function actionDelete($id)
    {

        $model = Map::findOne($id);
        $model->delete();

        return $this->redirect(['country']);
    }
}
