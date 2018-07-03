<?php

use yii\db\Migration;

/**
 * Class m180701_093659_order
 */
class m180701_093659_order extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
$tableOptions = null; //Хотя опции не указываем, но переменную заводим на будущее
		
        //Опции для mysql, чтобы параметры таблицы в БД не были такими какие не нужны
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        //Создание таблицы, хранящая все счета
        $this->createTable('{{%order}}', [
        'id' => $this->primaryKey(),
        'quantity' => $this->double(),
		'account_id' => $this->integer()->notNull(),
		'service_id' => $this->integer()->notNull(),
        ], $tableOptions);
		
		
		//Внешний ключ продавцов
		$this->addForeignKey(
		'fk-order-account_id',
		'order',
		'account_id',
		'account',
		'id',
		'CASCADE'
		);
		
		//Внешний ключ покупателей
		$this->addForeignKey(
		'fk-order-service_id',
		'order',
		'service_id',
		'service',
		'id',
		'CASCADE'
		);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-order-account_id',
            'order'
        );
		
		$this->dropForeignKey(
            'fk-order-service_id',
            'order'
        );
		$this->dropTable('{{%order}}');
		
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180701_093659_order cannot be reverted.\n";

        return false;
    }
    */
}
