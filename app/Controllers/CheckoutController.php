<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\OrderModel;

class CheckoutController extends Controller
{
    protected $session;
    protected $orderModel;

    public function __construct()
    {
        helper(['url', 'form']);
        $this->session = session();
        $this->orderModel = new OrderModel();
    }

    public function index()
    {
        $cart = $this->session->get('cart') ?? [];

        if (empty($cart)) {
            return redirect()->to('/cart')->with('error', 'Your cart is empty.');
        }

        // For demonstration, shipping options, payment methods can be statically defined here

        $data['title'] = 'Checkout';
        $data['cart'] = $cart;

        return view('templates/header', $data)
            . view('checkout/index', $data)
            . view('templates/footer');
    }

    public function placeOrder()
    {
        $cart = $this->session->get('cart') ?? [];

        if (empty($cart)) {
            return redirect()->to('/cart')->with('error', 'Your cart is empty.');
        }

        // Basic validation for shipping and payment details can be added here

        // Simulate order creation - for real app integrate payments and order management
        $orderData = [
            'user_id' => $this->session->get('user_id') ?? null,
            'items' => json_encode($cart),
            'total' => array_reduce($cart, fn($carry, $item) => $carry + $item['price'] * $item['quantity'], 0),
            'status' => 'pending'
        ];

        $orderId = $this->orderModel->insert($orderData);

        if (!$orderId) {
            return redirect()->back()->with('error', 'Failed to place order. Please try again.');
        }

        // Clear cart after order placed
        $this->session->remove('cart');

        return redirect()->to('/')->with('success', 'Order placed successfully! Your order ID is #' . $orderId);
    }
}
