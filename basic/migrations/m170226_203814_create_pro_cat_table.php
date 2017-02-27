<?php

use yii\db\Migration;

/**
 * Handles the creation of table `pro_cat`.
 * Has foreign keys to the tables:
 *
 * - `product`
 * - `category`
 */
class m170226_203814_create_pro_cat_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('pro_cat', [
            'id' => $this->primaryKey(),
            'pro_ID' => $this->integer(11)->notNull(),
            'cat_ID' => $this->integer(11)->notNull(),
        ]);

        // creates index for column `pro_ID`
        $this->createIndex(
            'idx-pro_cat-pro_ID',
            'pro_cat',
            'pro_ID'
        );

        // add foreign key for table `product`
        $this->addForeignKey(
            'fk-pro_cat-pro_ID',
            'pro_cat',
            'pro_ID',
            'product',
            'pro_ID',
            'CASCADE'
        );

        // creates index for column `cat_ID`
        $this->createIndex(
            'idx-pro_cat-cat_ID',
            'pro_cat',
            'cat_ID'
        );

        // add foreign key for table `category`
        $this->addForeignKey(
            'fk-pro_cat-cat_ID',
            'pro_cat',
            'cat_ID',
            'category',
            'cat_ID',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `product`
        $this->dropForeignKey(
            'fk-pro_cat-pro_ID',
            'pro_cat'
        );

        // drops index for column `pro_ID`
        $this->dropIndex(
            'idx-pro_cat-pro_ID',
            'pro_cat'
        );

        // drops foreign key for table `category`
        $this->dropForeignKey(
            'fk-pro_cat-cat_ID',
            'pro_cat'
        );

        // drops index for column `cat_ID`
        $this->dropIndex(
            'idx-pro_cat-cat_ID',
            'pro_cat'
        );

        $this->dropTable('pro_cat');
    }
}
