<?php
/**
 * Created by IntelliJ IDEA.
 * User: peter
 * Date: 13.07.2017
 * Time: 12:05
 */

namespace app\controllers;


use app\models\Remote;
use yii\rest\ActiveController;

class RemoteController extends ActiveController
{
    public $modelClass = Remote::class;
}