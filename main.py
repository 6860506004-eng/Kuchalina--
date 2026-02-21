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
            flowers = cursor.fetchall()
        connection.close()
       
        html = "<h1>Database Connected!</h1><table border='1'>"
        for f in flowers:
            html += f"<tr><td>{f['variety_name']}</td><td>{f['price']}</td></tr>"
        html += "</table>"
        return html
    except Exception as e:
        return f"Error: {str(e)}"

if __name__ == '__main__':
    app.run(host='0.0.0.0', port=3000)
