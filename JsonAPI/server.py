# Importazione librerie
import json
from http.server import BaseHTTPRequestHandler, HTTPServer
<<<<<<< HEAD
from db import Db
from products import Product

# Connessione al database MySQL
database = Db.connect()
mycursor = database.cursor()

=======
import mysql.connector

# Connessione al database MySQL
mydb = mysql.connector.connect(
    host="localhost",
    user="utente",
    password="viola",
    database="products"
)
mycursor = mydb.cursor()
>>>>>>> aede8a1ca6da28e47f3447f3d756ef05df3bdde8
class RequestHandler(BaseHTTPRequestHandler):
    # GET
    def do_GET(self):
        # GET di tutti prodotti
        if self.path == '/products':
<<<<<<< HEAD
            products = Product.fetch_all()
=======
            mycursor.execute("SELECT * FROM products")
            products = mycursor.fetchall()
>>>>>>> aede8a1ca6da28e47f3447f3d756ef05df3bdde8
            data = [{"type": "products", "id": str(product[0]), "attributes": {"nome": product[1], "prezzo": product[2], "marca": str(product[3])}} for product in products]
            self.send_response(200)
            self.send_header('Content-type', 'application/vnd.api+json')
            self.send_header('Location', f'http://{self.server.server_address[0]}:{self.server.server_address[1]}/products')
            self.end_headers()
            self.wfile.write(json.dumps({"data": data}).encode())
        # GET di un singolo prodotto
        elif self.path.startswith('/products/'):
            product_id = self.path.split('/')[-1]
<<<<<<< HEAD
            product = Product.find_by_id(product_id)
=======
            mycursor.execute("SELECT * FROM products WHERE id = %s", (product_id,))
            product = mycursor.fetchone()
>>>>>>> aede8a1ca6da28e47f3447f3d756ef05df3bdde8
            # Se si trova il prodotto
            if product:
                data = {"type": "products", "id": str(product[0]), "attributes": {"nome": product[1], "prezzo": product[2], "marca": str(product[3])}}
                self.send_response(200)
                self.send_header('Content-type', 'application/vnd.api+json')
                self.send_header('Location', f'http://{self.server.server_address[0]}:{self.server.server_address[1]}/products/{product[0]}')
                self.end_headers()
                self.wfile.write(json.dumps({"data": data}).encode())
            # Altrimenti
            else:
                self.send_response(404)
                self.end_headers()
                self.wfile.write(json.dumps({"message": "Prodotto non trovato"}).encode())
        # Endpoint errato
        else:
            self.send_response(404)
            self.end_headers()
            self.wfile.write(json.dumps({"message": "Endpoint non valido"}).encode())

    # POST
    def do_POST(self):
    # Controllo endpoint
        if self.path == '/products':
            content_length = int(self.headers['Content-Length'])
            post_data = self.rfile.read(content_length)
            new_product = json.loads(post_data)['data']['attributes']
<<<<<<< HEAD
            new_product_id = Product.insert_product(new_product)
=======
            sql = "INSERT INTO products (nome, prezzo, marca) VALUES (%s, %s, %s)"
            val = (new_product["nome"], new_product["prezzo"], new_product["marca"])
            mycursor.execute(sql, val)
            mydb.commit() # Salva le modifiche sul db
            new_product_id = mycursor.lastrowid
>>>>>>> aede8a1ca6da28e47f3447f3d756ef05df3bdde8
            data = {"type": "products", "id": str(new_product_id), "attributes": new_product}
            self.send_response(201)
            self.send_header('Content-type', 'application/vnd.api+json')
            self.send_header('Location', f'http://{self.server.server_address[0]}:{self.server.server_address[1]}/products/{new_product_id}')
            self.end_headers()
            self.wfile.write(json.dumps({"data": data}).encode())
        # Endpoint errato
        else:
            self.send_response(404)
            self.end_headers()
            self.wfile.write(json.dumps({"message": "Endpoint non valido"}).encode())

    # PATCH
    def do_PATCH(self):
        if self.path.startswith('/products/'):
            product_id = self.path.split('/')[-1]
            content_length = int(self.headers['Content-Length'])
            patch_data = self.rfile.read(content_length)
            update_data = json.loads(patch_data)['data']['attributes']

<<<<<<< HEAD
            
            updated_product = Product.update(update_data, product_id)
=======
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
            mydb.commit()

            mycursor.execute("SELECT * FROM products WHERE id = %s", (product_id,))
            updated_product = mycursor.fetchone()
>>>>>>> aede8a1ca6da28e47f3447f3d756ef05df3bdde8

            data = {"type": "products", "id": str(product_id), "attributes": {"nome": updated_product[1], "prezzo": updated_product[2], "marca": str(updated_product[3])}}
            self.send_response(200)
            self.send_header('Content-type', 'application/vnd.api+json')
            self.send_header('Location', f'http://{self.server.server_address[0]}:{self.server.server_address[1]}/products/{product_id}')
            self.end_headers()
            self.wfile.write(json.dumps({"data": data}).encode())
        else:
            self.send_response(404)
            self.end_headers()
            self.wfile.write(json.dumps({"message": "Endpoint non valido"}).encode())

    # DELETE
    def do_DELETE(self):
        if self.path.startswith('/products/'):
            product_id = self.path.split('/')[-1]
<<<<<<< HEAD
            
            existing_product = Product.find_by_id(product_id)
            # Controlla se il prodotto esiste prima di eliminarlo
            if existing_product:
                product = Product(existing_product)
                product.delete()
=======
            mycursor.execute("SELECT * FROM products WHERE id = %s", (product_id,))
            existing_product = mycursor.fetchone()
            # Controlla se il prodotto esiste prima di eliminarlo
            if existing_product:
                sql = "DELETE FROM products WHERE id = %s"
                val = (product_id,)
                mycursor.execute(sql, val)
                mydb.commit()
>>>>>>> aede8a1ca6da28e47f3447f3d756ef05df3bdde8
                self.send_response(204)
                self.end_headers()
            else:
                self.send_response(404)
                self.end_headers()
                self.wfile.write(json.dumps({"message": "Prodotto non trovato"}).encode())
        else:
            self.send_response(404)
            self.end_headers()
            self.wfile.write(json.dumps({"message": "Endpoint non valido"}).encode())

def run():
<<<<<<< HEAD
    server_address = ('', 8888)
=======
    server_address = ('25.58.216.225', 8888)
>>>>>>> aede8a1ca6da28e47f3447f3d756ef05df3bdde8
    httpd = HTTPServer(server_address, RequestHandler)
    print('Server in esecuzione...')
    httpd.serve_forever()

if __name__ == '__main__':
    run()
