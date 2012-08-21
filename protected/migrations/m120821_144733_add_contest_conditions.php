<?php

class m120821_144733_add_contest_conditions extends CDbMigration
{
	public function up()
	{
        $this->addColumn('tbl_contests', 'conditions', 'text');
	}

	public function down()
	{
		echo "m120821_144733_add_contest_conditions does not support migration down.\n";
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