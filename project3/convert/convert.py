
import json 
import sys
# sys.setdefaultencoding() does not exist, here!
reload(sys)  # Reload does the trick!
sys.setdefaultencoding('UTF8')

nobel_json_file = open('nobel-laureates.json')

city_table = open("city.del", "w") 
person_table = open("person.del", "w") 
organization_table = open("organization.del", "w") 
nobel_prize_table = open("nobel_prize.del", "w") 

# person_table.write("id, givenName, familyName, gender birth_date, birth_city_id\n")

# array of dictinary {u'city': ".. ", u'country': ".. "}
Cities = []  


def get_city_id(place):
	city_dict = {u'city': ".", u'country': "."}

	if place.has_key(u'city'):
		city_dict[u'city'] = place[u'city'][u'en']
		if place.has_key(u'country'):
			city_dict[u'country'] = place[u'country'][u'en']
	# print ("city dictL: ", city_dict)
	if city_dict not in Cities:
		Cities.append(city_dict)

	return str(Cities.index(city_dict))


def get_english_name(name_dict):
	if name_dict.has_key(u'en'):
		return name_dict[u'en']
	else:
		return 'null'

def format_person_tuple(laureate):
	# keys_to_lookup = [u'id', u'givenName', u'familyName', u'gender', u'birth']

	person_tuple = ""

	if laureate.has_key(u'id'):
		person_tuple = person_tuple + laureate[u'id'] + u', '
	else:
		return

	if laureate.has_key(u'givenName'):
		name_dict = laureate[u'givenName']
		person_tuple = person_tuple + get_english_name(name_dict) + u', '
	else:
		person_tuple = person_tuple + "null" + u', '


	if laureate.has_key(u'familyName'):
		name_dict = laureate[u'familyName']
		person_tuple = person_tuple + get_english_name(name_dict) + u', '
	else:
		person_tuple = person_tuple + "null" + u', '


	if laureate.has_key(u'gender'):
		person_tuple = person_tuple + laureate[u'gender'] + u', '
	else:
		person_tuple = person_tuple + "null" + u', '


	if laureate.has_key(u'birth'):
		birth = laureate[u'birth']
		if birth.has_key(u'date'):
			person_tuple = person_tuple + birth[u'date']  + u', '
		else:
			person_tuple = person_tuple + "null" + u', '

		if birth.has_key(u'place'):
			person_tuple = person_tuple + get_city_id(birth[u'place']) + u'\n'
		else:
			person_tuple = person_tuple + "null\n" 

	else:
		person_tuple = person_tuple + "null, null\n"  
	# print(person_tuple)
	person_table.write(str(person_tuple))

# ===============

#  scheme Ogranization(id, orgName, founded_date, city_id)
def formate_org_tuple(laureate):
	num_null = 0
	org_tuple = ""

	if laureate.has_key(u'id'):
		org_tuple += laureate[u'id'] + u', '
	else:
		return ""

	if laureate.has_key(u'orgName'):
		org_tuple += get_english_name(laureate[u'orgName']) + u', '
	else:
		org_tuple +=  u'null, '
		num_null += 1


	if laureate.has_key(u'founded'):
		# if laureate[u'founded'].has_key[u'date']:
		org_tuple +=  laureate[u'founded'][u'date'] + u', '
		org_tuple +=  get_city_id(laureate[u'founded'][u'place'])
		org_tuple +=  u'\n'
	else:
		org_tuple +=  u'null, null\n'
		num_null += 2

	if num_null == 3:
		return; 
	else:
		organization_table.write(str(org_tuple))
	# print(org_tuple)
# ===============

#  scheme NobelPrizes(Id, number, awardYear, category, sortOrder, 
# portion, dataAwarded, prizeStatus, PrizeAmount, affiliations_name, 
# affiliation_city_id)
def format_prize_tuple(laureate):
	prizes = laureate[u'nobelPrizes']
	prize_tuple = ""

	# curr_prize = prizes[1]

	j = 0 
	for curr_prize in prizes: 
		j += 1
		if laureate.has_key(u'id'):
			prize_tuple += laureate[u'id'] + u', '
		else:
			return ""

		prize_tuple += str(j) + u', '
		if curr_prize.has_key(u'awardYear'):
			prize_tuple += curr_prize[u'awardYear'] + u', '
		else:
			prize_tuple += u'null, '

		if curr_prize.has_key(u'category'):
			prize_tuple += get_english_name(curr_prize[u'category']) + u', '
		else:
			prize_tuple += u'null, '

		if curr_prize.has_key(u'sortOrder'):
			prize_tuple += curr_prize[u'sortOrder'] + u', '
		else:
			prize_tuple += u'null, '

		if curr_prize.has_key(u'portion'):
			prize_tuple += curr_prize[u'portion'] + u', '
		else:
			prize_tuple += u'null, '

		if curr_prize.has_key(u'dateAwarded'):
			prize_tuple += curr_prize[u'dateAwarded'] + u', '
		else:
			prize_tuple += u'null, '

		if curr_prize.has_key(u'prizeStatus'):
			prize_tuple += curr_prize[u'prizeStatus'] + u', '
		else:
			prize_tuple += u'null, '

		if curr_prize.has_key(u'prizeAmount'):
			prize_tuple += str(curr_prize[u'prizeAmount']) + u', '
		else:
			prize_tuple += u'null, '


		cur_tuple = prize_tuple 
		if curr_prize.has_key(u'affiliations'):
			for k in curr_prize[u'affiliations']:
				prize_tuple = cur_tuple + get_english_name(k[u'name']) + u', '
				prize_tuple += get_city_id(k) + u'\n'
		else:
			prize_tuple += u'null, null \n'
	# print (prize_tuple)
	nobel_prize_table.write(str(prize_tuple))


# Cities = [{u'city': "chengdu", u'country': "china"}, {u'city': "chengdu", u'country': "china"}]  
#schema City(City_id, name, country)
def format_city_tuple(city_array):
	for i in city_array:
		string_to_write = str(city_array.index(i)) + u', ' + i[u'city'] + u', '
		string_to_write += i[u'country'] + u'\n'
		# print(string_to_write) 
		city_table.write(string_to_write)








# #  Cities is a list of {city:  country:}, the index is its id

# Opening JSON file 
# returns JSON object as a dictionary 
nobel_json_data = json.load(nobel_json_file)

print ("first level key is: ", nobel_json_data.keys())
name = nobel_json_data.keys()[0]
all_data = nobel_json_data[name]



# first_person = all_data[0]

# format_prize_tuple(all_data[572])



for i in all_data:
	format_person_tuple(i)
	formate_org_tuple(i)
	format_prize_tuple(i)


format_city_tuple(Cities)
# ('tuple whose laureate got more than one prize: ', 267)
# ('tuple whose laureate got more than one prize: ', 395)
# ('tuple whose laureate got more than one prize: ', 462)
# ('tuple whose laureate got more than one prize: ', 549)
# ('tuple whose laureate got more than one prize: ', 572)
# ('tuple whose laureate got more than one prize: ', 641)

# j = 0
# for i in all_data:
# 	if format_prize_tuple(i) > 1:
# 		print("tuple whose laureate got more than one prize: ", j)
# 	j += 1




person_table.close()
nobel_json_file.close()









