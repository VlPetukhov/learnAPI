<?php
namespace app\models;

use Yii;
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
    const CREATE_SCENARIO = 'create';
    const UPDATE_SCENARIO = 'update';
    const UPDATE_PASSWORD_SCENARIO = 'updatePassword';

    /**
     * @var string
     */
    public $password;

    /**
     * @return string
     */
    public static function tableName() {
        return '{{user}}';
    }

    /**
     * @return array
     */
    public function rules() {
        return [
            [['email'], 'required', 'on' => [self::CREATE_SCENARIO, self::UPDATE_SCENARIO]],
            [['password'], 'required', 'on' => [self::CREATE_SCENARIO, self::UPDATE_PASSWORD_SCENARIO]],
            [['email'], 'email', 'on' => [self::CREATE_SCENARIO, self::UPDATE_SCENARIO]],
            [
                ['password'],
                'string',
                'min' => 7,
                'on' => [self::CREATE_SCENARIO, self::UPDATE_SCENARIO, self::UPDATE_PASSWORD_SCENARIO]
            ],
            [
                ['password'],
                'match',
                'pattern' => '/^([\S]+[~!@#$%^&*()][\S]*)|([\S]*[~!@#$%^&*()][\S]+)$/i',
                'message' => 'Should have at least one special char like following: ~ ! @ # $ % ^ & * ( )',
                'on' => [self::CREATE_SCENARIO, self::UPDATE_SCENARIO, self::UPDATE_PASSWORD_SCENARIO]
            ],
            [['language'], 'string', 'max' => 6],
        ];
    }

    /**
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        if ($this->password) {
            $this->passwdHash = Yii::$app->getSecurity()->generatePasswordHash($this->password);
        }

        return true;
    }
}
