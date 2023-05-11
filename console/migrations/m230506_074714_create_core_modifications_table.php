<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%core_modifications}}`.
 */
class m230506_074714_create_core_modifications_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        $this->createTable(
            '{{%core_modifications}}',
            [
                'product_id' => $this->integer()->notNull(),
                'code'       => $this->string()->notNull(),
                'name'       => $this->string()->notNull(),
                'price'      => $this->integer(),
            ],
            $tableOptions
        );
        $this->createIndex('{{%idx-core_modifications-code}}', '{{%core_modifications}}', 'code');
        $this->createIndex(
            '{{%idx-core_modifications-product_id-code}}',
            '{{%core_modifications}}',
            ['product_id', 'code'],
            true
        );
        $this->createIndex('{{%idx-core_modifications-product_id}}', '{{%core_modifications}}', 'product_id');

        $this->addForeignKey(
            '{{%fk-core_modifications-product_id}}',
            '{{%core_modifications}}',
            'product_id',
            '{{%core_products}}',
            'id',
            'CASCADE',
            'RESTRICT'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropForeignKey('{{%fk-core_modifications-product_id}}', '{{%core_modifications}}');
        $this->dropIndex('{{%idx-core_modifications-product_id}}', '{{%core_modifications}}');
        $this->dropIndex('{{%idx-core_modifications-product_id-code}}', '{{%core_modifications}}');
        $this->dropIndex('{{%idx-core_modifications-code}}', '{{%core_modifications}}');

        $this->dropTable('{{%core_modifications}}');
    }
}
