-- ClubBoard database
-- Import this file once (phpMyAdmin > Import) to create everything.

CREATE DATABASE IF NOT EXISTS club_board;
USE club_board;

-- Table 1: the activities students can join
CREATE TABLE IF NOT EXISTS activities (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    description VARCHAR(255) NOT NULL,
    activity_date DATE NOT NULL,
    place VARCHAR(100) NOT NULL
);

-- Table 2: the students who signed up (activity_id points to activities.id)
CREATE TABLE IF NOT EXISTS signups (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    activity_id INT NOT NULL,
    signed_up_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (activity_id) REFERENCES activities(id)
);