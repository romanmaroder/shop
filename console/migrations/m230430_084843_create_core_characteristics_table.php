<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%core_characteristics}}`.
 */
class m230430_084843_create_core_characteristics_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        $this->createTable(
            '{{%core_characteristics}}',
            [
                'id'            => $this->primaryKey(),
                'name'          => $this->string()->notNull(),
                'type'          => $this->string()->notNull(),
                'required'      => $this->boolean()->notNull(),
                'default'       => $this->string(),
                'variants_json' => 'JSON NOT NULL',
                'sort'          => $this->integer()->notNull(),
            ], $tableOptions
        );
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('{{%core_characteristics}}');
    }
}
