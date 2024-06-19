SELECT * FROM students;

SELECT prenom FROM students;

SELECT prenom, datenaissance, genre FROM students;

SELECT * FROM students WHERE genre = 'F';

SELECT s.* 
FROM students s 
JOIN school sc ON s.school = sc.idschool
WHERE sc.school = 'Addy';

SELECT prenom FROM students
order by prenom desc;

SELECT prenom FROM students
order by prenom desc
limit 2;

insert into students (nom, prenom, datenaissance, genre, school)
values ('Dalor', 'Ginette', '1930-01-01', 'F', 1);

UPDATE students
SET prenom = 'Omer', genre = 'M'
WHERE nom = 'Dalor' AND prenom = 'Ginette';

DELETE FROM students WHERE idStudent = 3;

UPDATE school
SET school = 'Liege'
WHERE idschool = 1;

UPDATE school
SET school = 'Gent'
WHERE idschool = 2;
