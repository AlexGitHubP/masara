<?php

namespace App\Models;

use App\Models\AccountCompany;
use App\Models\AccountAddresses;


use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

use Locomotif\Admin\Models\Users;


class Account extends Model{

    protected $table = 'accounts';

    const TYPE_ADMINISTRATOR = 'administrator';
    const TYPE_CLIENT = 'client';
    const TYPE_DESIGNER = 'designer';
    const TYPE_GUEST = 'guest';

    const STATUS_HIDDEN = 'hidden';
    const STATUS_PUBLISHED = 'published';
    const STATUS_PENDING = 'pending';

    public function scopeDesigner($query){
        return $query->where('type', self::TYPE_DESIGNER);
    }

    public function scopeStatus($query, $status = self::STATUS_PUBLISHED){
        return $query->where('status', $status);
    }

    public function scopeWithDesignerSeoUrl($query){
        $baseUrl = url('/');
        return $query->select(
            '*',
            DB::raw("CONCAT('".$baseUrl."/designeri/', url, '.html') as nice_url")
        );
    }

    public function addresses(){
        return $this->hasMany(AccountAddresses::class, 'account_id');
    }

    static function getAuthUserID(){
        $user = Users::find(Auth::user()->id);
        return $user->id;
    }

    static function getAccountID(){

        $user = Users::find(Auth::user()->id);
        $accountID = Account::where('user_id', Auth::user()->id)->select('id')->first();

        return $accountID->id;
    }

    static function getUserRole(){
        $user = Users::find(Auth::user()->id);
        $role = (isset($user->roles->pluck('name')[0]) && !empty($user->roles->pluck('name')[0])) ? $user->roles->pluck('name')[0] : '';
        return $role;
    }

    static function getProfilePicture($owner_id, $owner){
        $image = DB::table('media')
                    ->where('owner', '=', $owner)
                    ->where('owner_id', '=', $owner_id)
                    ->first();

        $image = (!empty($image) || $image!=null) ? asset($image->folder.'/'.$image->file) : asset('img/noimg.png');
        return $image;
    }

    static function getCompanyInfos($accountID){
        $exists = DB::table('account_company_infos')->where('account_id', '=', $accountID)->exists();
        if(!$exists){
            return $exists;
        }

        $companyInfos = DB::table('account_company_infos')->where('account_id', '=', $accountID)->first();

        return $companyInfos;
    }

    static function getAccountAddress($accountID){
        $accountAddress = Account::with('addresses')->find($accountID);
        return $accountAddress;
    }
    static function checkIfAccountExists($orderDetails){
        $exists = DB::table('accounts')->where('email', '=', $orderDetails['email'])->exists();

        if($exists){
            $user = DB::table('users')->where('email', '=', $orderDetails['email'])->first();
            return $user;
        }

        return false;
    }

    static function createPreorderAccount($orderDetails){

        $specialCharacters = '{#(%*@)';
        $basePassword = Str::random(40 - strlen($specialCharacters));
        $basePassword .= str_shuffle($specialCharacters);

        $existingUser = self::checkIfAccountExists($orderDetails);
        if($existingUser==false){
            //'password' => Hash::make($basePassword)
            try{
                $user = Users::create(['name' => $orderDetails['name'],'email' => $orderDetails['email']]);
                setUserRole('guest', $user->id);

                $account = new Account();
                $account->user_id      = $user->id;
                $account->type         = 'guest';
                $account->name         = $orderDetails['name'];
                $account->surname      = $orderDetails['surname'];
                $account->email        = $orderDetails['email'];
                $account->phone        = $orderDetails['phone'];
                $account->url          = buildUrl($orderDetails['name']);
                $account->description  = '';
                $account->ordering     = getOrdering($account->getTable(), 'ordering');
                $account->is_company   = $orderDetails['is_company'];
                $account->status       = 'pending';
                //salveaza client separat
                $account->save();

                return $user;
            }catch(Exception $exception) {
                $errorCode = $exception->getCode();
                if($errorCode=='23000'){
                    $existingUser = DB::table('users')->where('email', '=', $orderDetails['email'])->first();
                    return $existingUser;
                }
            }
        }else{
            return $existingUser;
        }


    }

}
