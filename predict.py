from keras.models import Sequential
from keras.layers import Dense
from keras.models import model_from_json
import numpy
import os
from numpy import array
# load json and create model
json_file = open('model.json', 'r')
loaded_model_json = json_file.read()
json_file.close()
loaded_model = model_from_json(loaded_model_json)
# load weights into new model
loaded_model.load_weights("model.h5")
import sys

loaded_model.compile(loss='binary_crossentropy', optimizer='adam', metrics=['accuracy'])



#Xnew = numpy.array([[6.8,1.61,194,86,232,53,2.3,71,0.34,0.15,26]])
Xnew = numpy.array([[float(sys.argv[1]),float(sys.argv[2]),float(sys.argv[3]),float(sys.argv[4])
,float(sys.argv[5]),float(sys.argv[6]),float(sys.argv[7]),float(sys.argv[8]),float(sys.argv[9]),float(sys.argv[10]),
float(sys.argv[11])]])

ynew = loaded_model.predict_classes(Xnew)

import pandas
from sklearn.preprocessing import LabelEncoder
dataframe = pandas.read_csv("seed.csv",sep=',', header=0)

from sklearn.preprocessing import LabelEncoder
encoder = LabelEncoder()
encoder.fit(dataframe['Crop Name'])
dataframe['Crop Name'] = encoder.transform(dataframe['Crop Name'])
A=encoder.inverse_transform([ynew[0][0]])
print(A[0])
