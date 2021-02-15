-- load Movie data
LOAD DATA LOCAL INFILE '/home/cs143/data/movie.del' 
INTO TABLE Movie 
FIELDS TERMINATED BY ","
-- expect fields to be enclosed within " quoting characters
OPTIONALLY ENCLOSED BY '"'
LINES TERMINATED BY '\n';


-- load Actor data
-- load actor1.del to Actor table 
LOAD DATA LOCAL INFILE '/home/cs143/data/actor1.del' 
INTO TABLE Actor 
FIELDS TERMINATED BY ","
OPTIONALLY ENCLOSED BY '"' 
LINES TERMINATED BY '\n';

-- load actor2.del to Actor table 
LOAD DATA LOCAL INFILE '/home/cs143/data/actor2.del' 
INTO TABLE Actor 
FIELDS TERMINATED BY ","
OPTIONALLY ENCLOSED BY '"'
LINES TERMINATED BY '\n';

-- load actor3.del to Actor table 
LOAD DATA LOCAL INFILE '/home/cs143/data/actor3.del' 
INTO TABLE Actor 
FIELDS TERMINATED BY ","
OPTIONALLY ENCLOSED BY '"'
LINES TERMINATED BY '\n';


-- load Director data
LOAD DATA LOCAL INFILE '/home/cs143/data/director.del' 
INTO TABLE Director 
FIELDS TERMINATED BY ","
OPTIONALLY ENCLOSED BY '"'
LINES TERMINATED BY '\n';

-- load MovieGenre data
LOAD DATA LOCAL INFILE '/home/cs143/data/moviegenre.del' 
INTO TABLE MovieGenre 
FIELDS TERMINATED BY ","
OPTIONALLY ENCLOSED BY '"'
LINES TERMINATED BY '\n';

-- load MovieDirector data
LOAD DATA LOCAL INFILE '/home/cs143/data/moviedirector.del' 
INTO TABLE MovieDirector 
FIELDS TERMINATED BY ","
OPTIONALLY ENCLOSED BY '"'
LINES TERMINATED BY '\n';

-- load MovieActor data
-- load movieactor1.del into MovieAcotr table 
LOAD DATA LOCAL INFILE '/home/cs143/data/movieactor1.del' 
INTO TABLE MovieActor 
FIELDS TERMINATED BY ","
OPTIONALLY ENCLOSED BY '"'
LINES TERMINATED BY '\n';

-- load movieactor2.del into MovieAcotr table 
LOAD DATA LOCAL INFILE '/home/cs143/data/movieactor2.del' 
INTO TABLE MovieActor 
FIELDS TERMINATED BY ","
OPTIONALLY ENCLOSED BY '"'
LINES TERMINATED BY '\n';



-- no load file for Review table, since it will be added by users. 
