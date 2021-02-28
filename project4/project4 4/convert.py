import json

# load data
data = json.load(open("/home/cs143/data/nobel-laureates.json", "r"))
# data = json.load(open("nobel-laureates.json", "r"))


# python object(dictionary) to be dumped 
dict1 ={ 
    "emp1": { 
        "name": "Lisa", 
        "designation": "programmer", 
        "age": "34", 
        "salary": "54000"
    }, 

    "emp2": { 
        "name": "Elis", 
        "designation": "Trainee", 
        "age": "24", 
        "salary": "40000"
    }, 
} 
  
# the json file where the output must be stored 
out_file = open("myfile.json", "w") 
  
json.dump(dict1, out_file, indent = 3) 
  
out_file.close() 





# get the id, givenName, and familyName of the first laureate
# laureate = data["laureates"][0]
# id = laureate["id"]
# givenName = laureate["givenName"]["en"]
# familyName = laureate["familyName"]["en"]
# # print the extracted information
# print(id + "\t" + givenName + "\t" + familyName)


# I am now trying to read the data to {} 

laureates = data["laureates"]
laureates_file = open("laureates.import", "w") 
# laureates_file.write(str(hello_string))


for i in laureates:
	json.dump(i, laureates_file, indent = 3);
	laureates_file.write('\n')


laureates_file.close()


print("Finished Runing \n")

