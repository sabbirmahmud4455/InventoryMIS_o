<?php

namespace App\Models\SystemDataModule;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemVarient extends Model
{
    use HasFactory;

    public function item() {
        return $this->belongsTo(Item::class);
    }

    public function varient() {
        return $this->belongsTo(Varient::class);
    }

}
