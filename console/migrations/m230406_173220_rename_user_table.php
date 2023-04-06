<?php

use yii\db\Migration;

/**
 * Class m230406_173220_rename_user_table
 */
class m230406_173220_rename_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->renameTable('{{user}}', '{{users}}');
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->renameTable('{{users}}', '{{user}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230406_173220_rename_user_table cannot be reverted.\n";

        return false;
    }
    */
}
