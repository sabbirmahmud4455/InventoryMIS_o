<?php

namespace App\Models\SystemDataModule;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    public function item_type() {
        return $this->belongsTo(ItemType::class);
    }

}
