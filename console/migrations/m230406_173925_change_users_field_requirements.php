<?php

use yii\db\Migration;

/**
 * Class m230406_173925_change_users_field_requirements
 */
class m230406_173925_change_users_field_requirements extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->alterColumn('{{users}}', 'username', $this->string());
        $this->alterColumn('{{users}}', 'password_hash', $this->string());
        $this->alterColumn('{{users}}', 'email', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->alterColumn('{{users}}', 'username', $this->string()->notNull()->unique());
        $this->alterColumn('{{users}}', 'password_hash', $this->string()->notNull());
        $this->alterColumn('{{users}}', 'email', $this->string()->notNull()->unique());
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230406_173925_change_users_field_requirements cannot be reverted.\n";

        return false;
    }
    */
}
