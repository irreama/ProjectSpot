-- Clean Slate for the ProjectSpot MQP ProjectSpot
-- Please DO NOT include this file with production
SET FOREIGN_KEY_CHECKS=0; 
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
	`user_status` ENUM('Student', 'Advisor', 'Other') NOT NULL DEFAULT 'Student',
	`user_email` varchar(255) NOT NULL DEFAULT '',
	`user_gender` varchar(20) NOT NULL DEFAULT 'Not Provided',
	`user_description` text,
	`user_major1` int(11) NOT NULL,
	`user_major2` int(11),
	`user_avatar` varchar(255) NOT NULL DEFAULT '',
	`user_site` varchar(255) NOT NULL DEFAULT '',
	`user_is_admin` bit(1) NOT NULL DEFAULT 0,
	PRIMARY KEY (`id`),
	FOREIGN KEY (`user_major1`) REFERENCES ps_majors(`id`),
	FOREIGN KEY (`user_major2`) REFERENCES ps_majors(`id`)
);

INSERT INTO `ps_users` (user_login, user_first_name, user_last_name, user_grad_year, user_status, user_email, user_major1)
VALUES ('afisher', 'Anthony', 'Fisher', 2014, 'Student', 'afisher@wpi.edu', 1);

INSERT INTO `ps_users` (user_login, user_first_name, user_last_name, user_grad_year, user_status, user_email, user_major1)
VALUES ('mcoryea14', 'Madalyn', 'Coryea', 2014, 'Student', 'mcoryea14@wpi.edu', 1);

INSERT INTO `ps_users` (user_login, user_first_name, user_last_name, user_grad_year, user_status, user_email, user_major1)
VALUES ('dcb', 'David', 'Brown', 2014, 'Advisor', 'dcb@wpi.edu', 1);

INSERT INTO `ps_users` (user_login, user_first_name, user_last_name, user_grad_year, user_status, user_email, user_major1)
VALUES ('test', 'Test', 'User', 2015, 'Student', 'test@wpi.edu', 1);

INSERT INTO `ps_users` (user_login, user_first_name, user_last_name, user_grad_year, user_status, user_email, user_major1)
VALUES ('pollice', 'Gary', 'Pollice', 2014, 'Advisor', 'pollice@wpi.edu', 1);

--
-- Table Structure for ps_groups
--
DROP TABLE IF EXISTS `ps_groups`;

