<?php

namespace App\Http\Livewire;

use App\Models\bahan_kategori;
use Livewire\Component;

class OfficeSidebar extends Component
{
    public function render()
    {
        return view('livewire.office-sidebar', [
            'kategori' => bahan_kategori::latest()->get()
        ]);
    }
}
