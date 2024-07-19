<?php
// controllers/InvoiceItemController.php

require_once __DIR__ . '/../src/InvoiceItem.php';

class InvoiceItemController
{
    private $invoiceItem;

    public function __construct($pdo)
    {
        $this->invoiceItem = new InvoiceItem($pdo);
    }

    public function index()
    {
        $invoiceItems = $this->invoiceItem->getAll();
        return [
            'status' => 'success',
            'data' => $invoiceItems,
            'message' => 'Les éléments de facture ont été récupérés avec succès!'
        ];
    }

    public function show($id)
    {
        $invoiceItem = $this->invoiceItem->get($id);
        if ($invoiceItem) {
            return [
                'status' => 'success',
                'data' => $invoiceItem,
                'message' => 'L\'élément de facture a été récupéré avec succès!'
            ];
        } else {
            return [
                'status' => 'erreur',
                'message' => 'Élément de facture non trouvé!'
            ];
        }
    }

    public function store($data)
    {
        $result = $this->invoiceItem->create($data);
        if ($result) {
            return [
                'status' => 'success',
                'message' => 'L\'élément de facture a été créé avec succès!'
            ];
        } else {
            return [
                'status' => 'erreur',
                'message' => 'Échec de la création de l\'élément de facture!'
            ];
        }
    }

    public function update($id, $data)
    {
        $result = $this->invoiceItem->update($id, $data);
        if ($result) {
            return [
                'status' => 'success',
                'message' => 'L\'élément de facture a été mis à jour avec succès!'
            ];
        } else {
            return [
                'status' => 'erreur',
                'message' => 'Échec de la mise à jour de l\'élément de facture!'
            ];
        }
    }

    public function destroy($id)
    {
        $result = $this->invoiceItem->delete($id);
        if ($result) {
            return [
                'status' => 'success',
                'message' => 'L\'élément de facture a été supprimé avec succès!'
            ];
        } else {
            return [
                'status' => 'erreur',
                'message' => 'Échec de la suppression de l\'élément de facture!'
            ];
        }
    }
}
?>
