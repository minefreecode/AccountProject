<?php

use yii\db\Migration;

/**
 * Class m180701_065318_service
 * услуги
 */
class m180701_065318_service extends Migration
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

        //Создание таблицы, хранящая все услуги
        $this->createTable('{{%service}}', [
        'id' => $this->primaryKey(),
        'name' => $this->string(50)->notNull(),		
		'measurement_unit' => $this->string(12),
		'quantity' => $this->double(),
		'price' => $this->double()
        ], $tableOptions);
		
		


		
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
		
      	$this->dropTable('{{%service}}');
		
        return false;
    }


}
