<?php

namespace App\Controllers;

use App\Models\ProdukModel;
use CodeIgniter\Controller;

class ProdukController extends BaseController
{
    protected $produkModel;

    public function __construct()
    {
        helper(['url', 'form']);
        $this->produkModel = new ProdukModel();
    }

    public function index()
    {
        // List products with pagination, search, filter logic can be added later
        $data['products'] = $this->produkModel->findAll();
        $data['title'] = 'Product Catalog';

        return view('templates/header', $data)
            . view('product/list', $data)
            . view('templates/footer');
    }

    public function view($id = null)
    {
        $produk = $this->produkModel->find($id);

        if (!$produk) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Product not found');
        }

        $data['product'] = $produk;
        $data['title'] = $produk['name'];

        return view('templates/header', $data)
            . view('product/view', $data)
            . view('templates/footer');
    }
}

