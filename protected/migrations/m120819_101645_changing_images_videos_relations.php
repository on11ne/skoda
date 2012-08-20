<?php

class m120819_101645_changing_images_videos_relations extends CDbMigration
{
	public function up()
	{
        $this->addColumn('tbl_images', 'contest_item_id', 'tinyint');
        $this->addForeignKey('contest_item_relation', 'tbl_images', 'contest_item_id', 'tbl_contest_items', 'id');

        $this->addColumn('tbl_videos', 'contest_item_id', 'tinyint');
        $this->addForeignKey('video_contest_item_relation', 'tbl_videos', 'contest_item_id', 'tbl_contest_items', 'id');

        $this->dropColumn('tbl_contest_items', 'images');
        $this->dropColumn('tbl_contest_items', 'videos');
	}

	public function down()
	{
		echo "m120819_101645_changing_images_videos_relations does not support migration down.\n";
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