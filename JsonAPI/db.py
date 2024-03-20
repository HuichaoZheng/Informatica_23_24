# Importazione librerie
import mysql.connector

# Connessione al database MySQL
class Db:
    @staticmethod
    def connect():
        mydb = mysql.connector.connect(
            host="192.168.2.200",
            user="zheng_huichao",
            password="pachyderms.barges.lodestars.",
            database="zheng_huichao_products"
        )
        return mydb