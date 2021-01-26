-- Give me the first and last names (in that order) of 
-- all the actors in the movie ‘Die Another Day’.
SELECT CONCAT(first, " ", last) AS "name" 
FROM Actor
JOIN MovieActor
ON Actor.id = MovieActor.aid
JOIN Movie
ON MovieActor.mid = Movie.id
WHERE title = "Die Another Day";