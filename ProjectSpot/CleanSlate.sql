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
	`ldap_name` varchar(255) NOT NULL DEFAULT '',
	PRIMARY KEY (`id`)
);

INSERT INTO `ps_majors` (`id`, `major_text`, `ldap_name`) VALUES (1, 'Computer Science', 'CS');
INSERT INTO `ps_majors` (`id`, `major_text`, `ldap_name`) VALUES (2, 'Robotics Engineering', 'RBE');
INSERT INTO `ps_majors` (`id`, `major_text`, `ldap_name`) VALUES (3, 'Interactive Media and Game Development', 'IMGD');
INSERT INTO `ps_majors` (`id`, `major_text`, `ldap_name`) VALUES (4, 'BE', 'BE');
INSERT INTO `ps_majors` (`id`, `major_text`, `ldap_name`) VALUES (5, 'ME', 'ME');
INSERT INTO `ps_majors` (`id`, `major_text`, `ldap_name`) VALUES (6, 'Biology', 'BIO');
INSERT INTO `ps_majors` (`id`, `major_text`, `ldap_name`) VALUES (7, 'Chemistry', 'CH');
INSERT INTO `ps_majors` (`id`, `major_text`, `ldap_name`) VALUES (8, 'MIS', 'MIS');
INSERT INTO `ps_majors` (`id`, `major_text`, `ldap_name`) VALUES (9, 'Math', 'MA');
INSERT INTO `ps_majors` (`id`, `major_text`, `ldap_name`) VALUES (10, 'Civil Engineering', 'CE');
INSERT INTO `ps_majors` (`id`, `major_text`, `ldap_name`) VALUES (11, 'Enviromental', 'EV');
INSERT INTO `ps_majors` (`id`, `major_text`, `ldap_name`) VALUES (12, 'Aeorspace', 'AE');
INSERT INTO `ps_majors` (`id`, `major_text`, `ldap_name`) VALUES (13, 'Biotech', 'BBT');
INSERT INTO `ps_majors` (`id`, `major_text`, `ldap_name`) VALUES (14, 'ECE', 'ECE');
INSERT INTO `ps_majors` (`id`, `major_text`, `ldap_name`) VALUES (15, 'Computers with Applications', 'CA');
INSERT INTO `ps_majors` (`id`, `major_text`, `ldap_name`) VALUES (16, 'Biomedical Engineering', 'BME');
INSERT INTO `ps_majors` (`id`, `major_text`, `ldap_name`) VALUES (17, 'Chemical Engineering', 'CM');

--
-- Table Structure for ps_users
--
DROP TABLE IF EXISTS `ps_users`;

CREATE TABLE `ps_users` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`user_login` varchar(100) NOT NULL,
	`user_first_name` varchar(50) NOT NULL,
	`user_last_name` varchar(50) NOT NULL,
	`user_grad_year` YEAR,
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

--
-- Table Structure for ps_tags
--
DROP TABLE IF EXISTS `ps_tags`;

CREATE TABLE `ps_tags` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`tag_text` varchar(255) NOT NULL DEFAULT '',
	PRIMARY KEY (`id`)
);

INSERT INTO `ps_tags` (`id`, `tag_text`) VALUES (1, 'Algorithms');
INSERT INTO `ps_tags` (`id`, `tag_text`) VALUES (2, 'Networks');
INSERT INTO `ps_tags` (`id`, `tag_text`) VALUES (3, 'Network Security');
INSERT INTO `ps_tags` (`id`, `tag_text`) VALUES (4, 'Operating Systems');
INSERT INTO `ps_tags` (`id`, `tag_text`) VALUES (5, 'Programming Languages');
INSERT INTO `ps_tags` (`id`, `tag_text`) VALUES (6, 'Artificial Intelligence');
INSERT INTO `ps_tags` (`id`, `tag_text`) VALUES (7, 'Java');
INSERT INTO `ps_tags` (`id`, `tag_text`) VALUES (8, 'Javascript');
INSERT INTO `ps_tags` (`id`, `tag_text`) VALUES (9, 'pHp');
INSERT INTO `ps_tags` (`id`, `tag_text`) VALUES (10, 'Python');
INSERT INTO `ps_tags` (`id`, `tag_text`) VALUES (11, 'Ruby');
INSERT INTO `ps_tags` (`id`, `tag_text`) VALUES (12, 'C/C++');
INSERT INTO `ps_tags` (`id`, `tag_text`) VALUES (13, 'Web Development');
INSERT INTO `ps_tags` (`id`, `tag_text`) VALUES (14, 'Human-Computer Interaction');
INSERT INTO `ps_tags` (`id`, `tag_text`) VALUES (15, 'Software Security');
INSERT INTO `ps_tags` (`id`, `tag_text`) VALUES (16, 'Computation');
INSERT INTO `ps_tags` (`id`, `tag_text`) VALUES (17, 'Databases');
INSERT INTO `ps_tags` (`id`, `tag_text`) VALUES (18, 'Theoretical Computer Science');
INSERT INTO `ps_tags` (`id`, `tag_text`) VALUES (19, 'Applied Computer Science');
INSERT INTO `ps_tags` (`id`, `tag_text`) VALUES (20, 'Graphics');
INSERT INTO `ps_tags` (`id`, `tag_text`) VALUES (21, 'Visualization');
INSERT INTO `ps_tags` (`id`, `tag_text`) VALUES (22, 'Architecture');
INSERT INTO `ps_tags` (`id`, `tag_text`) VALUES (23, 'Software Engineering');
INSERT INTO `ps_tags` (`id`, `tag_text`) VALUES (24, 'Parallel Systems');
INSERT INTO `ps_tags` (`id`, `tag_text`) VALUES (25, 'Concurrent Systems');
INSERT INTO `ps_tags` (`id`, `tag_text`) VALUES (26, 'Distributed Systems');
INSERT INTO `ps_tags` (`id`, `tag_text`) VALUES (27, 'Code Theory');
INSERT INTO `ps_tags` (`id`, `tag_text`) VALUES (28, 'Data Structures');
INSERT INTO `ps_tags` (`id`, `tag_text`) VALUES (29, 'Formal Methods');
INSERT INTO `ps_tags` (`id`, `tag_text`) VALUES (30, 'Cryptography');
INSERT INTO `ps_tags` (`id`, `tag_text`) VALUES (31, 'Compilers');
INSERT INTO `ps_tags` (`id`, `tag_text`) VALUES (32, 'Pattern Recognition');
INSERT INTO `ps_tags` (`id`, `tag_text`) VALUES (33, 'Machine Learning');
INSERT INTO `ps_tags` (`id`, `tag_text`) VALUES (34, 'Evolutionary Computation');
INSERT INTO `ps_tags` (`id`, `tag_text`) VALUES (35, 'Natural Language Processing');
INSERT INTO `ps_tags` (`id`, `tag_text`) VALUES (36, 'Data Mining');
INSERT INTO `ps_tags` (`id`, `tag_text`) VALUES (37, 'Image Processing');
INSERT INTO `ps_tags` (`id`, `tag_text`) VALUES (38, 'Information Security');
INSERT INTO `ps_tags` (`id`, `tag_text`) VALUES (39, 'Information Retrieval');

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

--
-- Table Structure for ps_dates
--
DROP TABLE IF EXISTS `ps_dates`;

CREATE TABLE `ps_dates` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`date_title` varchar(255) NOT NULL DEFAULT '',
	`date_link` varchar(255) NOT NULL DEFAULT '',
	`date_timestamp` TIMESTAMP NOT NULL,
	PRIMARY KEY (`id`)
);


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
