<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m210814_125006_create_user_table extends Migration
{
    private $tableName = 'user';

    public function safeUp(): bool
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'name' => $this->string(250)->notNull(),
            'surname' => $this->string(250)->notNull(),
        ]);

        return true;
    }

    public function safeDown(): bool
    {
        $this->dropTable($this->tableName);

        return false;
    }
}