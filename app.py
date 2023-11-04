"""
 appy.py
 Author: Moses Noel
 Contanct: mosesnoel02@gmail.com
 Date created: 04/11/2023
Date modified: 04/11/2023

"""

from flask import Flask, request, jsonify
import pickle
import joblib

app = Flask(__name__)

# load pre-trained model
clf = joblib.load("model/comment_model.pkl")

# load pre-trained vectorizer
loaded_vectorizer = pickle.load(open('model/vectorizer.pickle','rb'))


@app.route('/')
def home():
    return "Welcome to FLask API endpoint"

@app.route('/predict', methods=['POST'])
def predict():
    try:
        if request.method == 'POST':
            pass
        data = request.get_json()
        data = str(data)
        result = clf.predict(loaded_vectorizer.transform([data])[0])

        if result == 0:
            result = 'Ham'
        else:
            result = 'Spam'

        return jsonify({'Comment result':result})    

    except Exception as e:
        return jsonify({'error': str(e)})


if __name__ == '__main__':
    app.run(debug=True)


