<?php

namespace App\Models\PurchaseModule;

use App\Models\SupplierModule\Supplier;
use App\Models\UserModule\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;
    protected $fillable = ['date', 'supplier_id', 'challan_no', 'total_amount', 'created_by', 'approved_by'];

    public function purchase_details()
    {
        return $this->hasMany(PurchaseDetails::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }

    public function created_by_user()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
}
