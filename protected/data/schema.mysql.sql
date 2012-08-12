
-- ---
-- Globals
-- ---

-- SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
-- SET FOREIGN_KEY_CHECKS=0;

-- ---
-- Table 'tbl_users'
-- 
-- ---

DROP TABLE IF EXISTS `tbl_users`;
		
CREATE TABLE `tbl_users` (
  `id` TINYINT NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(255) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `first_name` VARCHAR(255) NOT NULL,
  `surname` VARCHAR(255) NOT NULL,
  `last_name` VARCHAR(255) NOT NULL,
  `phone` VARCHAR(255) NOT NULL,
  `company` TINYINT NOT NULL COMMENT 'references tbl_companies',
  `city` TINYINT NOT NULL COMMENT 'references tbl_cities',
  `position` VARCHAR(255) NOT NULL,
  `photo` VARCHAR(255) NOT NULL,
  `activation` VARCHAR(255) NULL DEFAULT NULL,
  `status` TINYINT NULL DEFAULT 0 COMMENT '0 - not activated, 1 - not moderated, 2 - activated and mode',
  `registered_date` TIMESTAMP NOT NULL,
  PRIMARY KEY (`id`)
);

-- ---
-- Table 'tbl_news'
-- 
-- ---

DROP TABLE IF EXISTS `tbl_news`;
		
CREATE TABLE `tbl_news` (
  `id` TINYINT NULL AUTO_INCREMENT DEFAULT NULL,
  `title` VARCHAR(255) NOT NULL,
  `teaser_text` MEDIUMTEXT NULL DEFAULT NULL,
  `teaser_image` TINYINT NULL DEFAULT NULL COMMENT 'references tbl_images',
  `created` TIMESTAMP NOT NULL,
  `status` TINYINT NOT NULL DEFAULT 0 COMMENT '0 - nut published, 1 - published',
  `full_text` MEDIUMTEXT NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
);

-- ---
-- Table 'tbl_feedback'
-- 
-- ---

DROP TABLE IF EXISTS `tbl_feedback`;
		
CREATE TABLE `tbl_feedback` (
  `id` TINYINT NOT NULL AUTO_INCREMENT,
  `user_id` TINYINT NOT NULL COMMENT 'references tbl_users',
  `theme` VARCHAR(255) NOT NULL,
  `message` MEDIUMTEXT NULL DEFAULT NULL,
  `image` VARCHAR(255) NULL DEFAULT NULL,
  `created` TIMESTAMP NOT NULL,
  `status` TINYINT NOT NULL DEFAULT 0 COMMENT '0 - not processed, 1 - processed',
  `contest_id` TINYINT NOT NULL COMMENT 'references tbl_contests',
  PRIMARY KEY (`id`)
);

-- ---
-- Table 'tbl_contests'
-- 
-- ---

DROP TABLE IF EXISTS `tbl_contests`;
		
CREATE TABLE `tbl_contests` (
  `id` TINYINT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NOT NULL,
  `index_image` VARCHAR(255) NOT NULL,
  `status` TINYINT NOT NULL DEFAULT 0 COMMENT '0 - not active, 1 - archived, 2 - active',
  PRIMARY KEY (`id`)
);

-- ---
-- Table 'tbl_contest_items'
-- 
-- ---

DROP TABLE IF EXISTS `tbl_contest_items`;
		
CREATE TABLE `tbl_contest_items` (
  `id` TINYINT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NOT NULL,
  `full_text` MEDIUMTEXT NULL DEFAULT NULL,
  `images` TINYINT NULL DEFAULT NULL,
  `videos` MEDIUMTEXT NULL DEFAULT NULL,
  `contest_id` TINYINT NULL DEFAULT NULL,
  `user_id` TINYINT NOT NULL,
  `status` TINYINT NULL DEFAULT 0 COMMENT '0 - not moderated, 1 - moderated',
  `created` TIMESTAMP NOT NULL,
  PRIMARY KEY (`id`)
);

-- ---
-- Table 'tbl_images'
-- 
-- ---

DROP TABLE IF EXISTS `tbl_images`;
		
CREATE TABLE `tbl_images` (
  `id` TINYINT NOT NULL AUTO_INCREMENT,
  `path` VARCHAR(255) NOT NULL,
  `created` TIMESTAMP NOT NULL,
  PRIMARY KEY (`id`)
);

