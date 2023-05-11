<?php

use yii\db\Migration;

/**
 * Class m230511_121032_create_core_product_main_photo_field
 */
class m230511_121032_create_core_product_main_photo_field extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->addColumn('{{%core_products}}', 'main_photo_id', $this->integer());

        $this->createIndex('{{%idx-core_products-main_photo_id}}', '{{%core_products}}', 'main_photo_id');

        $this->addForeignKey(
            '{{%fk-core_products-main_photo_id}}',
            '{{%core_products}}',
            'main_photo_id',
            '{{%core_photos}}',
            'id',
            'SET NULL',
            'RESTRICT'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropForeignKey('{{%fk-core_products-main_photo_id}}', '{{%core_products}}');

        $this->dropColumn('{{%core_products}}', 'main_photo_id');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230511_121032_create_core_product_main_photo_field cannot be reverted.\n";

        return false;
    }
    */
}
