<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ProdukModel;

class KeranjangController extends BaseController
{
    protected $produkModel;
    protected $session;

    public function __construct()
    {
        helper(['url', 'form']);
        $this->produkModel = new ProdukModel();
        $this->session = session();
    }

    public function index()
    {
        $cart = $this->session->get('cart') ?? [];

        $data['cartItems'] = $cart;
        $data['title'] = 'Shopping Cart';

        return view('templates/header', $data)
            . view('cart/view', $data)
            . view('templates/footer');
    }

    public function add($id)
    {
        $produk = $this->produkModel->find($id);
        if (!$produk) {
            return redirect()->to('/produk')->with('error', 'Product not found.');
        }

        $cart = $this->session->get('cart') ?? [];

        // Increase quantity if product already in cart
        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'id' => $produk['id'],
                'nama' => $produk['nama'],
                'harga' => (float)$produk['harga'],
                'quantity' => 1,
                'gambar' => $produk['gambar'],
            ];
        }

        $this->session->set('cart', $cart);

        return redirect()->back()->with('success', 'Product added to cart.');
    }

    public function update()
    {
        $post = $this->request->getPost();
        $cart = $this->session->get('cart') ?? [];

        foreach ($post['quantities'] as $id => $qty) {
            if (isset($cart[$id]) && $qty > 0) {
                $cart[$id]['quantity'] = (int)$qty;
            } elseif (isset($cart[$id])) {
                unset($cart[$id]);
            }
        }

        $this->session->set('cart', $cart);

        return redirect()->to('/cart')->with('success', 'Cart updated.');
    }

    public function remove($id)
    {
        $cart = $this->session->get('cart') ?? [];
        if (isset($cart[$id])) {
            unset($cart[$id]);
            $this->session->set('cart', $cart);
            return redirect()->to('/cart')->with('success', 'Item removed from cart.');
        }
        return redirect()->to('/cart')->with('error', 'Item not found in cart.');
    }

    public function clear()
    {
        $this->session->remove('cart');
        return redirect()->to('/cart')->with('success', 'Cart cleared.');
    }
}

