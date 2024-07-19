<?php
// src/InvoiceItem.php

require_once __DIR__ . '/../config/database.php';

class InvoiceItem
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAll()
    {
        $stmt = $this->pdo->query('SELECT * FROM invoice_items');
        return $stmt->fetchAll();
    }

    public function get($id)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM invoice_items WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create($data)
    {
        $stmt = $this->pdo->prepare('INSERT INTO invoice_items (invoice_id, product_id, quantity, unit_price, tax_rate, line_total_ht) VALUES (?, ?, ?, ?, ?, ?)');
        return $stmt->execute([
            $data['invoice_id'],
            $data['product_id'],
            $data['quantity'],
            $data['unit_price'],
            $data['tax_rate'],
            $data['line_total_ht']
        ]);
    }

    public function update($id, $data)
    {
        $stmt = $this->pdo->prepare('UPDATE invoice_items SET invoice_id = ?, product_id = ?, quantity = ?, unit_price = ?, tax_rate = ?, line_total_ht = ? WHERE id = ?');
        return $stmt->execute([
            $data['invoice_id'],
            $data['product_id'],
            $data['quantity'],
            $data['unit_price'],
            $data['tax_rate'],
            $data['line_total_ht'],
            $id
        ]);
    }

    public function delete($id)
    {
        $stmt = $this->pdo->prepare('DELETE FROM invoice_items WHERE id = ?');
        return $stmt->execute([$id]);
    }
}
?>