USE resume_db;

INSERT INTO users (lastname, firstname, email, phone, picture)
VALUES 
('Vuillard', 'Ethan', 'ethan.vuillard@epitech.eu', '0661738906', 'blank');

INSERT INTO experiences (user_id, name, description, startdate, enddate) 
VALUES 
(1, 'Personal Project - Portfolio Website', 'Created a personal website to showcase my skills and projects using HTML, CSS, and PHP.', '2025-10-30', '2025-11-02');

INSERT INTO educations (user_id, name, description, startdate, enddate)
VALUES 
(1, 'High School Diploma - STMG', 'Specialization in Marketing and Management', '2021-09-01', '2024-06-30'),
(1, 'Bachelor Year 1 - EPITECH', 'Computer Science and Software Development - EPITECH Paris', '2025-09-01', '2026-06-30');

INSERT INTO skills (user_id, name, level)
VALUES 
(1, 'HTML/CSS', 'Beginner'),
(1, 'PHP', 'Beginner'),
(1, 'MySQL', 'Beginner'),
(1, 'Docker', 'Learning'),
(1, 'Python', 'Beginner');