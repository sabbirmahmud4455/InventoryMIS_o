<?php

namespace App\Models\UserModule;

use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Module extends Model
{
    use HasFactory;



    public function sub_module(){

        $lang = App::currentLocale();

        return $this->hasMany(SubModule::class)->select("name_$lang AS name", "id", "module_id", "key", "position", "route");

    }

    public function permission(){
        return $this->hasMany(Permission::class);
    }

}
