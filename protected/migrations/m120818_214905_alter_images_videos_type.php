<?php

class m120818_214905_alter_images_videos_type extends CDbMigration
{
	public function up()
	{
        $this->alterColumn("tbl_contest_items", "images", "varchar(255)");
        $this->alterColumn("tbl_contest_items", "videos", "varchar(255)");
	}

	public function down()
	{
		echo "m120818_214905_alter_images_videos_type does not support migration down.\n";
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