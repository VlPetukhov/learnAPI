<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m180529_080807_user_stat_table_creation
 */
class m180529_080807_user_stat_table_creation extends Migration
{
    private $tableName = "user_stat";
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;

        if ("mysql" === $this->db->driverName) {
            $tableOptions = "ENGINE=MyISAM";
        }

        $this->createTable(
            $this->tableName,
            [
                "id"          => Schema::TYPE_PK,
                "user_id"     => Schema::TYPE_INTEGER . " NOT NULL",
                "ip"          => Schema::TYPE_STRING,
                "loggedin_at" => Schema::TYPE_TIMESTAMP . " DEFAULT CURRENT_TIMESTAMP",
                "user_agent"  => Schema::TYPE_STRING,
            ],
            $tableOptions
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
        echo "m180529_080807_user_stat_table_creation cannot be reverted.\n";

        return false;
    }
    */
}
