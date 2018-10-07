<?php

use yii\db\Migration;

/**
 * Class m181007_172717_create_test_tables_from_dump
 */
class m181007_172717_create_test_tables_from_dump extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute(
            file_get_contents(__DIR__ . '/dumps/test_db.sql')
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('orders');
        $this->dropTable('services');
    }
}
