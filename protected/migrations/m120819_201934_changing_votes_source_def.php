<?php

class m120819_201934_changing_votes_source_def extends CDbMigration
{
	public function up()
	{
        $this->alterColumn("tbl_votes", "source", "varchar(255)");
	}

	public function down()
	{
		echo "m120819_201934_changing_votes_source_def does not support migration down.\n";
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