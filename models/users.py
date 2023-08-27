from flask import Blueprint, request, jsonify
from werkzeug.security import generate_password_hash, check_password_hash
from database import Database

users_bp = Blueprint('users', __name__)
db = Database()

@users_bp.route('/')
def index():
    return "Hello, World!"

@users_bp.route('/register', methods=['POST'])
def register_user():
    data = request.json
    username = data['username']
    password = data['password']
    role = data['role']

    # Check if the username already exists
    query = f"SELECT * FROM users WHERE username = '{username}'"
    existing_user = db.get_data(query)
    if existing_user:
        return jsonify({'message': 'Username already exists'}), 400

    # Insert the new user into the database
    password_hash = generate_password_hash(password)
    insert_query = f"INSERT INTO users (username, password_hash, role) VALUES ('{username}', '{password_hash}', '{role}')"
    db.connect()
    db.execute_query(insert_query)
    db.close_connection()

    return jsonify({'message': 'User registered successfully'}), 201

@users_bp.route('/login', methods=['POST'])
def login():
    data = request.json
    username = data['username']
    password = data['password']

    # Retrieve the user from the database
    query = f"SELECT * FROM users WHERE username = '{username}'"
    user = db.get_data(query)
    if not user or not check_password_hash(user[0]['password_hash'], password):
        return jsonify({'message': 'Invalid credentials'}), 401

    return jsonify({'message': 'Login successful'}), 200
