<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%task}}`.
 */
class m210814_125322_create_task_table extends Migration
{
    private $tableName = 'task';
    private $refTableName = 'user';

    public function safeUp(): bool
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'taskName' => $this->text()->notNull(),
            'description' => $this->text(),
            'user_id' => $this->integer()->notNull(),
            'status' => $this->string(125)->notNull(),
            'deadline' => $this->date()->notNull(),
            'finished_at' => $this->date()->defaultValue(null),
            'outdated' => $this->boolean()->defaultValue(false)
        ]);

        $this->addForeignKey('FKTRACUSER', $this->tableName,
            'user_id', $this->refTableName, 'id', 'CASCADE');

        return true;
    }

    public function safeDown(): bool
    {
        $this->dropTable($this->tableName);

        return false;
    }
}
