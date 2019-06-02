<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product_photos}}`.
 */
class m190531_164431_create_product_photos_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
	    $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable('{{%product_photos}}', [
            'id' => $this->primaryKey(),
	        'product_id' => $this->integer()->notNull(),
	        'file' => $this->string(),
	        'sort' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex('idx-product_photos-product_id-id', '{{%product_photos}}', 'product_id');

        $this->addForeignKey('fk-product_photos-product_id-id', '{{%product_photos}}', 'product_id', '{{%products}}', 'id', 'CASCADE', 'RESTRICT');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
    	$this->dropForeignKey('fk-product_photos-product_id-id', '{{%product_photos}}');
    	$this->dropIndex('idx-product_photos-product_id-id', '{{%product_photos}}');
        $this->dropTable('{{%product_photos}}');
    }
}
