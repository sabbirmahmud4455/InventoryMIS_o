<?php

namespace App\Models\SystemDataModule;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemVariant extends Model
{
    use HasFactory;

    public function item() {
        return $this->belongsTo(Item::class);
    }

    public function variant() {
        return $this->belongsTo(Variant::class);
    }

}
