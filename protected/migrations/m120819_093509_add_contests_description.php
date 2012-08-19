<?php

class m120819_093509_add_contests_description extends CDbMigration
{
	public function up()
	{
        $this->addColumn("tbl_contests", "description", "text");
	}

	public function down()
	{
		echo "m120819_093509_add_contests_description does not support migration down.\n";
		return false;
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}