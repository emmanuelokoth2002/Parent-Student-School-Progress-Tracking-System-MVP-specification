import mysql.connector
import json

class Database:
    def __init__(self):
        self.dbname = "parent-student  Tracking"
        self.dbuser = "root"
        self.dbpassword = ""
        self.dbhost = "localhost"
        self.conn = None

    def connect(self):
        try:
            self.conn = mysql.connector.connect(
                host=self.dbhost,
                user=self.dbuser,
                password=self.dbpassword,
                database=self.dbname
            )
            return self.conn
        except mysql.connector.Error as e:
            print("Connection failed:", e)

    def execute_query(self, query, args=None):
        self.connect()
        cursor = self.conn.cursor()
        if args is not None:
            cursor.execute(query, args)
        else:
            cursor.execute(query)
        self.conn.commit()
        cursor.close()

    def get_data(self, query, args=None):
        self.connect()
        cursor = self.conn.cursor(dictionary=True)
        cursor.execute(query, multi=True)  # Use multi=True here
        result = []
        for result_cursor in cursor:
            result.extend(result_cursor.fetchall())
        cursor.close()
        self.conn.close()  # Close the connection after use
        return result

    def get_json(self, query):
        data = self.get_data(query)
        json_data = json.dumps(data)
        return json_data

    def close_connection(self):
        if self.conn:
            self.conn.close()
