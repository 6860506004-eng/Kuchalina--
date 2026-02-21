from flask import Flask, render_template

app = Flask(__name__)

@app.route('/')
def index():
    
    flower_test = [
        {'variety_name': 'Test Rose', 'color': 'Red', 'price': 100, 'origin': 'Thailand', 'blooming_season': 'Summer'}
    ]
    return render_template('index.html', flowers=flower_test)

if __name__ == '__main__':
   
    app.run(host='0.0.0.0', port=8000, debug=True)
