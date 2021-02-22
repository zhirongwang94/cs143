

-- q1
SELECT id FROM Person
WHERE givenName LIKE "Marie"
AND familyName LIKE 'Curie';



-- -- q2
-- SELECT country FROM City WHERE id=(
-- SELECT DISTINCT affiliation_city_id FROM NobelPrize
-- WHERE affiliations_name LIKE "CERN")



-- -- q3
-- SELECT familyName FROM(
-- 	SELECT familyName, COUNT(familyName) AS c FROM Person
-- 	GROUP BY familyName
-- 	-- ORDER BY COUNT(*) DESC
-- ) AS Sub31

-- WHERE c=(
-- SELECT MAX(c) FROM(
-- 	SELECT familyName, COUNT(familyName) AS c FROM Person
-- 	GROUP BY familyName
-- 	-- ORDER BY COUNT(*) DESC
-- ) AS Sub32)



-- -- q4
-- Select COUNT(DISTINCT affiliation_city_id) from NobelPrize 
-- WHERE affiliations_name LIKE "University of California"



-- -- q5
-- SELECT COUNT(DISTINCT awardYear) FROM Organization, NobelPrize
-- WHERE Organization.id=NobelPrize.id




