import mysql.connector
import json

class Database:
    def __init__(self):
        self.dbname = "contacts"
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

    def get_data(self, query):
        self.connect()
        cursor = self.conn.cursor(dictionary=True)
        cursor.execute(query)
        result = cursor.fetchall()
        cursor.close()
        return result

    def get_json(self, query):
        data = self.get_data(query)
        json_data = json.dumps(data)
        return json_data

    def close_connection(self):
        if self.conn:
            self.conn.close()
