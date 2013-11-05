-- Clean Slate for the ProjectSpot MQP ProjectSpot
-- Please DO NOT include this file with production

--
-- Table Structure for ps_majors
--
DROP TABLE IF EXISTS `ps_majors`;

CREATE TABLE `ps_majors` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`major_text` varchar(255) NOT NULL DEFAULT '',
	PRIMARY KEY (`id`)
);

INSERT INTO `ps_majors` (major_text)
VALUES ('Computer Science');

--
-- Table Structure for ps_users
--
DROP TABLE IF EXISTS `ps_users`;

CREATE TABLE `ps_users` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`user_login` varchar(100) NOT NULL,
	`user_first_name` varchar(50) NOT NULL,
	`user_last_name` varchar(50) NOT NULL,
	`user_grad_year` YEAR NOT NULL,
	`user_status` ENUM('Student', 'Advisor', 'Admin') NOT NULL DEFAULT 'Student',
	`user_email` varchar(255) NOT NULL DEFAULT '',
	`user_gender` varchar(20) NOT NULL DEFAULT '',
	`user_description` text NOT NULL DEFAULT '',
	`user_major1` int(11) NOT NULL,
	`user_major2` int(11),
	PRIMARY KEY (`id`),
	FOREIGN KEY (`user_major1`) REFERENCES ps_majors(`id`),
	FOREIGN KEY (`user_major2`) REFERENCES ps_majors(`id`)
);

INSERT INTO `ps_users` (user_login, user_first_name, user_last_name, user_grad_year, user_status, user_email, user_major1)
VALUES ('afisher', 'Anthony', 'Fisher', 2014, 'Admin', 'afisher@wpi.edu', 1);

--
-- Table Structure for ps_groups
--
DROP TABLE IF EXISTS `ps_groups`;

CREATE TABLE `ps_groups` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`group_creator` int(11) NOT NULL,
	`group_creation_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`group_description` text NOT NULL DEFAULT '',
	`group_name` varchar(50) NOT NULL DEFAULT '',
	`group_status` ENUM('Active', 'Closed', 'Archived') NOT NULL DEFAULT 'Active',
	`group_type` varchar(20) NOT NULL DEFAULT 'MQP',
	`group_site` varchar(255) NOT NULL DEFAULT '',
	`group_contact` varchar(255) NOT NULL DEFAULT '',
	PRIMARY KEY (`id`),
	FOREIGN KEY (`group_creator`) REFERENCES ps_users(`id`)
);

INSERT INTO `ps_groups` (group_creator, group_name)
VALUES (1, 'ProjectSpot');

--
-- Table Structure for ps_tags
--
DROP TABLE IF EXISTS `ps_tags`;

CREATE TABLE `ps_tags` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`tag_text` varchar(255) NOT NULL DEFAULT '',
	PRIMARY KEY (`id`)
);

INSERT INTO `ps_tags` (tag_text)
VALUES ('Web Development');

--
-- Table Structure for ps_group_user_rel
--
DROP TABLE IF EXISTS `ps_group_user_rel`;

CREATE TABLE `ps_group_user_rel` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`group_id` int(11) NOT NULL,
	`user_id` int(11) NOT NULL,
	`invite_status` ENUM('Invited', 'Accepted') NOT NULL DEFAULT 'Invited',
	PRIMARY KEY (`id`),
	FOREIGN KEY (`group_id`) REFERENCES ps_groups(`id`),
	FOREIGN KEY (`user_id`) REFERENCES ps_users(`id`)
);

INSERT INTO `ps_group_user_rel` (group_id, user_id, invite_status)
VALUES (1, 1, 'Accepted');

--
-- Table Structure for ps_group_major_rel
--
DROP TABLE IF EXISTS `ps_group_major_rel`;

CREATE TABLE `ps_group_major_rel` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`group_id` int(11) NOT NULL,
	`major_id` int(11) NOT NULL,
	PRIMARY KEY (`id`),
	FOREIGN KEY (`group_id`) REFERENCES ps_groups(`id`),
	FOREIGN KEY (`major_id`) REFERENCES ps_majors(`id`)
);

INSERT INTO `ps_group_major_rel` (group_id, major_id)
VALUES (1, 1);

--
-- Table Structure for ps_group_tag_rel
--
DROP TABLE IF EXISTS `ps_group_tag_rel`;

CREATE TABLE `ps_group_tag_rel` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`group_id` int(11) NOT NULL,
	`tag_id` int(11) NOT NULL,
	PRIMARY KEY (`id`),
	FOREIGN KEY (`group_id`) REFERENCES ps_groups(`id`),
	FOREIGN KEY (`tag_id`) REFERENCES ps_tags(`id`)
);

INSERT INTO `ps_group_tag_rel` (group_id, tag_id)
VALUES (1, 1);

--
-- Table Structure for ps_user_tag_rel
--
DROP TABLE IF EXISTS `ps_user_tag_rel`;

CREATE TABLE `ps_user_tag_rel` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`user_id` int(11) NOT NULL,
	`tag_id` int(11) NOT NULL,
	PRIMARY KEY (`id`),
	FOREIGN KEY (`user_id`) REFERENCES ps_users(`id`),
	FOREIGN KEY (`tag_id`) REFERENCES ps_tags(`id`)
);

INSERT INTO `ps_user_tag_rel` (user_id, tag_id)
VALUES (1, 1);
