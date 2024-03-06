<?php
require_once 'Product.php';

use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    public function testFind()
    {
        // Creazione di un prodotto di test nel database
        $testProduct = Product::Create([
            'nome' => 'Test Product',
            'prezzo' => 10.99,
            'marca' => 'Test Brand'
        ]);

        // Test ricerca prodotto per ID
        $foundProduct = Product::Find($testProduct->getId());
        $this->assertEquals($testProduct->getId(), $foundProduct->getId());
        $this->assertEquals($testProduct->getNome(), $foundProduct->getNome());
        $this->assertEquals($testProduct->getPrezzo(), $foundProduct->getPrezzo());
        $this->assertEquals($testProduct->getMarca(), $foundProduct->getMarca());

        // Eliminazione del prodotto di test dal database
        $testProduct->Delete();
    }

    public function testCreate()
    {
        // Test creazione di un nuovo prodotto
        $newProduct = Product::Create([
            'nome' => 'New Product',
            'prezzo' => 20.99,
            'marca' => 'New Brand'
        ]);

        $this->assertInstanceOf(Product::class, $newProduct);
        $this->assertEquals('New Product', $newProduct->getNome());
        $this->assertEquals(20.99, $newProduct->getPrezzo());
        $this->assertEquals('New Brand', $newProduct->getMarca());

        // Eliminazione del prodotto di test dal database
        $newProduct->Delete();
    }

    public function testUpdate()
    {
        // Creazione di un prodotto di test nel database
        $testProduct = Product::Create([
            'nome' => 'Test Product',
            'prezzo' => 10.99,
            'marca' => 'Test Brand'
        ]);

        // Aggiornamento del prodotto
        $updatedProduct = $testProduct->Update([
            'nome' => 'Updated Product',
            'prezzo' => 15.99,
            'marca' => 'Updated Brand'
        ]);

        $this->assertEquals('Updated Product', $updatedProduct->getNome());
        $this->assertEquals(15.99, $updatedProduct->getPrezzo());
        $this->assertEquals('Updated Brand', $updatedProduct->getMarca());

        // Eliminazione del prodotto di test dal database
        $testProduct->Delete();
    }

    public function testFetchAll()
    {
        // Creazione di alcuni prodotti di test nel database
        Product::Create([
            'nome' => 'Product 1',
            'prezzo' => 10.99,
            'marca' => 'Brand 1'
        ]);
        Product::Create([
            'nome' => 'Product 2',
            'prezzo' => 20.99,
            'marca' => 'Brand 2'
        ]);

        // Recupero di tutti i prodotti
        $products = Product::FetchAll();

        $this->assertIsArray($products);
        $this->assertGreaterThanOrEqual(2, count($products));

        // Eliminazione dei prodotti di test dal database
        foreach ($products as $product) {
            $product->Delete();
        }
    }
}
