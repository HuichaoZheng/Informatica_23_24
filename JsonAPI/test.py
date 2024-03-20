import unittest
from products import Product

class TestProduct(unittest.TestCase):
    def setUp(self):
        self.new_product = {
            "nome": "Nuovo Prodotto",
            "prezzo": 19.99,
            "marca": "Nuova Marca"
        }
        self.new_product['id'] = Product.post(self.new_product)

    def test_post(self):
        lastrow_product = Product.find(self.new_product['id'])
        self.assertIsNotNone(lastrow_product)
        self.assertEqual(lastrow_product[0], self.new_product['id'])
        self.assertEqual(lastrow_product[1], self.new_product['nome'])
        self.assertEqual(lastrow_product[2], self.new_product['prezzo'])
        self.assertEqual(lastrow_product[3], self.new_product['marca'])

    def test_fetch_all(self):
        products = Product.fetch_all()
        self.assertIsNotNone(products)
        self.assertEqual(products[-1][0],self.new_product['id'])
        self.assertEqual(products[-1][1],self.new_product['nome'])
        self.assertEqual(products[-1][2],self.new_product['prezzo'])
        self.assertEqual(products[-1][3],self.new_product['marca'])

    def test_find(self):
        lastrow_product = Product.find(self.new_product['id'])
        self.assertIsNotNone(lastrow_product)
        self.assertEqual(lastrow_product[0], self.new_product['id'])
        self.assertEqual(lastrow_product[1], self.new_product['nome'])
        self.assertEqual(lastrow_product[2], self.new_product['prezzo'])
        self.assertEqual(lastrow_product[3], self.new_product['marca'])

    def test_update(self):
        update_data = {"nome": "Nuovo Nome Prodotto"}
        updated_product = Product.update(update_data, self.new_product['id'])
        self.assertIsNotNone(updated_product)
        self.assertEqual(updated_product[1], update_data['nome'])

    def test_delete(self):
        product = Product.find(self.new_product['id'])
        self.assertIsNotNone(product)
        product_obj = Product(product)
        product_obj.delete()
        deleted_product = Product.find(self.new_product['id'])
        self.assertIsNone(deleted_product)

if __name__ == '__main__':
    unittest.main()
