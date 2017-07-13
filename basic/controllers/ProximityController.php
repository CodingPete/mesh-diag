<?php
/**
 * Created by IntelliJ IDEA.
 * User: peter
 * Date: 13.07.2017
 * Time: 11:02
 */

namespace app\controllers;


use app\models\Proximity;
use yii\rest\ActiveController;

class ProximityController extends ActiveController
{
    public $modelClass = Proximity::class;
}