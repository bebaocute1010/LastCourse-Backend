<?php

namespace App\Services;

use App\Repositories\CartRepository;

class CartService
{
    private $cart_repository;

    public function __construct()
    {
        $this->cart_repository = new CartRepository();
    }

    public function create(array $data)
    {
        return $this->cart_repository->create($data);
    }

    public function update($id, $quantity)
    {
        return $this->cart_repository->update($id, $quantity);
    }
}