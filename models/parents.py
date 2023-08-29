from flask import Blueprint, request, jsonify
from werkzeug.exceptions import BadRequest
from database import Database

parents_bp = Blueprint('parents', __name__)

@parents_bp.route('/add_parent', methods=['POST'])
def add_parent():
    data = request.json
    parentid = data.get('parentid')
    firstname = data.get('firstname')
    lastname = data.get('lastname')
    email = data.get('email')
    phonenumber = data.get('phonenumber')

    if not parentid or not firstname or not lastname or not email or not phonenumber:
        raise BadRequest('All fields (parentid, firstname, lastname, email, phonenumber) are required.')
    
    db = Database()
    # Call stored procedure to add a parent using parameterized query
    query = "CALL `parent-student  Tracking`.`registerparent`(%s, %s, %s, %s, %s)"
    values = (parentid, firstname, lastname, email, phonenumber)
    
    db.execute_query(query, values, multi=True)

    return jsonify({'message': 'Parent added successfully'}), 201

@parents_bp.route('/get_parents', methods=['GET'])
def get_parents():
    # Call stored procedure to get all parents
    query = "CALL `parent-student  Tracking`.`parents`();"
    db = Database()

    parents = db.get_data(query)

    parent_list = [{'parentid': parent['parentid'], 'firstname': parent['firstname'], 'lastname': parent['lastname'], 'email': parent['email']} for parent in parents]
    return jsonify(parent_list), 200
