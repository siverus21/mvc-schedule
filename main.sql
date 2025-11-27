CREATE TABLE IF NOT EXISTS `roles` (
	`id` INTEGER AUTO_INCREMENT,
	`code` VARCHAR(50) NOT NULL UNIQUE,
	`name` VARCHAR(150) NOT NULL,
	`description` TEXT,
	`created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY(`id`)
);


CREATE TABLE IF NOT EXISTS `users` (
	`id` BIGINT AUTO_INCREMENT,
	`username` VARCHAR(100) NOT NULL UNIQUE,
	`email` VARCHAR(255) UNIQUE,
	`password_hash` VARCHAR(255) NOT NULL,
	`display_name` VARCHAR(255),
	`phone` VARCHAR(50),
	`is_active` TINYINT DEFAULT 1,
	`created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	`updated_at` TIMESTAMP NOT NULL,
	PRIMARY KEY(`id`)
);


CREATE TABLE IF NOT EXISTS `user_roles` (
	`user_id` BIGINT NOT NULL,
	`role_id` INTEGER NOT NULL,
	PRIMARY KEY(`user_id`, `role_id`)
);


CREATE TABLE IF NOT EXISTS `teachers` (
	`id` BIGINT,
	`staff_number` VARCHAR(50) UNIQUE,
	`academic_title` VARCHAR(100),
	`department` VARCHAR(255),
	`bio` TEXT,
	PRIMARY KEY(`id`)
);


CREATE TABLE IF NOT EXISTS `subjects` (
	`id` INTEGER AUTO_INCREMENT,
	`code` VARCHAR(50) UNIQUE,
	`title` VARCHAR(255) NOT NULL,
	`credits` INTEGER DEFAULT 0,
	`description` TEXT,
	PRIMARY KEY(`id`)
);


CREATE TABLE IF NOT EXISTS `teacher_subjects` (
	`teacher_id` BIGINT NOT NULL,
	`subject_id` INTEGER NOT NULL,
	PRIMARY KEY(`teacher_id`, `subject_id`)
);


CREATE TABLE IF NOT EXISTS `buildings` (
	`id` INTEGER AUTO_INCREMENT,
	`code` VARCHAR(50),
	`name` VARCHAR(255),
	`address` VARCHAR(512),
	`created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY(`id`)
);


CREATE TABLE IF NOT EXISTS `room_types` (
	`id` INTEGER AUTO_INCREMENT,
	`code` VARCHAR(50) UNIQUE,
	`name` VARCHAR(100),
	PRIMARY KEY(`id`)
);


CREATE TABLE IF NOT EXISTS `rooms` (
	`id` INTEGER AUTO_INCREMENT,
	`building_id` INTEGER NOT NULL,
	`code` VARCHAR(50) NOT NULL,
	`name` VARCHAR(255),
	`capacity` INTEGER DEFAULT 0,
	`room_type_id` INTEGER,
	`floor` INTEGER,
	`notes` TEXT,
	PRIMARY KEY(`id`)
);


CREATE TABLE IF NOT EXISTS `equipment_types` (
	`id` INTEGER AUTO_INCREMENT,
	`code` VARCHAR(100) UNIQUE,
	`name` VARCHAR(255),
	`description` TEXT,
	PRIMARY KEY(`id`)
);


CREATE TABLE IF NOT EXISTS `room_equipments` (
	`room_id` INTEGER NOT NULL,
	`equipment_type_id` INTEGER NOT NULL,
	`quantity` INTEGER DEFAULT 1,
	`notes` VARCHAR(255),
	PRIMARY KEY(`room_id`, `equipment_type_id`)
);


CREATE TABLE IF NOT EXISTS `academic_years` (
	`id` INTEGER AUTO_INCREMENT,
	`code` VARCHAR(20) UNIQUE,
	`start_date` DATE NOT NULL,
	`end_date` DATE NOT NULL,
	`description` VARCHAR(255),
	PRIMARY KEY(`id`)
);


CREATE TABLE IF NOT EXISTS `semesters` (
	`id` INTEGER AUTO_INCREMENT,
	`academic_year_id` INTEGER NOT NULL,
	`number` TINYINT NOT NULL,
	`start_date` DATE NOT NULL,
	`end_date` DATE NOT NULL,
	`name` VARCHAR(200),
	PRIMARY KEY(`id`)
);


CREATE TABLE IF NOT EXISTS `student_groups` (
	`id` INTEGER AUTO_INCREMENT,
	`code` VARCHAR(100) UNIQUE,
	`name` VARCHAR(255),
	`program` VARCHAR(255),
	`course_number` TINYINT,
	`intake_year` YEAR,
	`notes` TEXT,
	PRIMARY KEY(`id`)
);


CREATE TABLE IF NOT EXISTS `lesson_types` (
	`id` INTEGER AUTO_INCREMENT,
	`code` VARCHAR(50) UNIQUE,
	`name` VARCHAR(150),
	PRIMARY KEY(`id`)
);


CREATE TABLE IF NOT EXISTS `schedule_sets` (
	`id` BIGINT AUTO_INCREMENT,
	`student_group_id` INTEGER NOT NULL,
	`semester_id` INTEGER NOT NULL,
	`academic_year_id` INTEGER NOT NULL,
	`name` VARCHAR(255),
	`version` INTEGER DEFAULT 1,
	`is_active` TINYINT DEFAULT 0,
	`created_by` BIGINT,
	`created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY(`id`)
);


