--
-- Database: `votesystem`
--

-- --------------------------------------------------------

--
-- 表的结构 `admins` 管理员登录用
--

CREATE TABLE IF NOT EXISTS `admins`(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL ,
    `email` VARCHAR(255) NOT NULL ,
    `password` VARCHAR(255) NOT NULL,
    `remember_token` VARCHAR(255) DEFAULT NULL,
    `created_at` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00',
    `updated_at` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00',
    UNIQUE INDEX (`name`),
    UNIQUE INDEX (`email`),
    PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `academies` 学院信息表
--
CREATE TABLE IF NOT EXISTS `academies`(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `votes_num` INTEGER UNSIGNED NOT NULL DEFAULT '0',
    `created_at` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00',
    `updated_at` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00',
    INDEX (`name`),
    PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `memtors` 导师信息表
--
CREATE TABLE IF NOT EXISTS `memtors`(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `academy_id` INTEGER UNSIGNED NOT NULL,
    `votes_num` INTEGER UNSIGNED NOT NULL DEFAULT '0',
    `name` VARCHAR(32) NOT NULL,
    `gender` ENUM('男','女') NOT NULL,
    `job_title` VARCHAR(255) NOT NULL,
    `photo_url` VARCHAR(255) NOT NULL,
    `introduction` TEXT NOT NULL,
    `recommend` TEXT NOT NULL,
    `short_comment` VARCHAR(255) NOT NULL,
    `created_at` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00',
    `updated_at` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00',
    INDEX (`academy_id`),
    PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `students` 学生信息表
--
CREATE TABLE IF NOT EXISTS `students`(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `student_num` BIGINT UNSIGNED NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `name` VARCHAR(64) NOT NULL,
    `has_voted` TINYINT(1) NOT NULL DEFAULT '0',
    `created_at` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00',
    `updated_at` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00',
    UNIQUE INDEX (`student_num`),
    PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `votes` 投票关联表
--
CREATE TABLE IF NOT EXISTS `memtor_student_votes`(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `memtor_id` INTEGER UNSIGNED NOT NULL,
    `student_id` INTEGER UNSIGNED NOT NULL,
    `created_at` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00',
    `updated_at` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00',
    INDEX `votes_momtor_id` (`memtor_id`),
    INDEX `votes_stuent_id` (`student_id`),
    PRIMARY KEY (`id`),
    CONSTRAINT `msv_memtor_id_fk` FOREIGN KEY(`memtor_id`) REFERENCES `memtors`(`id`) ON DELETE CASCADE,
    CONSTRAINT `msv_student_id_fk` FOREIGN KEY(`student_id`) REFERENCES `students`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `comments` 留言关联表
--
CREATE TABLE IF NOT EXISTS `memtor_student_comments`(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `memtor_id` INTEGER UNSIGNED NOT NULL,
    `student_id` INTEGER UNSIGNED NOT NULL,
    `is_anonym` TINYINT(1) NOT NULL DEFAULT '0',
    `content` VARCHAR(255) NOT NULL,
    `created_at` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00',
    `updated_at` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00',
    INDEX (`memtor_id`),
    INDEX (`student_id`),
    INDEX (`is_anonym`),
    INDEX (`created_at`),
    PRIMARY KEY (`id`),
    CONSTRAINT `msc_memtor_id_fk` FOREIGN KEY(`memtor_id`) REFERENCES `memtors`(`id`) ON DELETE CASCADE,
    CONSTRAINT `msc_student_id_fk` FOREIGN KEY(`student_id`) REFERENCES `student`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `activities` 活动信息
--
CREATE TABLE IF NOT EXISTS `activities`(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `is_expired` TINYINT(1) NOT NULL DEFAULT 0,
    `begin_at` DATE NOT NULL DEFAULT '0000-00-00',
    `end_at` DATE NOT NULL DEFAULT '0000-00-00',
    `video_url` VARCHAR(255) NOT NULL,
    `video_explain` TEXT DEFAULT NULL,
    `introduction` TEXT NOT NULL,
    `created_at` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00',
    `updated_at` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00',
    PRIMARY KEY (`id`),
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- 表的结构 `webimages` 网站样式
--
CREATE TABLE IF NOT EXISTS `webimages`(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `image_url` VARCHAR(255) NOT NULL,
    `image_type` ENUM('bg','tt') NOT NULL,
    `created_at` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00',
    `updated_at` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00',
    INDEX (`image_type`),
    PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;