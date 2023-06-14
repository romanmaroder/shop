<?php

use yii\db\Migration;

/**
 * Class m230614_114452_add_core_product_status_field
 */
class m230614_114452_add_core_product_status_field extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->addColumn('{{%core_products}}', 'status', $this->smallInteger()->notNull());
        $this->update('{{core_products}}', ['status' => 1]);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropColumn('{{core_products}}', 'status');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230614_114452_add_core_product_status_field cannot be reverted.\n";

        return false;
    }
    */
}
