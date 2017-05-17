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
        return $this->render('index');
    }

    /**
     * return about page
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
