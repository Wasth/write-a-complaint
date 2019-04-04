<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m190404_081541_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'fio' => $this->string(100),
            'login' => $this->string()->unique(),
            'email' => $this->string()->unique(),
            'password' => $this->string(),
            'is_admin' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user}}');
    }
}
