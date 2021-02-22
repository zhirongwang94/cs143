
import json 
import sys
from importlib import reload
# sys.setdefaultencoding() does not exist, here!
reload(sys)  # Reload does the trick!
# sys.setdefaultencoding('UTF8')

# for reading data
nobel_json_file = open('/home/cs143/data/nobel-laureates.json')

# for writing data
city_table = open("city.del", "w") 
person_table = open("person.del", "w") 
organization_table = open("organization.del", "w") 
nobel_prize_table = open("nobel_prize.del", "w") 

# array of dictinary {u'city': ".. ", u'country': ".. "}
Cities = []  

def get_city_id(place):
	city_dict = {u'city': ".", u'country': "."}

	if u'city' in place:
		city_dict[u'city'] = place[u'city'][u'en']
		if u'country' in place:
			city_dict[u'country'] = place[u'country'][u'en']
	
	# print ("city dictL: ", city_dict)
	if city_dict not in Cities:
		Cities.append(city_dict)


	return str(Cities.index(city_dict))


def get_english_name(name_dict):
	if u'en' in name_dict:
		return name_dict[u'en']
	else:
		return 'null'

def format_person_tuple(laureate):
	# keys_to_lookup = [u'id', u'givenName', u'familyName', u'gender', u'birth']

	num_null = 0;
	person_tuple = ""

	# u'|'  ====== ", "
	if u'id' in laureate:
		person_tuple = person_tuple + laureate[u'id'] + u'|'
	else:
		return
	# no need to discuss, keep line 47 only

	if u'givenName' in laureate:
		name_dict = laureate[u'givenName']
		person_tuple = person_tuple + get_english_name(name_dict) + u'|'
		# person_tuple = person_tuple + laureate[u'givenName'][u'en'] + u'|'
		# can use this
	else:
		person_tuple = person_tuple + "null" + u'|'
		num_null += 1


	if u'familyName' in laureate:
		name_dict = laureate[u'familyName']
		person_tuple = person_tuple + get_english_name(name_dict) + u'|'
	else:
		person_tuple = person_tuple + "null" + u'|'
		num_null += 1


	if u'gender' in laureate:
		person_tuple = person_tuple + laureate[u'gender'] + u'|'
	else:
		person_tuple = person_tuple + "null" + u'|'
		num_null += 1


	if u'birth' in laureate:
		birth = laureate[u'birth']
		if u'date' in birth:
			person_tuple = person_tuple + birth[u'date']  + u'|'
		else:
			person_tuple = person_tuple + "null" + u'|'

		if u'place' in birth:
			person_tuple = person_tuple + get_city_id(birth[u'place']) + u'\n'
		else:
			person_tuple = person_tuple + "null\n" 

	else:
		person_tuple = person_tuple + "null|null\n"  
		num_null += 2

	# person_tuple = "745, A. Michael, Spence, male, 1943-00-00, 0"	
	# all code above is to format this string

	# print(person_tuple)
	if num_null > 4:
		return
	else:
		person_table.write(str(person_tuple))

# ===============

#  scheme Ogranization(id, orgName, founded_date, city_id)
def formate_org_tuple(laureate):
	num_null = 0
	org_tuple = ""

	if u'id' in laureate:
		org_tuple += laureate[u'id'] + u'|'
	else:
		return ""

	if u'orgName' in laureate:
		org_tuple += get_english_name(laureate[u'orgName']) + u'|'
	else:
		org_tuple +=  u'null|'
		num_null += 1


	if u'founded' in laureate:
		# if laureate[u'founded'].has_key[u'date']:
		org_tuple +=  laureate[u'founded'][u'date'] + u'|'
		org_tuple +=  get_city_id(laureate[u'founded'][u'place'])
		org_tuple +=  u'\n'
	else:
		org_tuple +=  u'null|null\n'
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

# 745, 1, 2001, Economic Sciences, 2, 1/3, 2001-10-10, received, 10000000, Stanford University, 1
def format_prize_tuple(laureate):
	prizes = laureate[u'nobelPrizes']
	prize_tuple = ""

	# curr_prize = prizes[1]

	# number dijici huojiang
	number = 0 
	for curr_prize in prizes: 
		number += 1
		if u'id' in laureate:
			prize_tuple += laureate[u'id'] + u'|'
		else:
			return ""

		prize_tuple += str(number) + u'|'
		if u'awardYear' in curr_prize:
			prize_tuple += curr_prize[u'awardYear'] + u'|'
		else:
			prize_tuple += u'null|'

		if u'category' in curr_prize:
			prize_tuple += get_english_name(curr_prize[u'category']) + u'|'
		else:
			prize_tuple += u'null|'

		if u'sortOrder' in curr_prize:
			prize_tuple += curr_prize[u'sortOrder'] + u'|'
		else:
			prize_tuple += u'null|'

		if u'portion' in curr_prize:
			prize_tuple += curr_prize[u'portion'] + u'|'
		else:
			prize_tuple += u'null|'

		if u'dateAwarded' in curr_prize:
			prize_tuple += curr_prize[u'dateAwarded'] + u'|'
		else:
			prize_tuple += u'null|'

		if u'prizeStatus' in curr_prize:
			prize_tuple += curr_prize[u'prizeStatus'] + u'|'
		else:
			prize_tuple += u'null|'

		if u'prizeAmount' in curr_prize:
			prize_tuple += str(curr_prize[u'prizeAmount']) + u'|'
		else:
			prize_tuple += u'null|'


		cur_tuple = prize_tuple 
		if u'affiliations' in curr_prize:
			for k in curr_prize[u'affiliations']:
				prize_tuple = cur_tuple + get_english_name(k[u'name']) + u'|'
				prize_tuple += get_city_id(k) + u'\n'
		else:
			prize_tuple += u'null|null \n'
	# print (prize_tuple)
	nobel_prize_table.write(str(prize_tuple))


# Cities = [{u'city': "chengdu", u'country': "china"}, {u'city': "chengdu", u'country': "china"}]  
#schema City(City_id, name, country)
def format_city_tuple(city_array):
	for i in city_array:
		string_to_write = str(city_array.index(i)) + u'| ' +i[u'city'] + u'| '
		string_to_write +=  i[u'country'] + u'\n'
		# print(string_to_write) 
		city_table.write(string_to_write)


# Opening JSON file 
# returns JSON object as a dictionary 
nobel_json_data = json.load(nobel_json_file)

# print ("first level key is: ", nobel_json_data.keys())
# name = nobel_json_data.keys()[0]
# all_laureates = nobel_json_data[name]

all_laureates = nobel_json_data[u'laureates']



# format_person_tuple(all_laureates[0])
# format_prize_tuple(all_laureates[395])
# format_prize_tuple(all_laureates[462])
# format_prize_tuple(all_laureates[549])
# format_prize_tuple(all_laureates[572])
# format_prize_tuple(all_laureates[641])
#  482, 66, 217, 6, 515

for laureate in all_laureates:
	format_person_tuple(laureate)
	formate_org_tuple(laureate)
	format_prize_tuple(laureate)


format_city_tuple(Cities)
# ('tuple whose laureate got more than one prize: ', 267)
# ('tuple whose laureate got more than one prize: ', 395)
# ('tuple whose laureate got more than one prize: ', 462)
# ('tuple whose laureate got more than one prize: ', 549)
# ('tuple whose laureate got more than one prize: ', 572)
# ('tuple whose laureate got more than one prize: ', 641)



person_table.close()
nobel_json_file.close()










