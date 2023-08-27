from flask import Flask
from users import users_bp

app = Flask(__name__)
app.config['SECRET_KEY'] = 'your_secret_key'
app.register_blueprint(users_bp)

if __name__ == '__main__':
    app.run(debug=True)