CREATE TABLE IF NOT EXISTS `schedule_templates` (
	`id` BIGINT AUTO_INCREMENT,
	`schedule_set_id` BIGINT NOT NULL,
	`subject_id` INTEGER NOT NULL,
	`teacher_id` BIGINT,
	`room_id` INTEGER,
	`lesson_type_id` INTEGER,
	`day_of_week` TINYINT NOT NULL,
	`week_parity` TINYINT NOT NULL DEFAULT 0,
	`start_time` TIME NOT NULL,
	`end_time` TIME NOT NULL,
	`ordinal` TINYINT DEFAULT NULL,
	`notes` TEXT,
	`created_by` BIGINT,
	`created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY(`id`)
);


CREATE INDEX `idx_schedule_templates_group_weekday`
ON `schedule_templates` (`schedule_set_id`, `day_of_week`, `start_time`);
CREATE TABLE IF NOT EXISTS `schedule_instances` (
	`id` BIGINT AUTO_INCREMENT,
	`student_group_id` INTEGER NOT NULL,
	`subject_id` INTEGER NOT NULL,
	`teacher_id` BIGINT,
	`room_id` INTEGER,
	`lesson_type_id` INTEGER,
	`date` DATE NOT NULL,
	`start_time` TIME NOT NULL,
	`end_time` TIME NOT NULL,
	`created_by` BIGINT,
	`created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	`notes` TEXT,
	PRIMARY KEY(`id`)
);


CREATE INDEX `idx_instances_date_group`
ON `schedule_instances` (`student_group_id`, `date`, `start_time`);
CREATE TABLE IF NOT EXISTS `schedule_overrides` (
	`id` BIGINT AUTO_INCREMENT,
	`template_id` BIGINT NOT NULL,
	`date` DATE NOT NULL,
	`action` ENUM('cancel', 'replace', 'move') NOT NULL DEFAULT 'cancel',
	`subject_id` INTEGER NOT NULL,
	`teacher_id` BIGINT NOT NULL,
	`room_id` INTEGER NOT NULL,
	`start_time` TIME NOT NULL,
	`end_time` TIME NOT NULL,
	`reason` VARCHAR(512),
	`created_by` BIGINT,
	`created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY(`id`)
);


CREATE INDEX `idx_overrides_template_date`
ON `schedule_overrides` (`template_id`, `date`);
CREATE INDEX `idx_overrides_date_group`
ON `schedule_overrides` (`date`);
CREATE TABLE IF NOT EXISTS `audit_logs` (
	`id` BIGINT AUTO_INCREMENT,
	`user_id` BIGINT,
	`action` VARCHAR(100),
	`object_type` VARCHAR(100),
	`object_id` VARCHAR(100),
	`data` JSON NOT NULL,
	`created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY(`id`)
);


