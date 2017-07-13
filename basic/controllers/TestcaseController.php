<?php
/**
 * Created by IntelliJ IDEA.
 * User: peter
 * Date: 13.07.2017
 * Time: 10:03
 */

namespace app\controllers;


use app\models\Testcase;
use yii\rest\ActiveController;

class TestcaseController extends ActiveController
{
    public $modelClass = Testcase::class;

}