-- ---
-- Table 'tbl_videos'
-- 
-- ---

DROP TABLE IF EXISTS `tbl_videos`;
		
CREATE TABLE `tbl_videos` (
  `id` TINYINT NULL AUTO_INCREMENT DEFAULT NULL,
  `path` VARCHAR(255) NOT NULL DEFAULT 'NULL',
  `created` TIMESTAMP NOT NULL,
  PRIMARY KEY (`id`)
);

-- ---
-- Table 'tbl_votes'
-- 
-- ---

DROP TABLE IF EXISTS `tbl_votes`;
		
CREATE TABLE `tbl_votes` (
  `id` TINYINT NOT NULL AUTO_INCREMENT,
  `source` ENUM('fb', 'vk', 'ok', 'local') NOT NULL COMMENT 'fb, vk, ok, local',
  `contest_item_id` TINYINT NOT NULL,
  `user_identity` VARCHAR(255) NOT NULL COMMENT 'id in SNs or local id',
  `created` TIMESTAMP NOT NULL,
  PRIMARY KEY (`id`)
);

-- ---
-- Table 'tbl_companies'
-- 
-- ---

DROP TABLE IF EXISTS `tbl_companies`;
		
CREATE TABLE `tbl_companies` (
  `id` TINYINT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`)
);

-- ---
-- Table 'tbl_cities'
-- 
-- ---

DROP TABLE IF EXISTS `tbl_cities`;
		
CREATE TABLE `tbl_cities` (
  `id` TINYINT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`)
);

-- ---
-- Foreign Keys 
-- ---

ALTER TABLE `tbl_users` ADD FOREIGN KEY (company) REFERENCES `tbl_companies` (`id`);
ALTER TABLE `tbl_users` ADD FOREIGN KEY (city) REFERENCES `tbl_cities` (`id`);
ALTER TABLE `tbl_feedback` ADD FOREIGN KEY (contest_id) REFERENCES `tbl_contests` (`id`);
ALTER TABLE `tbl_contest_items` ADD FOREIGN KEY (contest_id) REFERENCES `tbl_contests` (`id`);
ALTER TABLE `tbl_contest_items` ADD FOREIGN KEY (user_id) REFERENCES `tbl_users` (`id`);
ALTER TABLE `tbl_votes` ADD FOREIGN KEY (contest_item_id) REFERENCES `tbl_contest_items` (`id`);

-- ---
-- Table Properties
-- ---

-- ALTER TABLE `tbl_users` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `tbl_news` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `tbl_feedback` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `tbl_contests` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `tbl_contest_items` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `tbl_images` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `tbl_videos` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `tbl_votes` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `tbl_companies` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `tbl_cities` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ---
-- Test Data
-- ---

-- INSERT INTO `tbl_users` (`id`,`email`,`password`,`first_name`,`surname`,`last_name`,`phone`,`company`,`city`,`position`,`photo`,`activation`,`status`,`registered_date`) VALUES
-- ('','','','','','','','','','','','','','');
-- INSERT INTO `tbl_news` (`id`,`title`,`teaser_text`,`teaser_image`,`created`,`status`,`full_text`) VALUES
-- ('','','','','','','');
-- INSERT INTO `tbl_feedback` (`id`,`user_id`,`theme`,`message`,`image`,`created`,`status`,`contest_id`) VALUES
-- ('','','','','','','','');
-- INSERT INTO `tbl_contests` (`id`,`title`,`index_image`,`status`) VALUES
-- ('','','','');
-- INSERT INTO `tbl_contest_items` (`id`,`title`,`full_text`,`images`,`videos`,`contest_id`,`user_id`,`status`,`created`) VALUES
-- ('','','','','','','','','');
-- INSERT INTO `tbl_images` (`id`,`path`,`created`) VALUES
-- ('','','');
-- INSERT INTO `tbl_videos` (`id`,`path`,`created`) VALUES
-- ('','','');
-- INSERT INTO `tbl_votes` (`id`,`source`,`contest_item_id`,`user_identity`,`created`) VALUES
-- ('','','','','');
-- INSERT INTO `tbl_companies` (`id`,`title`) VALUES
-- ('','');
-- INSERT INTO `tbl_cities` (`id`,`title`) VALUES
-- ('','');
