-- Capacities Platform - Expanded Schema
-- Supports: Multiple Schools (KG, Boys, Girls), Departments, Stages, Classes
-- Roles: Super Admin, School Admin, Teacher, Student, Parent

SET FOREIGN_KEY_CHECKS = 0;

-- ==========================================
-- 1. Core Structure (Schools & Hierarchy)
-- ==========================================

DROP TABLE IF EXISTS `schools`;
CREATE TABLE `schools` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name_ar` VARCHAR(150) NOT NULL,
    `name_en` VARCHAR(150) NOT NULL,
    `slug` VARCHAR(50) NOT NULL UNIQUE, -- e.g., 'boys', 'girls', 'kg'
    `logo` VARCHAR(255) NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `departments`;
CREATE TABLE `departments` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `school_id` INT UNSIGNED NOT NULL,
    `name_ar` VARCHAR(100) NOT NULL, -- General, International
    `name_en` VARCHAR(100) NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`school_id`) REFERENCES `schools`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `stages`;
CREATE TABLE `stages` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `department_id` INT UNSIGNED NOT NULL,
    `name_ar` VARCHAR(100) NOT NULL, -- Primary, Middle, Secondary
    `name_en` VARCHAR(100) NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`department_id`) REFERENCES `departments`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `levels`;
CREATE TABLE `levels` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `stage_id` INT UNSIGNED NOT NULL,
    `name_ar` VARCHAR(100) NOT NULL, -- Grade 1, Grade 2
    `name_en` VARCHAR(100) NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`stage_id`) REFERENCES `stages`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `classrooms`;
CREATE TABLE `classrooms` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `level_id` INT UNSIGNED NOT NULL,
    `name_ar` VARCHAR(100) NOT NULL, -- Class A, Class B / 1/1, 1/2
    `name_en` VARCHAR(100) NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`level_id`) REFERENCES `levels`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ==========================================
-- 2. Users & Roles
-- ==========================================

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `school_id` INT UNSIGNED NULL, -- Null for Super Admin
    `name` VARCHAR(100) NOT NULL,
    `email` VARCHAR(100) NOT NULL UNIQUE,
    `password` VARCHAR(255) NOT NULL,
    `role` ENUM('super_admin', 'school_admin', 'teacher', 'student', 'parent') NOT NULL,
    `avatar` VARCHAR(255) DEFAULT 'default-avatar.png',
    `phone` VARCHAR(20) NULL,
    `iqama_id` VARCHAR(20) NULL, -- National ID
    `birth_date` DATE NULL,
    `gender` ENUM('male', 'female') NULL,
    `address` TEXT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`school_id`) REFERENCES `schools`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Extra details for Students (linked one-to-one with users)
DROP TABLE IF EXISTS `student_details`;
CREATE TABLE `student_details` (
    `user_id` INT UNSIGNED NOT NULL,
    `classroom_id` INT UNSIGNED NULL, -- Current class
    `parent_id` INT UNSIGNED NULL, 
    PRIMARY KEY (`user_id`),
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`classroom_id`) REFERENCES `classrooms`(`id`) ON DELETE SET NULL,
    FOREIGN KEY (`parent_id`) REFERENCES `users`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Extra details for Teachers
DROP TABLE IF EXISTS `teacher_details`;
CREATE TABLE `teacher_details` (
    `user_id` INT UNSIGNED NOT NULL,
    `specialization` VARCHAR(100) NULL,
    PRIMARY KEY (`user_id`),
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ==========================================
-- 3. Academic Content (Subjects, Courses)
-- ==========================================

DROP TABLE IF EXISTS `subjects`;
CREATE TABLE `subjects` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `level_id` INT UNSIGNED NOT NULL,
    `name_ar` VARCHAR(100) NOT NULL, -- Math, Science
    `name_en` VARCHAR(100) NOT NULL,
    `code` VARCHAR(20) NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`level_id`) REFERENCES `levels`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Course = Subject instance for a specific teacher/class (or just general subject material)
-- For simplicity in this system: A Subject is taught by a Teacher to a Classroom.
DROP TABLE IF EXISTS `courses`; 
CREATE TABLE `courses` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `subject_id` INT UNSIGNED NOT NULL,
    `teacher_id` INT UNSIGNED NOT NULL,
    `classroom_id` INT UNSIGNED NOT NULL,
    `semester` ENUM('1', '2', '3') DEFAULT '1',
    `academic_year` VARCHAR(20) NOT NULL, -- e.g., '2025-2026'
    `is_active` TINYINT(1) DEFAULT 1,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`subject_id`) REFERENCES `subjects`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`teacher_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`classroom_id`) REFERENCES `classrooms`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ==========================================
-- 4. Learning Components (Assignments, Materials, etc)
-- ==========================================

DROP TABLE IF EXISTS `assignments`;
CREATE TABLE `assignments` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `course_id` INT UNSIGNED NOT NULL,
    `title` VARCHAR(200) NOT NULL,
    `description` TEXT NULL,
    `file_path` VARCHAR(255) NULL,
    `due_date` DATETIME NULL,
    `max_points` INT DEFAULT 100,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`course_id`) REFERENCES `courses`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `assignment_submissions`;
CREATE TABLE `assignment_submissions` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `assignment_id` INT UNSIGNED NOT NULL,
    `student_id` INT UNSIGNED NOT NULL,
    `file_path` VARCHAR(255) NOT NULL,
    `submitted_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `grade` INT NULL,
    `feedback` TEXT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`assignment_id`) REFERENCES `assignments`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`student_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ==========================================
-- 5. Seed Data
-- ==========================================

-- Schools
INSERT INTO `schools` (`id`, `name_ar`, `name_en`, `slug`) VALUES
(1, 'مدارس الطفولة المبكرة', 'Early Childhood Schools', 'kg'),
(2, 'مدارس البنين', 'Boys Schools', 'boys'),
(3, 'مدارس البنات', 'Girls Schools', 'girls');

-- Departments (Example for Boys)
INSERT INTO `departments` (`id`, `school_id`, `name_ar`, `name_en`) VALUES
(1, 2, 'المسار العام', 'General Track'),
(2, 2, 'المسار الدولي', 'International Track');

-- Stages (Example for General Track Boys)
INSERT INTO `stages` (`id`, `department_id`, `name_ar`, `name_en`) VALUES
(1, 1, 'الابتدائي', 'Primary Stage'),
(2, 1, 'المتوسط', 'Middle Stage'),
(3, 1, 'الثانوي', 'Secondary Stage');

-- Users
-- Password: 123456
INSERT INTO `users` (`name`, `email`, `password`, `role`, `school_id`) VALUES
('Super Admin', 'super@capacities.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'super_admin', NULL),
('Boys Admin', 'admin.boys@capacities.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'school_admin', 2),
('Ahmed Teacher', 'teacher@capacities.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'teacher', 2),
('Ali Student', 'student@capacities.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'student', 2);

SET FOREIGN_KEY_CHECKS = 1;
