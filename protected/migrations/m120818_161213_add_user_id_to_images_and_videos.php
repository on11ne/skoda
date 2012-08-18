<?php

class m120818_161213_add_user_id_to_images_and_videos extends CDbMigration
{
	public function up()
	{
        $this->addColumn('tbl_images','user_id','tinyint');
        $this->addForeignKey('user_id', 'tbl_images', 'user_id', 'tbl_users', 'id');

        $this->addColumn('tbl_videos','user_id','tinyint(4)');
        $this->addForeignKey('videos_user_id', 'tbl_videos', 'user_id', 'tbl_users', 'id');
	}

	public function down()
	{
		echo "m120818_161213_add_user_id_to_images_and_videos does not support migration down.\n";
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