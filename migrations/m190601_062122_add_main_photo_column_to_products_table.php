<?php

use yii\db\Migration;

/**
 * Handles adding main_photo to table `{{%products}}`.
 */
class m190601_062122_add_main_photo_column_to_products_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%products}}', 'main_photo', $this->integer()->after('name'));

        $this->createIndex('idx-main-photo', '{{%products}}', 'main_photo');

        $this->addForeignKey('fk-product-main-photo-id', '{{%products}}', 'main_photo', '{{%product_photos}}', 'id', 'CASCADE', 'RESTRICT');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
    	$this->dropForeignKey('fk-product-main-photo-id', '{{%products}}');
    	$this->dropIndex('idx-main-photo', '{{%products}}');
        $this->dropColumn('{{%products}}', 'main_photo');
    }
}
