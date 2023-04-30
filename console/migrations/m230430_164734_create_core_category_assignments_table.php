<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%core_category_assignments}}`.
 */
class m230430_164734_create_core_category_assignments_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable(
            '{{%core_category_assignments}}',
            [
                'product_id' => $this->integer()->notNull(),
                'category_id' => $this->integer()->notNull(),
            ],
            $tableOptions
        );

        $this->addPrimaryKey(
            '{{%pk-core_category_assignments}}',
            '{{core_category_assignments}}',
            ['product_id', 'category_id']
        );

        $this->createIndex(
            '{{%idx-core_category_assignments-product_id}}',
            '{{%core_category_assignments}}',
            'product_id'
        );
        $this->createIndex(
            '{{%idx-core_category_assignments-category_id}}',
            '{{%core_category_assignments}}',
            'category_id'
        );

        $this->addForeignKey(
            '{{%fk-core_category_assignments-product_id}}',
            '{{%core_category_assignments}}',
            'product_id',
            '{{%core_products}}',
            'id','CASCADE','RESTRICT'
        );

        $this->addForeignKey(
            '{{%fk-core_category_assignments-category_id}}',
            '{{%core_category_assignments}}',
            'category_id',
            '{{%core_categories}}',
            'id','CASCADE','RESTRICT'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropForeignKey('{{%fk-core_category_assignments-category_id}}', '{{%core_category_assignments}}');
        $this->dropForeignKey('{{%fk-core_category_assignments-product_id}}', '{{%core_category_assignments}}');

        $this->dropIndex('{{%idx-core_category_assignments-product_id}}', '{{%core_category_assignments}}');
        $this->dropIndex('{{%idx-core_category_assignments-category_id}}','{{%core_category_assignments}}');

        $this->dropPrimaryKey('{{%pk-core_category_assignments}}', '{{core_category_assignments}}');

        $this->dropTable('{{%core_category_assignments}}');
    }
}
