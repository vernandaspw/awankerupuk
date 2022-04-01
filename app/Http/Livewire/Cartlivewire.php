<?php

namespace App\Http\Livewire;

use App\Models\Cart;
use App\Models\ProdukKategori;
use Livewire\Component;

class Cartlivewire extends Component
{

    public $qty = 0;

    public function render()
    {
        $auth = auth('customer')->user()->id;

        return view('livewire.cartlivewire', [
            'carts' => Cart::with('cartdetails')->where('customer_id', $auth)->first()
        ])->extends('layouts.customer')->section('content');
    }

    public function tambah()
    {
        $this->qty >= 0 ? $this->qty++ : '';
    }

    public function kurang()
    {
        $this->qty <= 1 ? '' : $this->qty--;
    }
}
