<?php
// src/TaxRate.php

require_once __DIR__ . '/../config/database.php';

class TaxRate
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAll()
    {
        $stmt = $this->pdo->query('SELECT * FROM tax_rates');
        return $stmt->fetchAll();
    }

    public function get($id)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM tax_rates WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create($data)
    {
        $stmt = $this->pdo->prepare('INSERT INTO tax_rates (rate, start_date, end_date) VALUES (?, ?, ?)');
        return $stmt->execute([
            $data['rate'],
            $data['start_date'],
            $data['end_date']
        ]);
    }

    public function update($id, $data)
    {
        $stmt = $this->pdo->prepare('UPDATE tax_rates SET rate = ?, start_date = ?, end_date = ? WHERE id = ?');
        return $stmt->execute([
            $data['rate'],
            $data['start_date'],
            $data['end_date'],
            $id
        ]);
    }

    public function delete($id)
    {
        $stmt = $this->pdo->prepare('DELETE FROM tax_rates WHERE id = ?');
        return $stmt->execute([$id]);
    }
}
?>