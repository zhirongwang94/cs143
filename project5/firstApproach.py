# ## Goal: Make a new RDD from the text of the README file 
# ## in the Spark source directory 

# ## What RDDs can do:
# ## They use their actions to return values and
# ## and transformation.

# ## RDD Actions:
# ##		.count(), .first()

# ## RDD Transformation:
# ##		.filter(lambda line: "Spark" in line)
# ##		.filter(fun_arg)
 
# ## Challenge:
# ## RDD actions, transformation:
# ## eg: Find the line with the most words
# ## textFile.map(lambda line: len(line.split())).reduce(lambda a, b: a if (a > b) else b)

# ## textFile.map(lambda line: len(line.split())).reduce(max) 
# ## max is a self-defined function 


# # set up SparkContext for WordCount application
# # Only one sparkContext should be active per JVM
# # JVM java virtual machine 
 
# from pyspark import SparkContext
# sc = SparkContext("local", "WordCount")





# ## output: the main map-reduce task
# lines = sc.textFile("goodreads.user.books")
# ## output: goodreads.user.books MapPartitionsRDD[17] at textFile at NativeMethodAccessorImpl.java:0


# textFile = spark.read.text("goodreads.user.books")
# DataFrame[value: string]


# words = lines.flatMap(lambda line: line.split(" "))
# word1s = words.map(lambda word: (word, 1))
# wordCounts = word1s.reduceByKey(lambda a, b: a+b)
# wordCounts.saveAsTextFile("output")

# MapPartitionsRDD
# ParallelCollectionRDD
# PythonRDD


# docker cp  spark:/home/cs143/input.txt  /Users/zhirongwang/desktop/cs143/project5/input.txt








# ==============
# # set up SparkContext for WordCount application
# from pyspark import SparkContext
# sc = SparkContext("local", "WordCount")

# # the main map-reduce task
# lines = sc.textFile("input.txt")

# // lines.map: map each individual into one array
# // one to one 
# testWords = lines.map(lambda line: line.split(" "))

# // lines.flatMap: map each individual into one array, 
# // then combine the array
# // flatten the map 
# // one to many 
# words = lines.flatMap(lambda line: line.split(" "))

# // words.map 
# word1s = words.map(lambda word: (word, 1))



# wordCounts = word1s.reduceByKey(lambda a, b: a+b)
# wordCounts.saveAsTextFile("output")


# lineCollect = lines.collect()
# wordCollect = words.collect()
# word1Collect = word1s.collect()
# wordCountCollect = wordCounts.collect()
# wordCounts.saveAsTextFile("output")


# ======
# myCollection = myRDD.collect("goodreads.user.books")






# ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
# set up SparkContext for WordCount application
from pyspark import SparkContext
sc = SparkContext("local", "WordCount")

# read the data file to a RDD object
lines = sc.textFile("./data/goodreads.user.books")

# split the line RDDs into (userID, [book1, book2...]) tuple RDDs
user_book = lines.map(lambda line: line.split(":"))

# extract the [book1, book2...] from (userID, [book1, book2...]) tuple RDDs
booksGroupByUser = user_book.map(lambda user_book: user_book[1])

# flatten the book arrays into one array. 
books =booksGroupByUser.flatMap(lambda line: line.split(","))

# turn each bookID occurance into (bookID, 1) form
book1s = books.map(lambda bookID: (bookID, 1))

# sum up the count of bookID by reduceByKey
bookID_reviewCount = book1s.reduceByKey(lambda a, b: a+b)

# convert bookID_reviewCount to a dataframe(bookID, counts) 
df = bookID_reviewCount.toDF(["bookID", "counts"])

# select books that have been review more than 20 times 
df1 = df.filter(df.counts > 290)
df2 = df1.filter(df1.counts < 305)

df2.show()

# group the bookID by the counts
counts_bookIDs = df2.groupby("counts").agg(f.collect_list("bookID").alias("bookIDs"))


# convert data frame to RDD 
rdd = counts_bookIDs.rdd

# format RDD
formated_rdd = rdd.map(lambda row: (tuple(row[1]), row[0]))

# RDD to array
formated_rdd.collect()





# bookID_reviewCount1 = bookID_reviewCount.filter(bookID_reviewCount > 20)







# ## bookID_reviewCount1 = book1s.reduceByKey(lambda a, b: (a,b))
# ## bookID_reviewCount1.collect()

# ## flip count and bookID
# reviewCount_bookID = bookID_reviewCount.map(lambda a:(str(a[1]),a[0]))

# ## reviewCount_bookID.collect()[0]
# reviewCount_books =  reviewCount_bookID.reduceByKey(lambda a, b: (a,b))
# ## reviewCount_books.collect()

# combination = reviewCount_bookID.reduceByKey(lambda a,b: [[a], [b]])

# flatten = lambda t: [item for sublist in t for item in sublist]





# books_reviewCount = bookReviewCount.reduceByKey(lambda)

# books2 = user_book.flatMap(lambda user_book: user_book[1])



# word1s = words.map(lambda word: (word, 1))
# wordCounts = word1s.reduceByKey(lambda a, b: a+b)
# wordCounts.saveAsTextFile("output")






