<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m180529_054400_user_table_creation
 */
class m180529_054400_user_table_creation extends Migration
{
    private $tableName = "user";
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(
            $this->tableName,
            [
                "id"         => Schema::TYPE_PK,
                "email"      => Schema::TYPE_STRING . " NOT NULL",
                "passwdHash" => Schema::TYPE_STRING . "(40) NOT NULL",
                "name"       => Schema::TYPE_STRING . " DEFAULT \"\"",
                "language"   => Schema::TYPE_STRING . "(6) ",
                "created_at"    => Schema::TYPE_TIMESTAMP . " DEFAULT CURRENT_TIMESTAMP",
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable($this->tableName);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180529_054400_user_table_creation cannot be reverted.\n";

        return false;
    }
    */
}
