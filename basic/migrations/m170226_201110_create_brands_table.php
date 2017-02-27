<?php

use yii\db\Migration;

/**
 * Handles the creation of table `brands`.
 */
class m170226_201110_create_brands_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('brands', [
            'id' => $this->primaryKey(),
            'bra_ID' => $this->integer(11)->notNull(),
            'bra_Name' => $this->varchar(50)->notNull(),
            'bra_Description' => $this->text()->notNull(),
            'bra_ImID' => $this->integer(11)->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('brands');
    }
}
