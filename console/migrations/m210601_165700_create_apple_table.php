<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%apple}}`.
 */
class m210601_165700_create_apple_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('apple', [
            'id' => $this->primaryKey(),
            'colour' => $this->tinyInteger()->defaultValue('1'),
            'dt_add' => $this->dateTime()->notNull()->defaultExpression('now()'),
            'dt_fall' => $this->dateTime(),
            'status' => $this->tinyInteger()->defaultValue('1'),
            'size' => $this->tinyInteger()->defaultValue('100'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('apple');
    }
}
