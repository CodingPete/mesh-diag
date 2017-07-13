<?php
/**
 * Created by IntelliJ IDEA.
 * User: peter
 * Date: 13.07.2017
 * Time: 10:03
 */

namespace app\controllers;


use app\models\Sample;
use yii\rest\ActiveController;

class DiagnoseController extends ActiveController
{
    public $modelClass = Sample::class;

}