CREATE TABLE `ps_groups` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`group_creator` int(11) NOT NULL,
	`group_creation_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`group_description` text,
	`group_needs` text,
	`group_name` varchar(50) NOT NULL DEFAULT '',
	`group_status` ENUM('Active', 'Closed', 'Archived') NOT NULL DEFAULT 'Active',
	`group_type` varchar(20) NOT NULL DEFAULT 'MQP',
	`group_site` varchar(255) NOT NULL DEFAULT '',
	`group_contact` varchar(255) NOT NULL DEFAULT '',
	`group_avatar` varchar(255) NOT NULL DEFAULT '',
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

INSERT INTO `ps_tags` (tag_text) VALUES ('Algorithms');
INSERT INTO `ps_tags` (tag_text) VALUES ('Networks');
INSERT INTO `ps_tags` (tag_text) VALUES ('Network Security');
INSERT INTO `ps_tags` (tag_text) VALUES ('Operating Systems');
INSERT INTO `ps_tags` (tag_text) VALUES ('Programming Languages');
INSERT INTO `ps_tags` (tag_text) VALUES ('Artificial Intelligence');
INSERT INTO `ps_tags` (tag_text) VALUES ('Java');
INSERT INTO `ps_tags` (tag_text) VALUES ('Javascript');
INSERT INTO `ps_tags` (tag_text) VALUES ('pHp');
INSERT INTO `ps_tags` (tag_text) VALUES ('Python');
INSERT INTO `ps_tags` (tag_text) VALUES ('Ruby');
INSERT INTO `ps_tags` (tag_text) VALUES ('C/C++');
INSERT INTO `ps_tags` (tag_text) VALUES ('Web Development');
INSERT INTO `ps_tags` (tag_text) VALUES ('Human-Computer Interaction');
INSERT INTO `ps_tags` (tag_text) VALUES ('Software Security');
INSERT INTO `ps_tags` (tag_text) VALUES ('Computation');
INSERT INTO `ps_tags` (tag_text) VALUES ('Databases');
INSERT INTO `ps_tags` (tag_text) VALUES ('Theoretical Computer Science');
INSERT INTO `ps_tags` (tag_text) VALUES ('Applied Computer Science');
INSERT INTO `ps_tags` (tag_text) VALUES ('Graphics');
INSERT INTO `ps_tags` (tag_text) VALUES ('Visualization');
INSERT INTO `ps_tags` (tag_text) VALUES ('Architecture');
INSERT INTO `ps_tags` (tag_text) VALUES ('Software Engineering');
INSERT INTO `ps_tags` (tag_text) VALUES ('Parallel Systems');
INSERT INTO `ps_tags` (tag_text) VALUES ('Concurrent Systems');
INSERT INTO `ps_tags` (tag_text) VALUES ('Distributed Systems');
INSERT INTO `ps_tags` (tag_text) VALUES ('Code Theory');
INSERT INTO `ps_tags` (tag_text) VALUES ('Data Structures');
INSERT INTO `ps_tags` (tag_text) VALUES ('Formal Methods');
INSERT INTO `ps_tags` (tag_text) VALUES ('Cryptography');
INSERT INTO `ps_tags` (tag_text) VALUES ('Compilers');
INSERT INTO `ps_tags` (tag_text) VALUES ('Pattern Recognition');
INSERT INTO `ps_tags` (tag_text) VALUES ('Machine Learning');
INSERT INTO `ps_tags` (tag_text) VALUES ('Evolutionary Computation');
INSERT INTO `ps_tags` (tag_text) VALUES ('Natural Language Processing');
INSERT INTO `ps_tags` (tag_text) VALUES ('Data Mining');
INSERT INTO `ps_tags` (tag_text) VALUES ('Image Processing');
INSERT INTO `ps_tags` (tag_text) VALUES ('Information Security');
INSERT INTO `ps_tags` (tag_text) VALUES ('Information Retrieval');


--
-- Table Structure for ps_group_user_rel
--
DROP TABLE IF EXISTS `ps_group_user_rel`;

CREATE TABLE `ps_group_user_rel` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`group_id` int(11) NOT NULL,
	`user_id` int(11) NOT NULL,
	`invited_by` int(11),
	`invite_status` ENUM('Requested', 'Invited', 'Accepted') NOT NULL DEFAULT 'Invited',
	PRIMARY KEY (`id`),
	FOREIGN KEY (`group_id`) REFERENCES ps_groups(`id`),
	FOREIGN KEY (`user_id`) REFERENCES ps_users(`id`),
	FOREIGN KEY (`invited_by`) REFERENCES ps_users(`id`)
);

INSERT INTO `ps_group_user_rel` (group_id, user_id, invite_status)
VALUES (1, 1, 'Accepted');

INSERT INTO `ps_group_user_rel` (group_id, user_id, invite_status)
VALUES (1, 3, 'Accepted');

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

DROP TABLE IF EXISTS  `ci_sessions`;

CREATE TABLE `ci_sessions` (
	session_id varchar(40) DEFAULT '0' NOT NULL,
	ip_address varchar(45) DEFAULT '0' NOT NULL,
	user_agent varchar(120) NOT NULL,
	last_activity int(10) unsigned DEFAULT 0 NOT NULL,
	user_data text NOT NULL,
	PRIMARY KEY (session_id),
	KEY `last_activity_idx` (`last_activity`)
);

SET FOREIGN_KEY_CHECKS=1; 
