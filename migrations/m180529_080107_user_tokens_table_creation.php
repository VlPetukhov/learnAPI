<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m180529_080107_user_tokens_table_creation
 */
class m180529_080107_user_tokens_table_creation extends Migration
{
    private $tableName = "user_tokens";
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(
            $this->tableName,
            [
                "id"      => Schema::TYPE_PK,
                "token"   => Schema::TYPE_STRING . "(40) NOT NULL",
                "user_id" => Schema::TYPE_INTEGER . " NOT NULL",
                "type"    => Schema::TYPE_STRING . " NOT NULL",
                "expired_at" => Schema::TYPE_TIMESTAMP . " NOT NULL",
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
        echo "m180529_080107_user_tokens_table_creation cannot be reverted.\n";

        return false;
    }
    */
}
