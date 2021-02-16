
DROP TABLE IF EXISTS City;
DROP TABLE IF EXISTS Person;
DROP TABLE IF EXISTS Ogranization;
DROP TABLE IF EXISTS NobelPrize;


-- City(id, name, country)
CREATE TABLE City (
	-- City ID
	id INT NOT NULL,
	-- City name
	name VARCHAR(100) NOT NULL,
	-- Country the city belongs to
	country VARCHAR(100) NOT NULL,
	-- Primary key constraint for City
	PRIMARY KEY (id)
);



-- Person(id, givenName, familyName, gender birth_date, birth_city_id)
CREATE TABLE Person (
	-- Person ID
	id INT NOT NULL,
	-- Given Name
	givenName VARCHAR(100),
	-- Family Name
	familyName VARCHAR(100),
	-- Gender
	gender VARCHAR(100),
	-- Date of Birth
	birth_date DATE, 
	-- City ID of the Birth City
	birth_city_id INT,
	-- Primary key constraint for Person
	PRIMARY KEY (id)
);


-- Ogranization(id, orgName, founded_date, city_id)
CREATE TABLE Organization(
	-- Organization ID
	id INT NOT NULL,
	-- The organization name
	orgName VARCHAR(100),
	-- The date when the organization was founded
	founded_date DATE,
	-- The city ID where the location locate at
	city_id INT, 

	PRIMARY KEY (id)
);


-- NobelPrizes(Id, num, awardYear, category, sortOrder, portion, dataAwarded, prizeStatus, PrizeAmount, affiliations_name, affiliation_city_id)
CREATE TABLE NobelPrize(
	-- Person ID
	id INT NOT NULL,
	-- The number of the awarding time
	num INT NOT NULL,
	-- Award year
	awardYear VARCHAR(100),
	-- Category
	category VARCHAR(100),
	-- Sorted Order
	sortOrder INT,
	-- Obtained Portion of the Award 
	portion VARCHAR(100),
	-- Awarded date
	dataAwarded DATE, 
	-- Prize Status
	prizeStatus VARCHAR(100),
	-- Prize Amount
	PrizeAmount INT, 
	-- Affiliation name
	affiliations_name VARCHAR(100), 
	-- City ID of the affiliation 
	affiliation_city_id INT, 
	-- Primary key constraint for NobelPrize
	PRIMARY KEY (id, num, affiliations_name, affiliation_city_id)
);



-- load City Data
LOAD DATA LOCAL INFILE '/home/cs143/project3/convert/city.del' 
INTO TABLE City
FIELDS TERMINATED BY '|'
-- expect fields to be enclosed within " quoting characters
LINES TERMINATED BY '\n';



-- load Person data
LOAD DATA LOCAL INFILE '/home/cs143/project3/convert/person.del' 
INTO TABLE Person
FIELDS TERMINATED BY ','
-- expect fields to be enclosed within " quoting characters
OPTIONALLY ENCLOSED BY '"'
LINES TERMINATED BY '\n';




-- load NobelPrize data
LOAD DATA LOCAL INFILE '/home/cs143/project3/convert/nobel_prize.del' 
INTO TABLE NobelPrize
FIELDS TERMINATED BY ","
-- expect fields to be enclosed within " quoting characters
OPTIONALLY ENCLOSED BY '"'
LINES TERMINATED BY '\n';


-- load Organization data
LOAD DATA LOCAL INFILE '/home/cs143/project3/convert/organization.del' 
INTO TABLE Organization 
FIELDS TERMINATED BY ","
OPTIONALLY ENCLOSED BY '"'
LINES TERMINATED BY '\n';



