<?php

class m120820_202423_contest_add_inner_image extends CDbMigration
{
	public function up()
	{
        $this->addColumn("tbl_contests", "inner_image", "varchar(255)");
	}

	public function down()
	{
		echo "m120820_202423_contest_add_inner_image does not support migration down.\n";
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