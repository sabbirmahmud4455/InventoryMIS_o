<?php

namespace App\Models\PurchaseModule;

use App\Models\SupplierModule\Supplier;
use App\Models\UserModule\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    // Get Purchase InvoiceNo/ChallanNo
    public function GetPurchaseChallanNo()
    {
        $purchase_challan_no = DB::select('SELECT id, challan_no
        FROM purchases
        ORDER BY id DESC;');

        return $purchase_challan_no;
    }

    public function PurchaseDetails($purchase_id)
    {
        $purchase = DB::select('SELECT purchases.id as purchase_id, date, suppliers.name as supplier_name, suppliers.contact_no as supplier_contact, purchases.supplier_id as supplier_id ,
        challan_no, total_amount, purchases.status as purchase_status
        FROM purchases
        LEFT JOIN suppliers ON suppliers.id = purchases.supplier_id
        WHERE purchases.id = ?;', [$purchase_id]);

        $purchase_details = DB::select('SELECT purchase_details.id as purchase_details_id, purchase_details.purchase_id , lots.name as lot_name, purchase_details.lot_id, items.name as item_name, purchase_details.item_id, units.name as unit_name, purchase_details.unit_id, variants.name as variant_name,
        purchase_details.variant_id, unit_price, purchase_details.quantity, purchase_details.total_price, xyz.warehouse_id, warehouses.name as warehouse_name
        FROM purchase_details
        LEFT JOIN lots ON lots.id = purchase_details.lot_id
        LEFT JOIN items ON items.id = purchase_details.item_id
        LEFT JOIN units ON units.id = purchase_details.unit_id
        LEFT JOIN variants ON variants.id = purchase_details.variant_id
        LEFT JOIN stock_in_outs as xyz ON xyz.purchase_id = purchase_details.purchase_id AND xyz.item_id = purchase_details.item_id AND xyz.unit_id = purchase_details.unit_id AND xyz.variant_id = purchase_details.variant_id
        LEFT JOIN warehouses ON warehouses.id = xyz.warehouse_id
        WHERE purchase_details.purchase_id = ?;', [$purchase_id]);

        if($purchase){
            return [
                'purchase' => $purchase[0],
                'purchase_details' => $purchase_details
            ];
        } else {
            return [
                'purchase' => null
            ];
        }
    }
}
