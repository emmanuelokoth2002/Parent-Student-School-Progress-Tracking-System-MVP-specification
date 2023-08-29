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

    def execute_query(self, query, args=None, multi=False):
        self.connect()
        cursor = self.conn.cursor()
        try:
            if multi:
                cursor.execute("SET SESSION sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''))")
        
            if args is not None:
                cursor.execute(query, args, multi=multi)
            else:
                cursor.execute(query,multi=multi)

            if multi:
                result = []
                for result_cursor in cursor.stored_results():
                    result.extend(result_cursor.fetchall())
                return result
            else:
                self.conn.commit()  # Commit the transaction
        except Exception as e:
            print("Error executing query:", str(e))
            self.conn.rollback()  # Rollback the transaction in case of an error
        finally:
            cursor.close()


    def get_data(self, query, args=None, multi=False):
        self.connect()
        cursor = self.conn.cursor(dictionary=True, buffered=True)
        
        if multi:
            # Enable multi statements
            cursor.execute("SET SESSION sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''))")

        cursor.execute(query, multi=True)
        
        if multi:
            result = []
            for result_cursor in cursor.stored_results():
                result.extend(result_cursor.fetchall())
        else:
            result = cursor.fetchall()

        cursor.close()
        self.conn.close()
        return result

    def get_json(self, query):
        data = self.get_data(query)
        json_data = json.dumps(data)
        return json_data

    def close_connection(self):
        if self.conn:
            self.conn.close()
