<?php
namespace app\controllers;

use app\models\User;

/**
 * Class UserController
 */
class UserController extends \yii\rest\ActiveController
{
    public $modelClass = User::class;

    public $createScenario = User::CREATE_SCENARIO;
    public $updateScenario = User::UPDATE_SCENARIO;
}
