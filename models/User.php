<?php
namespace app\models;

use yii\db\ActiveRecord;

/**
 * User model
 *
 * @property $id int
 * @property $email string
 * @property $passwdHash string
 * @property $name string
 * @property $language string
 * @property $created int
 */
class User extends ActiveRecord
{
    public static function tableName() {
        return "{{user}}";
    }
}
