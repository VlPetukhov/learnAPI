<?php

namespace tests\models;

use app\models\User;
use Yii;

class UserTest extends \Codeception\Test\Unit
{
    public function testUserValidation()
    {
        $userData = [
            "email" => "test@email.io",
            "name" => "John Doe",
            "language" => "en_GB",
            "password" => "qazwsx!123",
        ];

        $userData2 = [
            "email" => "test@email.me",
            "name" => "John Doe 2",
            "language" => "en_US",
        ];

        $user = new User(['scenario' => User::CREATE_SCENARIO]);

        $user->setAttributes($userData);

        $this->assertTrue($user->validate());

        $user = new User(['scenario' => User::CREATE_SCENARIO]);
        $user->setAttributes($userData2);
        $this->assertFalse($user->validate());
        $this->assertTrue(array_key_exists('password', $user->errors));

        $user = new User(['scenario' => User::UPDATE_SCENARIO]);
        $user->setAttributes($userData2);
        $this->assertTrue($user->validate());

        $user = new User(['scenario' => User::UPDATE_PASSWORD_SCENARIO]);
        $user->setAttributes(['password' => '']);
        $this->assertFalse($user->validate());
        $this->assertTrue(array_key_exists('password', $user->errors));
    }

    public function testUserSaving()
    {
        $userData = [
            "email" => "test@email.io",
            "name" => "John Doe",
            "language" => "en_GB",
            "password" => "qazwsx!123",
        ];

        $user = new User(['scenario' => User::CREATE_SCENARIO]);
        $user->setAttributes($userData);

        $this->assertTrue($user->save());

        $this->assertTrue(Yii::$app->getSecurity()->validatePassword($userData["password"], $user->passwdHash));

        $this->assertEquals(1, $user->delete());
    }
}
