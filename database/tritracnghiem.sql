DROP DATABASE IF EXISTS thitracnghiem;
CREATE DATABASE IF NOT EXISTS thitracnghiem;
USE thitracnghiem;

CREATE TABLE roles (
    role_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    description VARCHAR(50)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

INSERT INTO roles(description) VALUES
    ("admin"),
    ("user");

CREATE TABLE quiz_types (
    quiz_type_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    description VARCHAR(50)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

INSERT INTO quiz_types(description) VALUES
    ("public"),
    ("private");

CREATE TABLE subjects (
    subject_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    subject_name VARCHAR(100),
    description TEXT(200),
    date_created DATETIME DEFAULT NOW(),
    date_edit TIMESTAMP,
    subject_status BOOL DEFAULT 1   -- active or inactive
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

INSERT INTO subjects(subject_name, description, subject_status) VALUES
    ("vật lý", "môn học cao quý", 1), 
    ("vật lý 6", "môn trời đánh", 1),   
    ("vật lý 12", "nghỉ ở nhà cho khỏe", 1),
    ("toán học", "môn học ngu người", 1),  
    ("toán học 7", "không học là ngu", 1), 
    ("toán học 12", "như một cái núi", 1), 
    ("sinh học", "môn học chán chường", 0),
    ("sinh học 8", "học rồi không quên", 1),
    ("ngữ văn", "môn không nên học", 0),   
    ("anh văn", "môn học bắt buộc", 1),    
    ("anh văn 1", "không biết chữ đuôi", 1),  
    ("tin học", "thích thì nhích thôi", 1),
    ("tin học 11", "pascal là giống gì vậy", 1),   
    ("hóa học", "môn nhiều người ghét", 0),
    ("hóa học 8", "hello world!", 1),   
    ("bảng tuần hoàn nguyên tố", "của ông menden ổng chế ra", 1);  

CREATE TABLE subject_relationships (
    subject_relationship_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    parent_subject_id INT UNSIGNED,
    child_subject_id INT UNSIGNED,

    FOREIGN KEY(parent_subject_id)
        REFERENCES subjects(subject_id),

    FOREIGN KEY(child_subject_id)
        REFERENCES subjects(subject_id)
);


INSERT INTO subject_relationships(parent_subject_id, child_subject_id) VALUES
    (1, 2),
    (1, 3),
    (4, 5),
    (4, 6),
    (7, 8),
    (10, 11),
    (12, 13),
    (14, 15),
    (15, 16);

CREATE TABLE accounts(
    account_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(60) NOT NULL,
    fullname VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci,
    sex VARCHAR(3) CHARACTER SET utf8 COLLATE utf8_unicode_ci,
    date_of_birth DATE,
    date_created DATETIME DEFAULT NOW() NOT NULL,
    date_edited TIMESTAMP,
    role_id INT UNSIGNED DEFAULT 2,
    account_status BOOL DEFAULT 1,

    FOREIGN KEY(role_id)
        REFERENCES roles(role_id)
);

CREATE TABLE quizs(
    quiz_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    quiz_name VARCHAR(100),
    subject_id INT UNSIGNED,
    description TEXT(500),
    quiz_type_id INT UNSIGNED,
    quiz_code VARCHAR(100),
    datetime_start DATETIME,
    datetime_finish DATETIME,
    num_of_questions INT UNSIGNED,
    max_score INT UNSIGNED,
    max_time TIME,
    is_random_question BOOL,
    is_random_answer BOOL,
    is_redo BOOL,
    date_created DATETIME DEFAULT NOW(),
    date_edited TIMESTAMP,
    quiz_status BOOL DEFAULT 0,
    account_id_create INT UNSIGNED,

    FOREIGN KEY(quiz_type_id)
        REFERENCES quiz_types(quiz_type_id),

    FOREIGN KEY(account_id_create)
        REFERENCES accounts(account_id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE TABLE questions(
    question_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    question_description TEXT(500),
    quiz_id INT UNSIGNED,

    FOREIGN KEY(quiz_id)
        REFERENCES quizs(quiz_id)

) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE TABLE answers(
    answer_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    answer_description TEXT(200),
    question_id INT UNSIGNED,
    is_correct_answer BOOL,

    FOREIGN KEY(question_id)
        REFERENCES questions(question_id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;;

CREATE TABLE exam_histories(
    exam_history_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    account_id INT UNSIGNED,
    quiz_id INT UNSIGNED,
    total_score FLOAT,
    num_of_correct FLOAT,
    num_of_wrong FLOAT,
    date_created DATETIME DEFAULT NOW()
);


INSERT INTO accounts(username, password, role_id, account_status) VALUES 
    ("admin", "$2y$10$mzQ8gD/Bkr4dJtaqwYBO.OgvBtw4O080v/acfO106jSDIQqKIVBK2", 1, 1);