<?php
// controllers/InvoiceController.php

require_once __DIR__ . '/../src/Invoice.php';

class InvoiceController
{
    private $invoice;

    public function __construct($pdo)
    {
        $this->invoice = new Invoice($pdo);
    }

    public function index()
    {
        $invoices = $this->invoice->getAll();
        return [
            'status' => 'succès',
            'data' => $invoices,
            'message' => 'Les factures ont été récupérées avec succès!'
        ];
    }

    public function show($id)
    {
        $invoice = $this->invoice->get($id);
        if ($invoice) {
            return [
                'status' => 'succès',
                'data' => $invoice,
                'message' => 'La facture a été récupérée avec succès!'
            ];
        } else {
            return [
                'status' => 'erreur',
                'message' => 'Facture non trouvée!'
            ];
        }
    }

    public function store($data)
    {
        $result = $this->invoice->create($data);
        if ($result) {
            return [
                'status' => 'succès',
                'message' => 'La facture a été créée avec succès!'
            ];
        } else {
            return [
                'status' => 'erreur',
                'message' => 'Échec de la création de la facture!'
            ];
        }
    }

    public function update($id, $data)
    {
        $result = $this->invoice->update($id, $data);
        if ($result) {
            return [
                'status' => 'succès',
                'message' => 'La facture a été mise à jour avec succès!'
            ];
        } else {
            return [
                'status' => 'erreur',
                'message' => 'Échec de la mise à jour de la facture!'
            ];
        }
    }

    public function destroy($id)
    {
        $result = $this->invoice->delete($id);
        if ($result) {
            return [
                'status' => 'succès',
                'message' => 'La facture a été supprimée avec succès!'
            ];
        } else {
            return [
                'status' => 'erreur',
                'message' => 'Échec de la suppression de la facture!'
            ];
        }
    }
}
?>
