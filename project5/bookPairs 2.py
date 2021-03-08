


# set up SparkContext for WordCount application
from pyspark import SparkContext
from itertools import combinations 
from pyspark.sql.functions import col, size
from pyspark.sql import SparkSession


sc = SparkContext("local", "WordCount") 
spark = SparkSession(sc)



rdd = sc.textFile("goodreads.user.books").map(lambda line: line.split(":")).map(lambda user_books: (user_books[0], user_books[1].split(",")))
# >>> rdd.collect()
# ['1:950,963', '2:1072,1074,1210', '3:1488', '4:996,1072,1074']


rdd1 = readFile.map(lambda line: line.split(":"))
# >>> rdd1.collect()
# [['1', '950,963'], ['2', '1072,1074,1210'], ['3', '1488'], ['4', '996,1072,1074']]

rdd2 = rdd1.map(lambda user_books: (user_books[0], user_books[1].split(",")))
# >>> rdd2.collect()
# [('1', ['950', '963']), ('2', ['1072', '1074', '1210']), ('3', ['1488']), ('4', ['996', '1072', '1074'])]


df = rdd2.toDF()
# >>> df.show()
# +---+------------------+
# | _1|                _2|
# +---+------------------+
# |  1|        [950, 963]|
# |  2|[1072, 1074, 1210]|
# |  3|            [1488]|
# |  4| [996, 1072, 1074]|
# +---+------------------+


df1 = df.where(size(col("_2")) >= 2)
# >>> df1.show()
# +---+------------------+
# | _1|                _2|
# +---+------------------+
# |  1|        [950, 963]|
# |  2|[1072, 1074, 1210]|
# |  4| [996, 1072, 1074]|
# +---+------------------+



# convert df back to rdd 
rdd3 = df1.rdd.map(lambda field: (field[0], field[1]))
# >>> rdd3.collect()
# [('1', ['950', '963']), ('2', ['1072', '1074', '1210']), ('3', ['1488']), ('4', ['996', '1072', '1074'])]


rdd4 = rdd3.map(lambda a: a[1])
# >>> rdd4.collect()
# [['950', '963'], ['1072', '1074', '1210'], ['1488'], ['996', '1072', '1074']]

rdd5 = rdd4.flatMap(lambda books: list(combinations(books,2)))
# >>> rdd5.collect()
# [('950', '963'), ('1072', '1074'), ('1072', '1210'), ('1074', '1210'), ('996', '1072'), ('996', '1074'), ('1072', '1074')]


rdd6 = rdd5.map(lambda a: (a, 1))
# >>> rdd6.collect()
# [(('950', '963'), 1), (('1072', '1074'), 1), (('1072', '1210'), 1), (('1074', '1210'), 1), (('996', '1072'), 1), (('996', '1074'), 1), (('1072', '1074'), 1)]


rdd7 = rdd6.reduceByKey(lambda a, b: a+b)
# >>> rdd7.collect()
# [(('1072', '1074'), 2), (('996', '1072'), 1), (('996', '1074'), 1), (('950', '963'), 1), (('1072', '1210'), 1), (('1074', '1210'), 1)]



df2 = rdd7.toDF()
# >>> df2.show()
# +------------+---+
# |          _1| _2|
# +------------+---+
# |[1072, 1074]|  2|
# | [996, 1072]|  1|
# | [996, 1074]|  1|
# |  [950, 963]|  1|
# |[1072, 1210]|  1|
# |[1074, 1210]|  1|
# +------------+---+


df3 = df2.filter(df2._2 >= 20 )
# >>> df3 = df2.filter(df2._2 >= 2 )
# >>> df3.show()
# +------------+---+
# |          _1| _2|
# +------------+---+
# |[1072, 1074]|  2|
# +------------+---+
# it works



# convert df to rdd, and save it
rdd8 = df3.rdd.map(lambda row: ( (row[0][0], row[0][1]), row[1]))
rdd.saveAsTextFile("output")





