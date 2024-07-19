<?php
// controllers/ClientController.php

require_once __DIR__ . '/../src/Client.php';

class ClientController
{
    private $client;

    public function __construct($pdo)
    {
        $this->client = new Client($pdo);
    }

    public function index()
    {
        $clients = $this->client->getAll();
        return [
            'status' => 'success',
            'data' => $clients,
            'message' => 'Clients récupérés avec succès!'
        ];
    }

    public function show($id)
    {
        $client = $this->client->get($id);
        if ($client) {
            return [
                'status' => 'success',
                'data' => $client,
                'message' => 'Client récupéré avec succès!'
            ];
        } else {
            return [
                'status' => 'error',
                'message' => 'Aucun client trouvé!'
            ];
        }
    }

    public function store($data)
    {
        $result = $this->client->create($data);
        if ($result) {
            return [
                'status' => 'success',
                'message' => 'Client créé avec succès!'
            ];
        } else {
            return [
                'status' => 'error',
                'message' => 'Échec de la création du client!'
            ];
        }
    }

    public function update($id, $data)
    {
        $result = $this->client->update($id, $data);
        if ($result) {
            return [
                'status' => 'success',
                'message' => 'Client modifié avec succès!'
            ];
        } else {
            return [
                'status' => 'error',
                'message' => 'Échec de la mise à jour du client!'
            ];
        }
    }

    public function destroy($id)
    {
        $result = $this->client->delete($id);
        if ($result) {
            return [
                'status' => 'success',
                'message' => 'Client supprimé avec succès!'
            ];
        } else {
            return [
                'status' => 'error',
                'message' => 'Échec de la suppression du client!'
            ];
        }
    }
}
?>