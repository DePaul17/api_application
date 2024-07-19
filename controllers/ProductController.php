<?php
// controllers/ProductController.php

require_once __DIR__ . '/../src/Product.php';

class ProductController
{
    private $product;

    public function __construct($pdo)
    {
        $this->product = new Product($pdo);
    }

    public function index()
    {
        $products = $this->product->getAll();
        return [
            'status' => 'success',
            'data' => $products,
            'message' => 'Products retrieved successfully'
        ];
    }

    public function show($id)
    {
        $product = $this->product->get($id);
        if ($product) {
            return [
                'status' => 'success',
                'data' => $product,
                'message' => 'Product retrieved successfully'
            ];
        } else {
            return [
                'status' => 'error',
                'message' => 'Product not found'
            ];
        }
    }

    public function store($data)
    {
        $result = $this->product->create($data);
        if ($result) {
            return [
                'status' => 'success',
                'message' => 'Product created successfully'
            ];
        } else {
            return [
                'status' => 'error',
                'message' => 'Failed to create product'
            ];
        }
    }

    public function update($id, $data)
    {
        $result = $this->product->update($id, $data);
        if ($result) {
            return [
                'status' => 'success',
                'message' => 'Product updated successfully'
            ];
        } else {
            return [
                'status' => 'error',
                'message' => 'Failed to update product'
            ];
        }
    }

    public function destroy($id)
    {
        $result = $this->product->delete($id);
        if ($result) {
            return [
                'status' => 'success',
                'message' => 'Product deleted successfully'
            ];
        } else {
            return [
                'status' => 'error',
                'message' => 'Failed to delete product'
            ];
        }
    }
}
?>