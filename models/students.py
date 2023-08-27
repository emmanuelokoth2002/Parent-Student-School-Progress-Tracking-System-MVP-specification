from flask import Blueprint, request, jsonify
from werkzeug.exceptions import BadRequest
from database import Database

students_bp = Blueprint('students', __name__)

@students_bp.route('/add_student', methods=['POST'])
def add_student():
    data = request.json
    studentid = data.get('studentid')
    firstname = data.get('firstname')
    lastname = data.get('lastname')
    birthdate = data.get('birthdate')
    classid = data.get('classid')

    if not studentid or not firstname or not lastname or not birthdate or not classid:
        raise BadRequest('All fields (studentid, firstname, lastname, birthdate, classid) are required.')
    database = Database()

    # Call stored procedure to add a student
    query = "CALL `parent-student Tracking`.`registerstudent`(%s, %s, %s, %s, %s);"
    args = (studentid, firstname, lastname, birthdate, classid)
    database.execute_query(query,args)

    return jsonify({'message': 'Student added successfully'}), 201

@students_bp.route('/get_students', methods=['GET'])
def get_students():
    # Call stored procedure to get all students
    query = "CALL `parent-student  Tracking`.`students`();"
    database = Database()
    students =database.get_data(query)

    print("Retrieved students:", students)

    student_list = [{'studentid': student['studentid'], 'firstname': student['firstname'], 'lastname': student['lastname'], 'birthdate': student['birthdate'], 'classid': student['classid']} for student in students]
    return jsonify(student_list), 200

@students_bp.route('/delete_student/<int:studentid>', methods=['POST'])
def delete_student(studentid):
    # Call stored procedure to delete a student
    query = f"CALL `parent-student  Tracking`.`deletestudent`(%s);"
    args = (studentid)
    Database.execute_query(query,args)

    return jsonify({'message': 'Student deleted successfully'}), 200