ALTER TABLE `user_roles`
ADD FOREIGN KEY(`user_id`) REFERENCES `users`(`id`)
ON UPDATE NO ACTION ON DELETE CASCADE;
ALTER TABLE `user_roles`
ADD FOREIGN KEY(`role_id`) REFERENCES `roles`(`id`)
ON UPDATE NO ACTION ON DELETE CASCADE;
ALTER TABLE `teachers`
ADD FOREIGN KEY(`id`) REFERENCES `users`(`id`)
ON UPDATE NO ACTION ON DELETE CASCADE;
ALTER TABLE `teacher_subjects`
ADD FOREIGN KEY(`teacher_id`) REFERENCES `teachers`(`id`)
ON UPDATE NO ACTION ON DELETE CASCADE;
ALTER TABLE `teacher_subjects`
ADD FOREIGN KEY(`subject_id`) REFERENCES `subjects`(`id`)
ON UPDATE NO ACTION ON DELETE CASCADE;
ALTER TABLE `rooms`
ADD FOREIGN KEY(`building_id`) REFERENCES `buildings`(`id`)
ON UPDATE NO ACTION ON DELETE CASCADE;
ALTER TABLE `rooms`
ADD FOREIGN KEY(`room_type_id`) REFERENCES `room_types`(`id`)
ON UPDATE NO ACTION ON DELETE NO ACTION;
ALTER TABLE `room_equipments`
ADD FOREIGN KEY(`room_id`) REFERENCES `rooms`(`id`)
ON UPDATE NO ACTION ON DELETE CASCADE;
ALTER TABLE `room_equipments`
ADD FOREIGN KEY(`equipment_type_id`) REFERENCES `equipment_types`(`id`)
ON UPDATE NO ACTION ON DELETE NO ACTION;
ALTER TABLE `semesters`
ADD FOREIGN KEY(`academic_year_id`) REFERENCES `academic_years`(`id`)
ON UPDATE NO ACTION ON DELETE CASCADE;
ALTER TABLE `schedule_sets`
ADD FOREIGN KEY(`student_group_id`) REFERENCES `student_groups`(`id`)
ON UPDATE NO ACTION ON DELETE CASCADE;
ALTER TABLE `schedule_sets`
ADD FOREIGN KEY(`semester_id`) REFERENCES `semesters`(`id`)
ON UPDATE NO ACTION ON DELETE CASCADE;
ALTER TABLE `schedule_sets`
ADD FOREIGN KEY(`academic_year_id`) REFERENCES `academic_years`(`id`)
ON UPDATE NO ACTION ON DELETE CASCADE;
ALTER TABLE `schedule_templates`
ADD FOREIGN KEY(`schedule_set_id`) REFERENCES `schedule_sets`(`id`)
ON UPDATE NO ACTION ON DELETE CASCADE;
ALTER TABLE `schedule_templates`
ADD FOREIGN KEY(`subject_id`) REFERENCES `subjects`(`id`)
ON UPDATE NO ACTION ON DELETE NO ACTION;
ALTER TABLE `schedule_templates`
ADD FOREIGN KEY(`teacher_id`) REFERENCES `teachers`(`id`)
ON UPDATE NO ACTION ON DELETE NO ACTION;
ALTER TABLE `schedule_templates`
ADD FOREIGN KEY(`room_id`) REFERENCES `rooms`(`id`)
ON UPDATE NO ACTION ON DELETE NO ACTION;
ALTER TABLE `schedule_templates`
ADD FOREIGN KEY(`lesson_type_id`) REFERENCES `lesson_types`(`id`)
ON UPDATE NO ACTION ON DELETE NO ACTION;
ALTER TABLE `schedule_instances`
ADD FOREIGN KEY(`student_group_id`) REFERENCES `student_groups`(`id`)
ON UPDATE NO ACTION ON DELETE NO ACTION;
ALTER TABLE `schedule_instances`
ADD FOREIGN KEY(`subject_id`) REFERENCES `subjects`(`id`)
ON UPDATE NO ACTION ON DELETE NO ACTION;
ALTER TABLE `schedule_instances`
ADD FOREIGN KEY(`teacher_id`) REFERENCES `teachers`(`id`)
ON UPDATE NO ACTION ON DELETE NO ACTION;
ALTER TABLE `schedule_instances`
ADD FOREIGN KEY(`room_id`) REFERENCES `rooms`(`id`)
ON UPDATE NO ACTION ON DELETE NO ACTION;
ALTER TABLE `schedule_instances`
ADD FOREIGN KEY(`lesson_type_id`) REFERENCES `lesson_types`(`id`)
ON UPDATE NO ACTION ON DELETE NO ACTION;
ALTER TABLE `schedule_overrides`
ADD FOREIGN KEY(`template_id`) REFERENCES `schedule_templates`(`id`)
ON UPDATE NO ACTION ON DELETE CASCADE;
ALTER TABLE `schedule_overrides`
ADD FOREIGN KEY(`subject_id`) REFERENCES `subjects`(`id`)
ON UPDATE NO ACTION ON DELETE NO ACTION;
ALTER TABLE `schedule_overrides`
ADD FOREIGN KEY(`teacher_id`) REFERENCES `teachers`(`id`)
ON UPDATE NO ACTION ON DELETE NO ACTION;
ALTER TABLE `schedule_overrides`
ADD FOREIGN KEY(`room_id`) REFERENCES `rooms`(`id`)
ON UPDATE NO ACTION ON DELETE NO ACTION;