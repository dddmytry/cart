<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%order_items}}`.
 */
class m190603_203010_create_order_items_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
	    $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable('{{%order_items}}', [
            'id' => $this->primaryKey(),
	        'order_id' => $this->integer()->notNull(),
	        'product_id' => $this->integer(),
	        'product_name' => $this->string(),
	        'price' => $this->integer()->notNull(),
	        'quantity' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex('idx-order_items-order-id', '{{%order_items}}', 'order_id');
        $this->createIndex('idx-order_items-product_id', '{{%order_items}}', 'product_id');

        $this->addForeignKey('fk-order_items-order-id-id', '{{%order_items}}', 'order_id', '{{%orders}}', 'id', 'CASCADE');
	    $this->addForeignKey('fk-order_items-product-id-id', '{{%order_items}}', 'product_id', '{{%products}}', 'id', 'SET NULL');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
    	$this->dropForeignKey('fk-order_items-product-id-id', '{{%order_items}}');
    	$this->dropForeignKey('fk-order_items-order-id-id', '{{%order_items}}');
    	$this->dropIndex('idx-order_items-product_id', '{{%order_items}}');
    	$this->dropIndex('idx-order_items-order-id', '{{%order_items}}');
        $this->dropTable('{{%order_items}}');
    }
}
