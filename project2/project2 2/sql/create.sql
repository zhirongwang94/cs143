CREATE TABLE Movie (
	-- Movie ID
	id INT NOT NULL,
	-- Movie title
	title VARCHAR(100) NOT NULL,
	-- Release year
	year INT NOT NULL,
	-- MPAA rating
	rating VARCHAR(10) NOT NULL,
	-- Production company
	company VARCHAR(50) NOT NULL,
	-- Primary key constraint for Movie ID
	PRIMARY KEY (id)
);

CREATE TABLE Actor (
	-- Actor ID
	id INT NOT NULL,
	-- Last name
	last VARCHAR(20) NOT NULL,
	-- First name
	first VARCHAR(20) NOT NULL,
	-- Sex of the actor
	sex VARCHAR(6) NOT NULL,
	-- Date of birth
	dob DATE NOT NULL,
	-- Date of death
	dod DATE,
	-- Primary key constraint for Actor ID
	PRIMARY KEY (id),
	-- sex = "Female" or "Male"
	CHECK (sex = "Female" OR sex = "Male")
);

CREATE TABLE Director (
	-- Director ID
	id INT NOT NULL,
	-- Last name
	last VARCHAR(20) NOT NULL,
	-- First name
	first VARCHAR(20) NOT NULL,
	-- Date of birth
	dob DATE NOT NULL,
	-- Date of death
	dod DATE,
	-- Primary key constraint for Director ID
	PRIMARY KEY (id)
);

CREATE TABLE MovieGenre (
	-- Movie ID
	mid INT NOT NULL,
	-- Movie genre
	genre VARCHAR(20) NOT NULL,
	-- mid references Movie table
	FOREIGN KEY (mid) REFERENCES Movie(id)
);

CREATE TABLE MovieDirector (
	-- Movie ID
	mid INT NOT NULL,
	-- Director ID
	did INT NOT NULL,
	-- mid references Movie table
	FOREIGN KEY (mid) REFERENCES Movie(id),
	-- did references Director table
	FOREIGN KEY (did) REFERENCES Director(id)
);

CREATE TABLE MovieActor (
	-- Movie ID
	mid INT NOT NULL,
	-- Actor ID
	aid INT NOT NULL,
	-- Actor role in movie
	role VARCHAR(50) NOT NULL,
	-- mid references Movie table
	FOREIGN KEY (mid) REFERENCES Movie(id),
	-- aid references Actor table
	FOREIGN KEY (aid) REFERENCES Actor(id)
);


CREATE TABLE Review (
	-- Reviewer name
	name VARCHAR(20),
	-- Review time
	time TIMESTAMP DEFAULT NOW(),
	-- Movie ID
	mid INT NOT NULL,
	-- Review rating
	rating INT,
	-- Reviewer comment
	comment VARCHAR(500),
	-- mid references Movie table
	FOREIGN KEY (mid) REFERENCES Movie(id),
	-- 0 <= rating <= 5
	CHECK (rating IS NULL OR (0 <= rating AND rating <= 5))
);
