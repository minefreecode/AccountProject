<?php

use yii\db\Migration;

/**
 * Class m180629_072036_subject
 * Определяет субъекта(агента) 
 */
class m180629_072036_subject extends Migration
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

        //Создание таблицы всех субъектов(агентов) действия со счетами
        $this->createTable('{{%subject}}', [
        'id' => $this->primaryKey(),
        'full_name' => $this->string(50)->notNull(),
		'address' => $this->string(100)->notNull(),
        'inn' => $this->string(12),
		'kipp' => $this->string(12),
        'current_account' => $this->string(20)->notNull(),
		'correspondent_account' => $this->string(20)->notNull(),
        'rcbic' => $this->boolean()->defaultValue(0)->notNull(), 
		'bank' => $this->string(50)
        ], $tableOptions);
		

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
		$this->dropTable('{{%subject}}');

    }

}
