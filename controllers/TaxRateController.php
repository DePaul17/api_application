<?php
// controllers/TaxRateController.php

require_once __DIR__ . '/../src/TaxRate.php';

class TaxRateController
{
    private $taxRate;

    public function __construct($pdo)
    {
        $this->taxRate = new TaxRate($pdo);
    }

    public function index()
    {
        $taxRates = $this->taxRate->getAll();
        return [
            'status' => 'success',
            'data' => $taxRates,
            'message' => 'Taux de taxe récupérés avec succès!'
        ];
    }

    public function show($id)
    {
        $taxRate = $this->taxRate->get($id);
        if ($taxRate) {
            return [
                'status' => 'success',
                'data' => $taxRate,
                'message' => 'Taux de taxe récupéré avec succès!'
            ];
        } else {
            return [
                'status' => 'error',
                'message' => 'Aucune taxe trouvée!'
            ];
        }
    }

    public function store($data)
    {
        $result = $this->taxRate->create($data);
        if ($result) {
            return [
                'status' => 'success',
                'message' => 'taux de taxe créé avec succès!'
            ];
        } else {
            return [
                'status' => 'error',
                'message' => 'Échec de la création du taux de taxe!'
            ];
        }
    }

    public function update($id, $data)
    {
        $result = $this->taxRate->update($id, $data);
        if ($result) {
            return [
                'status' => 'success',
                'message' => 'Le taux d\'imposition a été mis à jour avec succès!'
            ];
        } else {
            return [
                'status' => 'error',
                'message' => 'Échec de la mise à jour du taux de taxe!'
            ];
        }
    }

    public function destroy($id)
    {
        $result = $this->taxRate->delete($id);
        if ($result) {
            return [
                'status' => 'success',
                'message' => 'Taux de taxe supprimé avec succès!'
            ];
        } else {
            return [
                'status' => 'error',
                'message' => 'Échec de la suppression du taux de taxe!'
            ];
        }
    }
}
?>
