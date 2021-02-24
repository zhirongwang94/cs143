
db.laureates.aggregate([
	{$match: {"gender" : { "$exists" : false }}},
	{$project: {
				_id:0, 
				//"nobelPrizes": 1,
				awardYear: '$nobelPrizes.awardYear'
	 }
	},

	{$unwind: '$awardYear'},
	{$out: 'aggResults51'}

])

db.aggResults51.distinct("awardYear").length

