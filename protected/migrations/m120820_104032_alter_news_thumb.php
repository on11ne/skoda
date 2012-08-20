<?php

class m120820_104032_alter_news_thumb extends CDbMigration
{
	public function up()
	{
        $this->alterColumn('tbl_news', 'teaser_image', 'varchar(255)');
	}

	public function down()
	{
		echo "m120820_104032_alter_news_thumb does not support migration down.\n";
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