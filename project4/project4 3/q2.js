


db.laureates.aggregate(
	{$match: {'nobelPrizes.affiliations.name.en': 'CERN'}},
	{$project : { 
		_id : 0, 
		country: {$arrayElemAt: 
				     [ {$arrayElemAt: ['$nobelPrizes.affiliations.country.en', 0]}, 0] }
		}
	},
	{ $limit : 1 }
)


