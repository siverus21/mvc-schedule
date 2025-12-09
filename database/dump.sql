-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 10 2025 г., 01:34
-- Версия сервера: 8.0.30
-- Версия PHP: 8.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `mvc-schedule`
--

-- --------------------------------------------------------

--
-- Структура таблицы `academic_years`
--

CREATE TABLE `academic_years` (
  `id` bigint UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `audit_logs`
--

CREATE TABLE `audit_logs` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `action` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `object_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `object_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `data` json DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `buildings`
--

CREATE TABLE `buildings` (
  `id` bigint UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `buildings`
--

INSERT INTO `buildings` (`id`, `code`, `name`, `address`, `created_at`) VALUES
(9, 'MAIN', 'Главный корпус', 'ул. Пушкина, д. 1', '2025-12-07 17:10:09'),
(10, 'SECOND', 'Корпус 2', 'ул. Пушкина д. 2', '2025-12-07 17:10:50'),
(11, 'THIRD', 'Корпус 3', 'ул. Пушкина д.3', '2025-12-07 17:11:22'),
(12, 'SPORT', 'Спортивный комплекс', 'ул. Пушкина д.4', '2025-12-07 17:11:45');

-- --------------------------------------------------------

--
-- Структура таблицы `equipment_types`
--

CREATE TABLE `equipment_types` (
  `id` bigint UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `equipment_types`
--

INSERT INTO `equipment_types` (`id`, `code`, `name`, `description`) VALUES
(2, 'PROJECTOR', 'Проектор', 'HDMI, 4000 люмен');

-- --------------------------------------------------------

--
-- Структура таблицы `lesson_types`
--

CREATE TABLE `lesson_types` (
  `id` bigint UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '01_create_roles_table', 1),
(2, '02_create_users', 1),
(3, '03_create_user_roles', 1),
(4, '04_create_teachers', 1),
(5, '05_create_subjects', 1),
(6, '06_create_teacher_subjects', 1),
(7, '07_create_buildings', 1),
(8, '08_create_room_types', 1),
(9, '09_create_rooms', 1),
(10, '10_create_equipment_types', 1),
(11, '11_create_room_equipments', 1),
(12, '12_create_academic_years', 1),
(13, '13_create_semesters', 1),
(14, '14_create_student_groups', 1),
(15, '15_create_lesson_types', 1),
(16, '16_create_schedule_sets', 1),
(17, '17_create_schedule_templates', 1),
(18, '18_create_schedule_instances', 1),
(19, '19_create_schedule_overrides', 1),
(20, '20_create_audit_logs', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `rooms`
--

CREATE TABLE `rooms` (
  `id` bigint UNSIGNED NOT NULL,
  `building_id` bigint UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `capacity` int NOT NULL DEFAULT '0',
  `room_type_id` bigint UNSIGNED DEFAULT NULL,
  `floor` int DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `rooms`
--

INSERT INTO `rooms` (`id`, `building_id`, `code`, `name`, `capacity`, `room_type_id`, `floor`, `notes`) VALUES
(2, 9, '102', 'Аудитория 102', 50, 1, 1, '');

-- --------------------------------------------------------

--
-- Структура таблицы `room_types`
--

CREATE TABLE `room_types` (
  `id` bigint UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `room_types`
--

INSERT INTO `room_types` (`id`, `code`, `name`) VALUES
(1, 'LECT', 'Лекционная'),
(3, 'SEMINAR', 'Семинарская'),
(4, 'COMP', 'Компьютерный класс'),
(5, 'LAB', 'Лаборатория'),
(6, 'SPORT', 'Спортзал');

-- --------------------------------------------------------

--
-- Структура таблицы `schedule_instances`
--

CREATE TABLE `schedule_instances` (
  `id` bigint UNSIGNED NOT NULL,
  `student_group_id` bigint UNSIGNED NOT NULL,
  `subject_id` bigint UNSIGNED NOT NULL,
  `teacher_id` bigint UNSIGNED DEFAULT NULL,
  `room_id` bigint UNSIGNED DEFAULT NULL,
  `lesson_type_id` bigint UNSIGNED DEFAULT NULL,
  `date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `notes` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `schedule_overrides`
--

CREATE TABLE `schedule_overrides` (
  `id` bigint UNSIGNED NOT NULL,
  `template_id` bigint UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `action` enum('cancel','replace','move') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'cancel',
  `subject_id` bigint UNSIGNED DEFAULT NULL,
  `teacher_id` bigint UNSIGNED DEFAULT NULL,
  `room_id` bigint UNSIGNED DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `reason` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `schedule_sets`
--

CREATE TABLE `schedule_sets` (
  `id` bigint UNSIGNED NOT NULL,
  `student_group_id` bigint UNSIGNED NOT NULL,
  `semester_id` bigint UNSIGNED NOT NULL,
  `academic_year_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `version` int NOT NULL DEFAULT '1',
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `schedule_templates`
--

CREATE TABLE `schedule_templates` (
  `id` bigint UNSIGNED NOT NULL,
  `schedule_set_id` bigint UNSIGNED NOT NULL,
  `subject_id` bigint UNSIGNED NOT NULL,
  `teacher_id` bigint UNSIGNED DEFAULT NULL,
  `room_id` bigint UNSIGNED DEFAULT NULL,
  `lesson_type_id` bigint UNSIGNED DEFAULT NULL,
  `day_of_week` tinyint NOT NULL,
  `week_parity` tinyint NOT NULL DEFAULT '0',
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `ordinal` tinyint DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `semesters`
--

CREATE TABLE `semesters` (
  `id` bigint UNSIGNED NOT NULL,
  `academic_year_id` bigint UNSIGNED NOT NULL,
  `number` tinyint NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `student_groups`
--

CREATE TABLE `student_groups` (
  `id` bigint UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `program` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `course_number` tinyint DEFAULT NULL,
  `intake_year` year DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `subjects`
--

CREATE TABLE `subjects` (
  `id` bigint UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `credits` int NOT NULL DEFAULT '0',
  `description` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `teachers`
--

CREATE TABLE `teachers` (
  `id` bigint UNSIGNED NOT NULL,
  `staff_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `academic_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `department` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bio` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `teacher_subjects`
--

CREATE TABLE `teacher_subjects` (
  `teacher_id` bigint UNSIGNED NOT NULL,
  `subject_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `display_name`, `phone`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'test', 'test@test.re', '$2y$12$L4nHB5/548Zo1HIE6aMmeexPa6wfe2N2cqtgk3pqvEL8GdtISXubi', NULL, NULL, 1, '2025-11-30 00:42:03', '2025-11-30 00:42:03'),
(2, 'test1', 'test1@test1.re', '$2y$12$3J3oLYhtFt0WLf2EoRl/ke5r1Dn7fL0Z008SCpUJOfc/lqo0Rr3dm', NULL, NULL, 1, '2025-11-30 00:44:05', '2025-11-30 00:44:05'),
(3, 'test2', 'test2@test2.re', '$2y$12$r46zyFTiu6MO1ruzlqQGRe7ru4Ybr5.6x.eAuXvOq6wBPadP8zGsy', NULL, NULL, 1, '2025-11-30 00:55:26', '2025-11-30 00:55:26'),
(4, 'Test3', 'Test3@Test3.re', '$2y$12$cNuirYEO9jvp.KOLHuiT9urkok2S7.5Xv5tqy6JeaqIvdqju3xJlm', NULL, NULL, 1, '2025-11-30 14:56:37', '2025-11-30 14:56:37');

-- --------------------------------------------------------

--
-- Структура таблицы `user_roles`
--

CREATE TABLE `user_roles` (
  `user_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `academic_years`
--
ALTER TABLE `academic_years`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `academic_years_code_unique` (`code`);

--
-- Индексы таблицы `audit_logs`
--
ALTER TABLE `audit_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `audit_logs_user_id_foreign` (`user_id`);

--
-- Индексы таблицы `buildings`
--
ALTER TABLE `buildings`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `equipment_types`
--
ALTER TABLE `equipment_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `equipment_types_code_unique` (`code`);

--
-- Индексы таблицы `lesson_types`
--
ALTER TABLE `lesson_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `lesson_types_code_unique` (`code`);

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_code_unique` (`code`);

--
-- Индексы таблицы `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rooms_building_id_foreign` (`building_id`),
  ADD KEY `rooms_room_type_id_foreign` (`room_type_id`);

--
-- Индексы таблицы `room_types`
--
ALTER TABLE `room_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `room_types_code_unique` (`code`);

--
-- Индексы таблицы `schedule_instances`
--
ALTER TABLE `schedule_instances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sch_inst_group_date_time_idx` (`student_group_id`,`date`,`start_time`),
  ADD KEY `schedule_instances_subject_id_foreign` (`subject_id`),
  ADD KEY `schedule_instances_teacher_id_foreign` (`teacher_id`),
  ADD KEY `schedule_instances_room_id_foreign` (`room_id`),
  ADD KEY `schedule_instances_lesson_type_id_foreign` (`lesson_type_id`);

--
-- Индексы таблицы `schedule_overrides`
--
ALTER TABLE `schedule_overrides`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sch_ovr_template_date_idx` (`template_id`,`date`),
  ADD KEY `sch_ovr_date_idx` (`date`),
  ADD KEY `schedule_overrides_subject_id_foreign` (`subject_id`),
  ADD KEY `schedule_overrides_teacher_id_foreign` (`teacher_id`),
  ADD KEY `schedule_overrides_room_id_foreign` (`room_id`);

--
-- Индексы таблицы `schedule_sets`
--
ALTER TABLE `schedule_sets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sch_sets_group_sem_year_idx` (`student_group_id`,`semester_id`,`academic_year_id`),
  ADD KEY `schedule_sets_semester_id_foreign` (`semester_id`),
  ADD KEY `schedule_sets_academic_year_id_foreign` (`academic_year_id`);

--
-- Индексы таблицы `schedule_templates`
--
ALTER TABLE `schedule_templates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sch_tpl_set_day_time_idx` (`schedule_set_id`,`day_of_week`,`start_time`),
  ADD KEY `schedule_templates_subject_id_foreign` (`subject_id`),
  ADD KEY `schedule_templates_teacher_id_foreign` (`teacher_id`),
  ADD KEY `schedule_templates_room_id_foreign` (`room_id`),
  ADD KEY `schedule_templates_lesson_type_id_foreign` (`lesson_type_id`);

--
-- Индексы таблицы `semesters`
--
ALTER TABLE `semesters`
  ADD PRIMARY KEY (`id`),
  ADD KEY `semesters_academic_year_id_foreign` (`academic_year_id`);

--
-- Индексы таблицы `student_groups`
--
ALTER TABLE `student_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `student_groups_code_unique` (`code`);

--
-- Индексы таблицы `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subjects_code_unique` (`code`);

--
-- Индексы таблицы `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `teachers_staff_number_unique` (`staff_number`);

--
-- Индексы таблицы `teacher_subjects`
--
ALTER TABLE `teacher_subjects`
  ADD PRIMARY KEY (`teacher_id`,`subject_id`),
  ADD KEY `teacher_subjects_subject_id_foreign` (`subject_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Индексы таблицы `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `user_roles_role_id_foreign` (`role_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `academic_years`
--
ALTER TABLE `academic_years`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `audit_logs`
--
ALTER TABLE `audit_logs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `buildings`
--
ALTER TABLE `buildings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `equipment_types`
--
ALTER TABLE `equipment_types`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `lesson_types`
--
ALTER TABLE `lesson_types`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT для таблицы `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `room_types`
--
ALTER TABLE `room_types`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `schedule_instances`
--
ALTER TABLE `schedule_instances`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `schedule_overrides`
--
ALTER TABLE `schedule_overrides`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `schedule_sets`
--
ALTER TABLE `schedule_sets`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `schedule_templates`
--
ALTER TABLE `schedule_templates`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `semesters`
--
ALTER TABLE `semesters`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `student_groups`
--
ALTER TABLE `student_groups`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `audit_logs`
--
ALTER TABLE `audit_logs`
  ADD CONSTRAINT `audit_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Ограничения внешнего ключа таблицы `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `rooms_building_id_foreign` FOREIGN KEY (`building_id`) REFERENCES `buildings` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `rooms_room_type_id_foreign` FOREIGN KEY (`room_type_id`) REFERENCES `room_types` (`id`) ON DELETE SET NULL;

--
-- Ограничения внешнего ключа таблицы `schedule_instances`
--
ALTER TABLE `schedule_instances`
  ADD CONSTRAINT `schedule_instances_lesson_type_id_foreign` FOREIGN KEY (`lesson_type_id`) REFERENCES `lesson_types` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `schedule_instances_room_id_foreign` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `schedule_instances_student_group_id_foreign` FOREIGN KEY (`student_group_id`) REFERENCES `student_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `schedule_instances_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE RESTRICT,
  ADD CONSTRAINT `schedule_instances_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`) ON DELETE SET NULL;

--
-- Ограничения внешнего ключа таблицы `schedule_overrides`
--
ALTER TABLE `schedule_overrides`
  ADD CONSTRAINT `schedule_overrides_room_id_foreign` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `schedule_overrides_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `schedule_overrides_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `schedule_overrides_template_id_foreign` FOREIGN KEY (`template_id`) REFERENCES `schedule_templates` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `schedule_sets`
--
ALTER TABLE `schedule_sets`
  ADD CONSTRAINT `schedule_sets_academic_year_id_foreign` FOREIGN KEY (`academic_year_id`) REFERENCES `academic_years` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `schedule_sets_semester_id_foreign` FOREIGN KEY (`semester_id`) REFERENCES `semesters` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `schedule_sets_student_group_id_foreign` FOREIGN KEY (`student_group_id`) REFERENCES `student_groups` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `schedule_templates`
--
ALTER TABLE `schedule_templates`
  ADD CONSTRAINT `schedule_templates_lesson_type_id_foreign` FOREIGN KEY (`lesson_type_id`) REFERENCES `lesson_types` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `schedule_templates_room_id_foreign` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `schedule_templates_schedule_set_id_foreign` FOREIGN KEY (`schedule_set_id`) REFERENCES `schedule_sets` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `schedule_templates_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE RESTRICT,
  ADD CONSTRAINT `schedule_templates_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`) ON DELETE SET NULL;

--
-- Ограничения внешнего ключа таблицы `semesters`
--
ALTER TABLE `semesters`
  ADD CONSTRAINT `semesters_academic_year_id_foreign` FOREIGN KEY (`academic_year_id`) REFERENCES `academic_years` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `teachers`
--
ALTER TABLE `teachers`
  ADD CONSTRAINT `teachers_id_foreign` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `teacher_subjects`
--
ALTER TABLE `teacher_subjects`
  ADD CONSTRAINT `teacher_subjects_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `teacher_subjects_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `user_roles`
--
ALTER TABLE `user_roles`
  ADD CONSTRAINT `user_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_roles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
