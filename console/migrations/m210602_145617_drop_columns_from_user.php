<?php

use yii\db\Migration;

/**
 * Class m210602_145617_drop_columns_from_user
 */
class m210602_145617_drop_columns_from_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('user', 'username');
        $this->dropColumn('user', 'auth_key');
        $this->dropColumn('user', 'password_reset_token');
        $this->dropColumn('user', 'status');
        $this->dropColumn('user', 'updated_at');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn('user', 'updated_at', $this->integer()->notNull());
        $this->addColumn('user', 'status', $this->smallInteger()->notNull()->defaultValue(10));
        $this->addColumn('user', 'password_reset_token', $this->string()->unique());
        $this->addColumn('user', 'auth_key', $this->string(32)->notNull());
        $this->addColumn('user', 'username', $this->string()->notNull()->unique());
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210602_145617_drop_columns_from_user cannot be reverted.\n";

        return false;
    }
    */
}
