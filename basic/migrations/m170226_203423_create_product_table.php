<?php

use yii\db\Migration;

/**
 * Handles the creation of table `product`.
 * Has foreign keys to the tables:
 *
 * - `brands`
 */
class m170226_203423_create_product_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('product', [
            'id' => $this->primaryKey(),
            'pro_ID' => $this->integer(11)->notNull(),
            'pro_Name' => $this->varchar(50)->notNull(),pro_CatID()->integer(11)->notNull(),
            'pro_ImID' => $this->integer(11)->notNull(),
            'pro_BraID' => $this->integer(11)->notNull(),
            'pro_LikeCount' => $this->integer(11)->notNull(),
            'pro_DislikeCount' => $this->integer(11)->notNull(),
            'pro_FirstPrice' => $this->integer(11)->notNull(),
            'pro_LastPrice' => $this->integer(11)->notNull(),
            'pro_OffPrice' => $this->integer(11)->notNull(),
            'pro_BasketCount' => $this->integer(11)->notNull(),
            'pro_CoID' => $this->integer(11)->notNull(),
            'pro_TagID' => $this->integer(11)->notNull(),
            'pro_Code' => $this->integer(11)->notNull(),
            'pro_Description' => $this->text(),
        ]);

        // creates index for column `pro_BraID`
        $this->createIndex(
            'idx-product-pro_BraID',
            'product',
            'pro_BraID'
        );

        // add foreign key for table `brands`
        $this->addForeignKey(
            'fk-product-pro_BraID',
            'product',
            'pro_BraID',
            'brands',
            'bra_ID',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `brands`
        $this->dropForeignKey(
            'fk-product-pro_BraID',
            'product'
        );

        // drops index for column `pro_BraID`
        $this->dropIndex(
            'idx-product-pro_BraID',
            'product'
        );

        $this->dropTable('product');
    }
}
