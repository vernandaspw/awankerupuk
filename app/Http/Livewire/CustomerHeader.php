<?php

namespace App\Http\Livewire;

use App\Models\Cart;
use App\Models\CartDetail;
use App\Models\ProdukKategori;
use Livewire\Component;

class CustomerHeader extends Component
{
    public function render()
    {
        return view('livewire.customer-header', [
            'kategoris' => ProdukKategori::get(),
            'cartcount' => auth('customer')->user() != null ? CartDetail::where('customer_id', auth('customer')->user()->id)->count() : '0'
        ]);
    }
}
