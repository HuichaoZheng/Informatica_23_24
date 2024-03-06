import mysql.connector

# Connessione al database MySQL
class Db:
    @staticmethod
    def connect():
        mydb = mysql.connector.connect(
            host="localhost",
            user="utente",
            password="viola",
            database="products"
        )
        return mydb