<?php
// src/Client.php

require_once __DIR__ . '/../config/database.php';

class Client
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAll()
    {
        $stmt = $this->pdo->query('SELECT * FROM clients');
        return $stmt->fetchAll();
    }

    public function get($id)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM clients WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create($data)
    {
        $stmt = $this->pdo->prepare('INSERT INTO clients (name, address, postal_code, city, phone, email) VALUES (?, ?, ?, ?, ?, ?)');
        return $stmt->execute([
            $data['name'],
            $data['address'],
            $data['postal_code'],
            $data['city'],
            $data['phone'],
            $data['email']
        ]);
    }

    public function update($id, $data)
    {
        $stmt = $this->pdo->prepare('UPDATE clients SET name = ?, address = ?, postal_code = ?, city = ?, phone = ?, email = ? WHERE id = ?');
        return $stmt->execute([
            $data['name'],
            $data['address'],
            $data['postal_code'],
            $data['city'],
            $data['phone'],
            $data['email'],
            $id
        ]);
    }

    public function delete($id)
    {
        $stmt = $this->pdo->prepare('DELETE FROM clients WHERE id = ?');
        return $stmt->execute([$id]);
    }
}
?>
