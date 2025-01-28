<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Accounts;

class AccountAddresses extends Model{
    protected $table = 'account_addresses';
    
    public function accounts(){
        return $this->belongsTo(Accounts::class, 'id', 'account_id');
    }
}

