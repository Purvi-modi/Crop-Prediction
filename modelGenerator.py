import numpy
import pandas
from keras.models import Sequential
from keras.layers import Dense
from keras.wrappers.scikit_learn import KerasClassifier
from sklearn.model_selection import cross_val_score
from sklearn.preprocessing import LabelEncoder
from sklearn.model_selection import StratifiedKFold
from sklearn.preprocessing import StandardScaler
from sklearn.pipeline import Pipeline
from keras.models import model_from_json

dataframe = pandas.read_csv("seed.csv",sep=',', header=0)

from sklearn.preprocessing import LabelEncoder
encoder = LabelEncoder()
encoder.fit(dataframe['Crop Name'])
dataframe['Crop Name'] = encoder.transform(dataframe['Crop Name'])
encoder.inverse_transform([0, 0, 1, 2])
from sklearn import preprocessing

x = dataframe.values #returns a numpy array
x=x[:,2:13]
min_max_scaler = preprocessing.MinMaxScaler()
x_scaled = min_max_scaler.fit_transform(x)
df = pandas.DataFrame(x_scaled)
dataset = dataframe.values
#dataframe.describe
# split into input (X) and output (Y) variables
X = dataset[:,2:13]

Y = dataset[:,0:1].astype(int)
model = Sequential()
model.add(Dense(10, input_dim=11, activation='relu'))
model.add(Dense(80, activation='sigmoid'))
model.add(Dense(50, activation='relu'))
model.add(Dense(1, activation='sigmoid'))
# Compile model
model.compile(loss='binary_crossentropy', optimizer='adam', metrics=['accuracy'])
# Fit the model
model.fit(X, Y, epochs=150, batch_size=10)

model_json = model.to_json()
with open("model.json", "w") as json_file:
    json_file.write(model_json)
# serialize weights to HDF5
model.save_weights("model.h5")
print("Saved model to disk")
