from flask import Flask

app = Flask(__name__)

@app.route('/')
def home():
    return "<h1> Nina's Server is Online! </h1> <p> ถ้าเห็นข้อความนี้ แสดงว่าพอร์ต 8000 ทำงานแล้วครับ </p>"

if __name__ == '__main__':
    
    app.run(host='0.0.0.0', port=8000)
