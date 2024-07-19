<?php
// src/Product.php

require_once __DIR__ . '/../config/database.php';

class Product
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAll()
    {
        $stmt = $this->pdo->query('SELECT * FROM products');
        return $stmt->fetchAll();
    }

    public function get($id)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM products WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create($data)
    {
        $stmt = $this->pdo->prepare('INSERT INTO products (name, description, price) VALUES (?, ?, ?)');
        return $stmt->execute([
            $data['name'],
            $data['description'],
            $data['price']
        ]);
    }

    public function update($id, $data)
    {
        $stmt = $this->pdo->prepare('UPDATE products SET name = ?, description = ?, price = ? WHERE id = ?');
        return $stmt->execute([
            $data['name'],
            $data['description'],
            $data['price'],
            $id
        ]);
    }

    public function delete($id)
    {
        $stmt = $this->pdo->prepare('DELETE FROM products WHERE id = ?');
        return $stmt->execute([$id]);
    }
}
?>