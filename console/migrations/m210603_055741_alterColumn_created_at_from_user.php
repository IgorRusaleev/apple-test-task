<?php

use yii\db\Migration;

/**
 * Class m210603_055741_alterColumn_created_at_from_user
 */
class m210603_055741_alterColumn_created_at_from_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn(
            'user',
            'created_at',
            $this->dateTime()->notNull()->defaultExpression('now()')
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn(
            'user',
            'created_at',
            $this->integer()->notNull()
        );
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210603_055741_alterColumn_created_at_from_user cannot be reverted.\n";

        return false;
    }
    */
}
