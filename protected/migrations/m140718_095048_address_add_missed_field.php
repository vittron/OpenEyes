<?php

class m140718_095048_address_add_missed_field extends CDbMigration
{
    public $table_name = 'address';

	public function safeUp()
	{
        $this->addColumn($this->table_name, 'parent_class', 'varchar(255) DEFAULT NULL AFTER `address_type_id`');
        $this->addColumn($this->table_name, 'parent_id', 'int(10) UNSIGNED NOT NULL AFTER `parent_class`');
        $this->execute('SET foreign_key_checks = 0;');
        $this->addForeignKey('fk_address_contact', 'address', 'parent_id', 'contact', 'id');
        $this->execute('SET foreign_key_checks = 1;');
	}

	public function safeDown()
	{
        $this->dropColumn($this->table_name, 'parent_class');
        $this->execute('SET foreign_key_checks = 0;');
        $this->dropForeignKey('fk_address_contact', $this->table_name);
        $this->execute('SET foreign_key_checks = 1;');
        $this->dropColumn($this->table_name, 'parent_id');
	}
}