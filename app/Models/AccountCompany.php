<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Accounts;

class AccountCompany extends Model{
    protected $table = 'account_company_infos';

    public function accounts(){
        return $this->belongsTo(Accounts::class, 'id', 'account_id');
    }
}
