<?php

use yii\db\Migration;

/**
 * Class m180629_081449_account
   Таблица 'Счета'
 */
class m180629_081449_account extends Migration
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
        $this->createTable('{{%account}}', [
        'id' => $this->primaryKey(),
        'name' => $this->string(50)->notNull(),
		'seller_id' => $this->integer()->notNull(),
		'buyer_id' => $this->integer()->notNull(),
		'measurement_unit' => $this->string(12),
		'quantity' => $this->double(),
		'price' => $this->double(),
		'date' => $this->date()
        ], $tableOptions);
		
		
		//Внешний ключ продавцов
		$this->addForeignKey(
		'fk-account-seller_id',
		'account',
		'seller_id',
		'subject',
		'id',
		'CASCADE'
		);
		
		//Внешний ключ покупателей
		$this->addForeignKey(
		'fk-account-buyer_id',
		'account',
		'buyer_id',
		'subject',
		'id',
		'CASCADE'
		);
		
		echo "Table 'account' created. Foreign keys created\n";
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
	
		
		$this->dropTable('{{%account}}');
		
		

		
        echo "Table 'account' deleted. Foreign keys dropped\n";

        return false;
    }

}
