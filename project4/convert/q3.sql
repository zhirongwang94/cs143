db.laureates.aggregate([
	{$match: {'familyName.en':{ "$ne": null } } }, 

	{$sortByCount: '$familyName.en'},

	{$project: {_id: 0, familyName: '$_id'}
	},

	{$limit: 2}	 

])