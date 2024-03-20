# Importazione librerie
from db import Db

# Classe Product
class Product:
    # Costruttore
    def __init__(self, ary):
        self.id = ary[0]
        self.nome = ary[1]
        self.marca = ary[2]
        self.prezzo = ary[3]

    # Fetch_all
    @staticmethod
    def fetch_all():
        #connessione al database
        database = Db.connect()
        mycursor = database.cursor()
        
        # Esecuzione query
        mycursor.execute("SELECT * FROM products")
        products = mycursor.fetchall()
        return products
    
    # Find
    @staticmethod
    def find(product_id):
        #connessione al database
        database = Db.connect()
        mycursor = database.cursor()
        
        # Esecuzione query
        mycursor.execute("SELECT * FROM products WHERE id = %s", (product_id,))
        product = mycursor.fetchone()
        
        return product
        
    # Post
    @staticmethod
    def post(new_product):
        # Connessione al database
        database = Db.connect()
        mycursor = database.cursor()
        
        # Preparazione query
        sql = "INSERT INTO products (nome, prezzo, marca) VALUES (%s, %s, %s)"
        val = (new_product["nome"], new_product["prezzo"], new_product["marca"])

        # Esecuzione query
        mycursor.execute(sql, val)
        database.commit() # Salva le modifiche sul db
        new_product_id = mycursor.lastrowid
        return new_product_id
    
    # Update
    @staticmethod
    def update(update_data, product_id):
        # Connessione al database
        database = Db.connect()
        mycursor = database.cursor()
        
        # Preparazione query
        sql = "UPDATE products SET "
        val = []
        for key, value in update_data.items():
            if key in ["nome", "prezzo", "marca"]:
                sql += f"{key} = %s, "
                val.append(value)

        sql = sql[:-2]
        sql += " WHERE id = %s"
        val.append(product_id)

        # Esecuzione query
        mycursor.execute(sql, val)
        database.commit()
        
        mycursor.execute("SELECT * FROM products WHERE id = %s", (product_id,))
        return mycursor.fetchone()

    # Delete
    def delete(self):
        database = Db.connect()
        mycursor = database.cursor()
        
        # Preparazione query
        sql = "DELETE FROM products WHERE id = %s"
        val = (self.id, )

        # Esecuzione query
        mycursor.execute(sql, val)
        database.commit()