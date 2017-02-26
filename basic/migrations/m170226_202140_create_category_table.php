<?php

use yii\db\Migration;

/**
 * Handles the creation of table `category`.
 */
class m170226_202140_create_category_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('category', [
            'id' => $this->primaryKey(),
            'cat_ID' => $this->integer(11)->notNull(),
            'cat_Name' => $this->varchar(50)->notNull(),
            'cat_parentID' => $this->integer(11)->notNull(),
            'cat_Specification' => $this->varchar(200)->notNull(),
            'cat_imageID' => $this->integer(11)->notNull(),
            
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('category');
    }
}
