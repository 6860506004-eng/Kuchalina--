from flask import Flask, render_template
import pymysql

app = Flask(__name__)


db_config = {
    'host': 's6860506004db-kuchalina-hwzz2w', 
    'user': 'Nina6860506004',                 
    'password': '1859900347014',              
    'database': 'Nina',                       
    'cursorclass': pymysql.cursors.DictCursor
}

@app.route('/')
def index():
    try:
        connection = pymysql.connect(**db_config)
        with connection.cursor() as cursor:
            
            cursor.execute("SELECT * FROM Flower")
            flower_list = cursor.fetchall()
        connection.close()
        return render_template('index.html', flowers=flower_list)
    except Exception as e:
        return f"<h1>เกิดข้อผิดพลาดในการเชื่อมต่อฐานข้อมูล:</h1><p>{str(e)}</p>"

if __name__ == '__main__':
   
    app.run(host='0.0.0.0', port=8000)
