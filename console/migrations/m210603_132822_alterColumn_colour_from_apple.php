<?php

use yii\db\Migration;

/**
 * Class m210603_132822_alterColumn_colour_from_apple
 */
class m210603_132822_alterColumn_colour_from_apple extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn(
            'apple',
            'colour',
            $this->string(45)->notNull()->defaultValue('зеленое'),
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn(
            'apple',
            'colour',
            $this->tinyInteger()->defaultValue('1'),
        );
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210603_132822_alterColumn_colour_from_apple cannot be reverted.\n";

        return false;
    }
    */
}
