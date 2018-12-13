<?php

use yii\db\Migration;

/**
 * Handles the creation of table `notes`.
 */
class m181213_010248_create_notes_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('notes', [
            'id' => $this->primaryKey(),
            'title' => $this->string(50)->notNull(),
            'status' => $this->integer(1),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('notes');
    }
}
