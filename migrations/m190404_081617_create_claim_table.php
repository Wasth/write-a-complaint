<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%claim}}`.
 */
class m190404_081617_create_claim_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%claim}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'description' => $this->text(),

            'category_id' => $this->integer(),
            'user_id' => $this->integer(),

            'status' => $this->string(),
            'photo_before' => $this->string(),
            'photo_after' => $this->string(),
            'created_at' => $this->dateTime()->defaultExpression('NOW()'),
        ]);
        $this->addForeignKey('fk-claim-category_id-category-id',
            'claim', 'category_id',
            'category', 'id', 'CASCADE');
        $this->addForeignKey('fk-claim-user_id-user-id',
            'claim', 'user_id',
            'user', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-claim-category_id-category-id','claim');
        $this->dropForeignKey('fk-claim-user_id-user-id','claim');

        $this->dropTable('{{%claim}}');
    }
}
