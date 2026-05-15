-- Combined Setup File for Capacities Platform
-- Includes both Database Schema and Seed Data for easy import in MySQL Workbench.

-- ==========================================
-- SECTION 1: DATABASE SCHEMA
-- ==========================================

CREATE DATABASE IF NOT EXISTS `capacities_db`;
USE `capacities_db`;

SET FOREIGN_KEY_CHECKS = 0;

-- -----------------------------------------------------
-- Table: users
-- -----------------------------------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `role` ENUM('admin', 'teacher', 'student') NOT NULL DEFAULT 'student',
  `avatar` VARCHAR(255) DEFAULT 'default-avatar.png',
  `bio` TEXT NULL,
  `phone` VARCHAR(20) NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `email_unique` (`email` ASC)
) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table: courses
-- -----------------------------------------------------
DROP TABLE IF EXISTS `courses`;
CREATE TABLE `courses` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(200) NOT NULL,
  `code` VARCHAR(20) NOT NULL,
  `description` TEXT NULL,
  `teacher_id` INT UNSIGNED NOT NULL,
  `image` VARCHAR(255) DEFAULT 'course-placeholder.jpg',
  `start_date` DATE NULL,
  `end_date` DATE NULL,
  `status` ENUM('active', 'archived') DEFAULT 'active',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `code_unique` (`code` ASC),
  INDEX `fk_courses_teacher_idx` (`teacher_id` ASC),
  CONSTRAINT `fk_courses_teacher`
    FOREIGN KEY (`teacher_id`)
    REFERENCES `users` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table: enrollments
-- -----------------------------------------------------
DROP TABLE IF EXISTS `enrollments`;
CREATE TABLE `enrollments` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `student_id` INT UNSIGNED NOT NULL,
  `course_id` INT UNSIGNED NOT NULL,
  `enrolled_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `status` ENUM('active', 'dropped', 'completed') DEFAULT 'active',
  PRIMARY KEY (`id`),
  UNIQUE INDEX `student_course_unique` (`student_id`, `course_id`),
  INDEX `fk_enrollments_course_idx` (`course_id` ASC),
  CONSTRAINT `fk_enrollments_student`
    FOREIGN KEY (`student_id`)
    REFERENCES `users` (`id`)
    ON DELETE CASCADE,
  CONSTRAINT `fk_enrollments_course`
    FOREIGN KEY (`course_id`)
    REFERENCES `courses` (`id`)
    ON DELETE CASCADE
) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table: assignments
-- -----------------------------------------------------
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
  INDEX `fk_assignments_course_idx` (`course_id` ASC),
  CONSTRAINT `fk_assignments_course`
    FOREIGN KEY (`course_id`)
    REFERENCES `courses` (`id`)
    ON DELETE CASCADE
) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table: assignment_submissions
-- -----------------------------------------------------
DROP TABLE IF EXISTS `assignment_submissions`;
CREATE TABLE `assignment_submissions` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `assignment_id` INT UNSIGNED NOT NULL,
  `student_id` INT UNSIGNED NOT NULL,
  `file_path` VARCHAR(255) NOT NULL,
  `submitted_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `grade` INT NULL,
  `feedback` TEXT NULL,
  `status` ENUM('submitted', 'graded', 'late') DEFAULT 'submitted',
  PRIMARY KEY (`id`),
  UNIQUE INDEX `assignment_student_unique` (`assignment_id`, `student_id`),
  CONSTRAINT `fk_submissions_assignment`
    FOREIGN KEY (`assignment_id`)
    REFERENCES `assignments` (`id`)
    ON DELETE CASCADE,
  CONSTRAINT `fk_submissions_student`
    FOREIGN KEY (`student_id`)
    REFERENCES `users` (`id`)
    ON DELETE CASCADE
) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table: quizzes
-- -----------------------------------------------------
DROP TABLE IF EXISTS `quizzes`;
CREATE TABLE `quizzes` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `course_id` INT UNSIGNED NOT NULL,
  `title` VARCHAR(200) NOT NULL,
  `description` TEXT NULL,
  `duration_minutes` INT NOT NULL DEFAULT 60,
  `start_time` DATETIME NULL,
  `end_time` DATETIME NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_quizzes_course`
    FOREIGN KEY (`course_id`)
    REFERENCES `courses` (`id`)
    ON DELETE CASCADE
) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table: questions
-- -----------------------------------------------------
DROP TABLE IF EXISTS `questions`;
CREATE TABLE `questions` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `quiz_id` INT UNSIGNED NOT NULL,
  `question_text` TEXT NOT NULL,
  `type` ENUM('mcq', 'true_false', 'short_answer') DEFAULT 'mcq',
  `options` JSON NULL, -- Stores options as JSON array for MCQs ["Option A", "Option B"]
  `correct_answer` TEXT NOT NULL,
  `points` INT DEFAULT 1,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_questions_quiz`
    FOREIGN KEY (`quiz_id`)
    REFERENCES `quizzes` (`id`)
    ON DELETE CASCADE
) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table: quiz_attempts
-- -----------------------------------------------------
DROP TABLE IF EXISTS `quiz_attempts`;
CREATE TABLE `quiz_attempts` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `quiz_id` INT UNSIGNED NOT NULL,
  `student_id` INT UNSIGNED NOT NULL,
  `start_time` DATETIME NOT NULL,
  `end_time` DATETIME NULL,
  `score` FLOAT DEFAULT 0,
  `answers` JSON NULL, -- Store student answers as JSON
  PRIMARY KEY (`id`),
  UNIQUE INDEX `quiz_student_unique` (`quiz_id`, `student_id`),
  CONSTRAINT `fk_attempts_quiz`
    FOREIGN KEY (`quiz_id`)
    REFERENCES `quizzes` (`id`)
    ON DELETE CASCADE,
  CONSTRAINT `fk_attempts_student`
    FOREIGN KEY (`student_id`)
    REFERENCES `users` (`id`)
    ON DELETE CASCADE
) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table: materials
-- -----------------------------------------------------
DROP TABLE IF EXISTS `materials`;
CREATE TABLE `materials` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `course_id` INT UNSIGNED NOT NULL,
  `title` VARCHAR(200) NOT NULL,
  `description` TEXT NULL,
  `file_path` VARCHAR(255) NOT NULL,
  `uploaded_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_materials_course`
    FOREIGN KEY (`course_id`)
    REFERENCES `courses` (`id`)
    ON DELETE CASCADE
) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table: attendance
-- -----------------------------------------------------
DROP TABLE IF EXISTS `attendance`;
CREATE TABLE `attendance` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `course_id` INT UNSIGNED NOT NULL,
  `student_id` INT UNSIGNED NOT NULL,
  `date` DATE NOT NULL,
  `status` ENUM('present', 'absent', 'late', 'excused') DEFAULT 'present',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `attendance_unique` (`course_id`, `student_id`, `date`),
  CONSTRAINT `fk_attendance_course`
    FOREIGN KEY (`course_id`)
    REFERENCES `courses` (`id`)
    ON DELETE CASCADE,
  CONSTRAINT `fk_attendance_student`
    FOREIGN KEY (`student_id`)
    REFERENCES `users` (`id`)
    ON DELETE CASCADE
) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table: notifications
-- -----------------------------------------------------
DROP TABLE IF EXISTS `notifications`;
CREATE TABLE `notifications` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` INT UNSIGNED NOT NULL,
  `title` VARCHAR(255) NOT NULL,
  `message` TEXT NOT NULL,
  `is_read` TINYINT(1) DEFAULT 0,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_notifications_user`
    FOREIGN KEY (`user_id`)
    REFERENCES `users` (`id`)
    ON DELETE CASCADE
) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

