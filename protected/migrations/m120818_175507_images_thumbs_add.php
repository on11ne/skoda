<?php

class m120818_175507_images_thumbs_add extends CDbMigration
{
	public function up()
	{
        $this->addColumn("tbl_images", "thumb_path", "varchar(255)");
        $this->addColumn("tbl_videos", "thumb_path", "varchar(255)");
	}

	public function down()
	{
		echo "m120818_175507_images_thumbs_add does not support migration down.\n";
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