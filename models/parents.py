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
    try:
        # Create a database connection
        db = Database()

        # Call stored procedure to get all parents
        query = "CALL `parent-student  Tracking`.`parents`();"

        parents = db.get_data(query, multi=True)

        print("Retrieved parents:", parents)

        # Create a list of dictionaries containing parent information
        parent_list = []
        for parent in parents:
            parent_info = {
                'parentid': parent['parentid'],
                'firstname': parent['firstname'],
                'lastname': parent['lastname'],
                'email': parent['email'],
                'phonenumber': parent['phonenumber'],
                'createdat': parent['createdat'],
                'updatedat': parent['updatedat']
            }
            parent_list.append(parent_info)

        # Return the list of parent information as JSON response
        return jsonify(parent_list), 200

    except Exception as e:
        print("Error:", e)
        return jsonify({'error': 'An error occurred'}), 500

    except mysql.connector.Error as e:
        print("MySQL error:", e)
        return jsonify({'error': 'A MySQL error occurred'}), 500

@parents_bp.route('/delete_parent/<int:parentid>', methods=['POST'])
def delete_parent(parentid):
    # Call stored procedure to delete a parent
    query = f"CALL `parent-student  Tracking`.`deleteparent`(%s);"
    args = (parentid,)
    db = Database()
    db.execute_query(query,args)

    return jsonify({'message': 'Parent deleted successfully'}), 200