SET FOREIGN_KEY_CHECKS = 1;


-- ==========================================
-- SECTION 2: SEED DATA
-- ==========================================

-- Seed Data for Capacities Platform

-- Users
-- Password for all is '123456' (Hashed: $2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi)
INSERT INTO `users` (`name`, `email`, `password`, `role`, `created_at`) VALUES
('Admin User', 'admin@capacities.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin', NOW()),
('Ahmed Teacher', 'teacher1@capacities.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'teacher', NOW()),
('Sara Teacher', 'teacher2@capacities.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'teacher', NOW()),
('Mohamed Student', 'student1@capacities.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'student', NOW()),
('Ali Student', 'student2@capacities.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'student', NOW()),
('Mona Student', 'student3@capacities.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'student', NOW());

-- Courses
INSERT INTO `courses` (`title`, `code`, `description`, `teacher_id`, `status`) VALUES
('Introduction to Computer Science', 'CS101', 'Basic concepts of CS', 2, 'active'),
('Web Development', 'WEB200', 'HTML, CSS, JS, and PHP', 2, 'active'),
('Advanced Mathematics', 'MATH300', 'Calculus and Algebra', 3, 'active');

-- Enrollments
INSERT INTO `enrollments` (`student_id`, `course_id`, `status`) VALUES
(4, 1, 'active'), -- Mohamed -> CS101
(4, 2, 'active'), -- Mohamed -> WEB200
(5, 1, 'active'), -- Ali -> CS101
(5, 3, 'active'), -- Ali -> MATH300
(6, 2, 'active'); -- Mona -> WEB200

-- Materials
INSERT INTO `materials` (`course_id`, `title`, `description`, `file_path`) VALUES
(1, 'Lecture 1 Slides', 'Introduction slides', 'uploads/materials/lec1.pdf'),
(2, 'HTML Cheatsheet', 'Quick reference for HTML', 'uploads/materials/html.pdf');

-- Assignments
INSERT INTO `assignments` (`course_id`, `title`, `description`, `due_date`, `max_points`) VALUES
(1, 'Algorithm Practice', 'Write pseudocode for sorting', DATE_ADD(NOW(), INTERVAL 7 DAY), 50),
(2, 'Personal Website', 'Build a profile page', DATE_ADD(NOW(), INTERVAL 14 DAY), 100);

-- Quizzes
INSERT INTO `quizzes` (`course_id`, `title`, `duration_minutes`) VALUES
(1, 'Midterm Exam', 90),
(2, 'HTML Quiz', 30);

-- Questions for HTML Quiz
INSERT INTO `questions` (`quiz_id`, `question_text`, `type`, `options`, `correct_answer`, `points`) VALUES
(2, 'What does HTML stand for?', 'mcq', '["Hyper Text Markup Language", "Home Tool Markup Language", "Hyperlinks and Text Markup Language"]', 'Hyper Text Markup Language', 5),
(2, 'Choose the correct HTML element for the largest heading:', 'mcq', '["<heading>", "<h1>", "<h6>", "<head>"]', '<h1>', 5);

-- Attendance (for today)
INSERT INTO `attendance` (`course_id`, `student_id`, `date`, `status`) VALUES
(1, 4, CURDATE(), 'present'),
(1, 5, CURDATE(), 'absent');
