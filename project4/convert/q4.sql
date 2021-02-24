
db.laureates.aggregate([{
    $match: {
            'nobelPrizes':{
                            $elemMatch: {'affiliations.name.en': "University of California" 
                            }
            }
    }},

    {$out: 'aggResults4'}
])

db.aggResults4.aggregate([
    {$project: {
                _id:0, 
                id: 1, 
                city: '$nobelPrizes.affiliations'
    }},
    {$out: 'aggResults42'}

])


db.aggResults42.aggregate([
    {$project: {
                _id:0, 
                city: {$arrayElemAt: ['$city', 0]}
    }},
    {$out: 'aggResults43'}
])

db.aggResults43.aggregate([
    {$unwind: '$city'},
    {$match: {'city.name.en': 'University of California'}},
    {$project: {
                _id:0, 
                city: '$city.city.en'
    }},
    {$out: 'aggResults44'}
])


db.aggResults44.distinct("city").length


