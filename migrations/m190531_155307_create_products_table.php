<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%products}}`.
 */
class m190531_155307_create_products_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
	    $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable('{{%products}}', [
            'id' => $this->primaryKey(),
	        'name' => $this->string()->notNull(),
	        'summary' => $this->text(),
	        'body' => $this->text(),
	        'price' => $this->integer()->notNull(),
	        'slug' => $this->string()->unique(),
	        'status' => $this->string(16),
	        'created_at' => $this->integer(),
	        'updated_at' => $this->integer(),
	        'title' => $this->string(),
	        'keywords' => $this->string(),
	        'description' => $this->text(),
        ], $tableOptions);

		$this->createIndex('idx-product-slug', '{{%products}}', 'slug', true);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
    	$this->dropIndex('idx-product-slug', '{{%products}}');
        $this->dropTable('{{%products}}');
    }
}
