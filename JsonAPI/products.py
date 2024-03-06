# Importazione librerie
import json
import mysql.connector
from db import Db

class Product:
    def __init__(self, ary):
        self.id = ary[0]
        self.nome = ary[1]
        self.marca = ary[2]
        self.prezzo = ary[3]

    @staticmethod
    def fetch_all():
        
        database = Db.connect()
        mycursor = database.cursor()
        
        mycursor.execute("SELECT * FROM products")
        products = mycursor.fetchall()
        return products
    
    @staticmethod
    def find(product_id):
        #connessione al database
        database = Db.connect()
        mycursor = database.cursor()
        
        mycursor.execute("SELECT * FROM products WHERE id = %s", (product_id,))
        product = mycursor.fetchone()
        
        return product
        
    @staticmethod
    def post(new_product):
        # Connessione al database
        database = Db.connect()
        mycursor = database.cursor()
        
        sql = "INSERT INTO products (nome, prezzo, marca) VALUES (%s, %s, %s)"
        val = (new_product["nome"], new_product["prezzo"], new_product["marca"])
        mycursor.execute(sql, val)
        database.commit() # Salva le modifiche sul db
        new_product_id = mycursor.lastrowid
        return new_product_id
    
    @staticmethod
    def update(update_data, product_id):
        # Connessione al database
        database = Db.connect()
        mycursor = database.cursor()
        
        sql = "UPDATE products SET "
        val = []
        for key, value in update_data.items():
            if key in ["nome", "prezzo", "marca"]:
                sql += f"{key} = %s, "
                val.append(value)

        sql = sql[:-2]
        sql += " WHERE id = %s"
        val.append(product_id)

        mycursor.execute(sql, val)
        database.commit()

        mycursor.execute("SELECT * FROM products WHERE id = %s", (product_id,))
        return mycursor.fetchone()

    def delete(self):
        database = Db.connect()
        mycursor = database.cursor()
        
        sql = "DELETE FROM products WHERE id = %s"
        val = (self.id, )
        mycursor.execute(sql, val)
        database.commit()