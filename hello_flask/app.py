from flask import Flask
app = Flask("Faith")

@app.route("/")
def home():
    return "Hello, Flask!"