import sys
import json
import pandas as pd
import numpy as np

# pd.test()

tm = sys.argv[1]
# data = json.loads(x)

# Create a data frame from historical data csv file
file = pd.read_csv(r'/vagrant/Projects/footstat/ext/historical_football_data_filtered.csv', encoding = 'ISO-8859-1')
# print (res.head(10))


# All results for team
# results = file[
#     (file['HomeTeam'] == @tm)
#     | (file['AwayTeam'] == @tm)
# ]

results = file.query('HomeTeam==@tm | AwayTeam==@tm')

data = results[['Date', 'HomeTeam', 'AwayTeam', 'FinalHome', 'FinalAway']].head(20)

print (data.to_json())
# print (data)
