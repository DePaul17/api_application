<?php
// src/Invoice.php

require_once __DIR__ . '/../config/database.php';

class Invoice
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAll()
    {
        $stmt = $this->pdo->query('SELECT * FROM invoices');
        return $stmt->fetchAll();
    }

    public function get($id)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM invoices WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create($data)
    {
        $stmt = $this->pdo->prepare('INSERT INTO invoices (client_id, invoice_date, total_ht, total_ttc) VALUES (?, ?, ?, ?)');
        return $stmt->execute([
            $data['client_id'],
            $data['invoice_date'],
            $data['total_ht'],
            $data['total_ttc']
        ]);
    }

    public function update($id, $data)
    {
        $stmt = $this->pdo->prepare('UPDATE invoices SET client_id = ?, invoice_date = ?, total_ht = ?, total_ttc = ? WHERE id = ?');
        return $stmt->execute([
            $data['client_id'],
            $data['invoice_date'],
            $data['total_ht'],
            $data['total_ttc'],
            $id
        ]);
    }

    public function delete($id)
    {
        $stmt = $this->pdo->prepare('DELETE FROM invoices WHERE id = ?');
        return $stmt->execute([$id]);
    }
}
?>