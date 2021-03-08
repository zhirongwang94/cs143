


# set up SparkContext for WordCount application
from pyspark import SparkContext
from itertools import combinations 
from pyspark.sql.functions import col, size
from pyspark.sql import SparkSession


sc = SparkContext("local", "WordCount") 
spark = SparkSession(sc)




############################################################
# read the data file to a RDD object
lines = sc.textFile("/home/cs143/data/goodreads.user.books")
# lines = sc.textFile("/home/cs143/data/newFile")
# lines.collect()

# split the line RDDs into (userID, [book1, book2...]) tuple RDDs
# output: [['1', '950,963'], ['2', '1072,1074,1210'], ['3', '1488']...]
userID_bookIDs = lines.map(lambda line: line.split(":"))
# userID_bookIDs.collect()

# split the bookIDs
# output: [('1', ['950', '963']), ('2', ['1072', '1074', '1210']), ('3', ['1488'])]
bookIDs_byUser = userID_bookIDs.map(lambda userID_bookID: (userID_bookID[0], userID_bookID[1].split(",")))
# bookIDs_byUser.collect()


# convert bookIDs_byUser RDD to Dataframe
# output:
# +------+------------------+
# |userID|           bookIDs|
# +------+------------------+
# |     1|        [950, 963]|
# |     2|[1072, 1074, 1210]|
# |     3|            [1488]|
# +------+------------------+
df = bookIDs_byUser.toDF(["userID","bookIDs"])
# df.show()

# filter out the tuple where there is only one bookID in the bookIDs field
# output:
# +------+------------------+
# |userID|           bookIDs|
# +------+------------------+
# |     1|        [950, 963]|
# |     2|[1072, 1074, 1210]|
# +------+------------------+
filtered_df = df.where(size(col("bookIDs")) > 1)
# to avoid the error caused by no paire 
# filtered_df.show()

# convert the data frame back to rdd
# output: [('1', ['950', '963']), ('2', ['1072', '1074', '1210'])]
filtered_rdd = filtered_df.rdd 
filtered_rdd = filtered_rdd.map(lambda row: (row[0], row[1]))
# filtered_rdd.collect()


# pairing up the bookIDs by userID
# output:
# [(('950', '963'), 1), (('1074', '1072'), 1), (('1210', '1072'), 1), (('1074', '1210'), 1)]
def getPairs(a):
	bookIDs = a[1]
	combos = list(combinations(bookIDs,2))
	pairs = []
	for i in combos:
		pairs.append((i,1))
	return pairs

booksIDPairs1s = filtered_rdd.flatMap(lambda a: getPairs(a))
# booksIDPairs1s.collect()



# sum up, no need to use set, since the bookID are sorted  
# output:
# [(('1072', '1074'), 1), (('950', '963'), 1), (('1072', '1210'), 1), (('1074', '1210'), 1)]
booksIDPairCount = booksIDPairs1s.reduceByKey(lambda a, b: a+b)
# booksIDPairCount.collect()



# filter out pairs whose counts less than 20
# output:
# +-----------+------+
# |bookID_Pair|counts|
# +-----------+------+
# |..		  |21    |
# +-----------+------+
df = booksIDPairCount.toDF(["bookID_Pair", "counts"])
# df.show()

df = df.filter(df.counts > 20 )
# df.show()


# convert the data frame back to RDD

rdd = df.rdd 
rdd = rdd.map(lambda row: ( (row[0][0], row[0][1]), row[1]))
rdd.saveAsTextFile("output")
# rdd.collect()


  
