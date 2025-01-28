<?php

namespace App\Http\Controllers;

use Exception;

use Illuminate\Support\Str;
use App\Models\Cart as CartModel;
use App\Models\GeneralModel;
use App\Models\Account as AccountModel;
use App\Models\AccountCompany;
use App\Models\AccountAddresses;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;



use Locomotif\Admin\Models\Users;
use Locomotif\Media\Models\Media;


class Account extends Controller
{
    public function __construct(){
        $cartInfos = CartModel::getCart();
        view()->share(compact('cartInfos'));
    }
    
    public function createDesignerAccountPage(){
        $accountType = 'designer';
        return view('accounts.create_designer_account')
                ->with(compact('accountType'));
    }

    public function createClientAccountPage(){
        $accountType = 'client';
        return view('accounts.create_client_account')
                ->with(compact('accountType'));
    }
    

    public function loginPage(){
        return view('accounts.login');
    }

    public function login(Request $request){

        $credentials = $request->only('email', 'password');
        
        if (Auth::attempt($credentials)) {
            // Authentication passed
            $user = Users::find(Auth::user()->id);
            $response = array(
                'success' => true,
                'type' => 'redirect',
                'endpoint' => redirectArea($user)
            );
            return response()->json($response);
        } else {
            // Authentication failed
            $response = array(
                'success' => false,
                'type'    => 'display',
                'message' => array('Email sau parola greșită.')
            );
            return response()->json($response);
        }
    }

    public function logout(Request $request){
        Auth::logout();
        return  redirect('/login.html');
    }

    function uploadProfileImage(Request $request){

        if(isset($request->file) && !empty($request->file)){
                            
                $file = $request->file;
                $pid = $request->accountID;

                $this->deleteImageIfExists('accounts', $pid);

                $mediaElement = new Media();
                $mediaElement->original_name  = $file->getClientOriginalName();
                $mediaElement->file           = $file->hashName();
                $mediaElement->owner          = 'accounts';
                $mediaElement->owner_id       = (int)$pid;
                $mediaElement->main           = 0;
                $mediaElement->folder         = 'media';
                $mediaElement->type           = $file->extension();
                $mediaElement->ordering       = 0;
                $mediaElement->ordering_owner = null;
                $mediaElement->status         = 'published';
                
                $mediaElement->save();
                $savedFile = $file->store('media');
                $response = [
                    'success' => true,
                    'savedFile' => $savedFile,
                    'type'    => 'display',
                    'message' => array('Imagine adaugata cu success.'),
                ];
        }else{
            $response = [
                'success' => false,
                'savedFile' => null,
                'type'    => 'display',
                'message' => array('Adaugă o imagine de profil.'),
            ];
        }

        return response()->json($response);
    }
    public function deleteImageIfExists($accountType, $pid){
        $pid = (int)$pid;
        $recordExists = DB::table('media')->where('owner', '=', $accountType)->where('owner_id', '=', $pid)->first();
        if($recordExists !=null){
            DB::table('media')->where('owner', '=', $accountType)->where('owner_id', '=', $pid)->delete();
            $file = $recordExists->file;
            $file = public_path('media/'.$file);
            if (file_exists($file)) {
                unlink($file);
            }
        }
    }
    public function deleteImage(Request $request){
    
        $mediaID = $request->mediaID;
        $media = Media::findOrFail($mediaID);
        $media->file = public_path($media->folder.'/'.$media->file);
        
        if (file_exists($media->file)) {
            unlink($media->file);
            $media->delete();
            
            $response['success'] = true;
            $response['message'] = 'Imaginea de profil a fost ștearsă.';
            $response['type']    = 'mediaDelete';
        }else{
            $response['success'] = false;
            $response['message'] = 'A intervenit o eroare. Te rugăm încearcă din nou.';
            $response['type']    = 'mediaDelete';    
        }
        
        return response()->json($response);

    }

    public function getProfilePictureAjax(Request $request){

        $postData = $request->json()->all();
        $profileID = $postData['profileID'];
        $image = AccountModel::getProfilePicture($profileID, 'accounts');
        
        if (isset($image) && !empty($image)) {
            $response['success'] = true;
            $response['message'] = '';
            $response['type']    = 'mediaGet';    
            $response['data']    = $image;
        }else{
            $response['success'] = false;
            $response['message'] = 'A intevenit o eroare. Încearcă din nou.';
            $response['type']    = 'mediaGet';
        }
        
        return response()->json($response);
    }

    public function createAccount(Request $request){
        
        $validator = Validator::make($request->all(), [
            'name'                  => 'required',
            'surname'               => 'required',
            'email'                 => 'required|email|unique:users,email',
            'password'              => 'required|confirmed',
            'password_confirmation' => 'required',
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'type'    => 'display',
                'message' => $validator->errors()
            ], 422);
        }
            
        //creaza user si intoarce instanta
        try{
            $user = Users::create(['name' => $request->name,'email' => $request->email, 'password' => Hash::make($request->password)]);
            $user = Users::find($user->id);
        }catch(Exception $exception) {
            
            $errorCode = $exception->getCode();
            
            if($errorCode=='23000'){
                $response = array(
                    'success' => false,
                    'type'    => 'display',
                    'message' => array('Există deja user asociat acestei adrese de e-mail.')
                );
            }else if($errorCode=='2002'){
                $response = array(
                    'success' => false,
                    'type'    => 'display',
                    'message' => array('A intervenit o eroare la creearea contului. Te rugăm încearcă din nou.')
                );
            }
            return response()->json($response);
        }

        //seteaza rol
        if(checkRoleExists($request->accountType)){
            setUserRole($request->accountType, $user->id);
        }else{
            $response = array(
                'success' => false,
                'type'    => 'display',
                'message' => array('Nu există cont de tip '.$request->accountType.'. Te rugăm încearcă din nou.')
            );
            return response()->json($response);
        }
        
        try{
            $account = new AccountModel();
            $account->user_id     = $user->id;
            $account->type        = $request->accountType;
            $account->name        = $request->name;
            $account->surname     = $request->surname;
            $account->email       = $request->email;
            $account->phone       = $request->phone;
            $account->is_company  = (isset($request->is_company) && is_string($request->is_company)) ? filter_var($request->is_company, FILTER_VALIDATE_BOOLEAN) ? 1 : 0 : 0;
            $account->url         = buildUrl($request->name);
            $account->description = '';
            $account->ordering    = getOrdering($account->getTable(), 'ordering');
            $account->status      = 'published';
            //salveaza designer separat
            $account->save();
        }catch(Exception $exception){
            $errorCode = $exception->getCode();
            
            if($errorCode=='23000'){
                $response = array(
                    'success' => false,
                    'type'    => 'display',
                    'message' => array('Există deja user asociat acestei adrese de e-mail.')
                );
            }else if($errorCode=='2002'){
                $response = array(
                    'success' => false,
                    'type'    => 'display',
                    'message' => array('A intervenit o eroare la creearea contului. Te rugăm încearcă din nou.')
                );
            }
            return response()->json($response);
        }
        
        //autentifica in cont
        Auth::login($user);

        $response = array(
            'success' => true,
            'type' => 'redirect',
            'endpoint' => '/cont-designer/dashboard.html'
        );

        return response()->json($response);
        
    }

    public function saveCompanyInfo(Request $request){
        
        $accountID = AccountModel::getAccountID();
        $validator = Validator::make($request->all(), [
            'company_name'      => 'required',
            'company_type'      => 'required',
            'company_vat_type'  => 'required',
            'company_cui'       => 'required',
            'company_j'         => 'required',
            'company_nr'        => 'required',
            'company_series'    => 'required',
            'company_year'      => 'required',
            
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'type'    => 'display',
                'message' => $validator->errors()
            ], 422);
        }else{

            $accountCompany = new AccountCompany;
            
            $accountCompany->account_id       = $accountID;
            $accountCompany->company_name     = $request->company_name;
            $accountCompany->company_type     = $request->company_type;
            $accountCompany->company_vat_type = $request->company_vat_type;
            $accountCompany->company_cui      = $request->company_cui;
            $accountCompany->company_j        = $request->company_j;
            $accountCompany->company_nr       = $request->company_nr;
            $accountCompany->company_series   = $request->company_series;
            $accountCompany->company_year     = $request->company_year;
            $accountCompany->save();

            $response = array(
                'success' => true,
                'type'    => 'snackbar',
                'message' => array('Companie adăugată cu success.'),
                'area'    => '',
                'resetForm' => true,
                'returnedResponse' => $accountCompany->id
            );

            return response()->json($response);
        }
    }

    public function editCompanyInfo(Request $request){
        
        $accountID = AccountModel::getAccountID();
        $validator = Validator::make($request->all(), [
            'company_name'      => 'required',
            'company_type'      => 'required',
            'company_vat_type'  => 'required',
            'company_cui'       => 'required',
            'company_j'         => 'required',
            'company_nr'        => 'required',
            'company_series'    => 'required',
            'company_year'      => 'required',
            
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'type'    => 'display',
                'message' => $validator->errors()
            ], 422);
        }else{

            AccountCompany::where('id', $request->company_id)->update([
                'account_id'        => $request->account_id,
                'company_name'     => $request->company_name,
                'company_type'       => $request->company_type,
                'company_vat_type'         => $request->company_vat_type,
                'company_cui' => $request->company_cui,
                'company_j' => $request->company_j,
                'company_nr' => $request->company_nr,
                'company_series' => $request->company_series,
                'company_year' => $request->company_year,
            ]);

            $response = array(
                'success' => true,
                'type'    => 'snackbar',
                'message' => array('Informații modificate cu success.'),
                'area'    => '',
                'resetForm' => false,
            );

            return response()->json($response);
        }
    }

    public function editAccount(AccountModel $account){
        
        $accountID = AccountModel::getAccountID();
        $userRole = AccountModel::getUserRole();
        $accountID = AccountModel::getAccountID();
        $profilePicture = AccountModel::getProfilePicture($accountID, 'accounts');
        $account = AccountModel::where('user_id', Auth::user()->id)->first();
        $addresses = AccountModel::with('addresses')->find($accountID);
        $totalAddresses = (isset($addresses->addresses) && count($addresses->addresses)>0) ? count($addresses->addresses) : 0;
        $addresses->total = $totalAddresses;
        $judete = GeneralModel::getDistinctCounty();
        
        return view('accounts.designers.account.editAccount')
                ->with('accountInfo', $account)
                ->with('addresses', $addresses)
                ->with('judete', $judete)
                ->with(compact('accountID'))
                ->with(compact('userRole'))
                ->with(compact('profilePicture'));
    }

    public function updateAccount(Request $request, AccountModel $account){

        $validator = Validator::make($request->all(), [
            'name'                  => 'required',
            'surname'               => 'required',
            'email'                 => 'required|email',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'type'    => 'display',
                'message' => $validator->errors()
            ], 422);
        }else{
            //update user
            $user = Users::find(Auth::user()->id);
            Users::where('id', $user->id)->update([
                'name'    => $request->name
            ]);
            
            //update account
            $user = Users::find(Auth::user()->id);
            AccountModel::where('user_id', $user->id)->update([
                'name'        => $request->name,
                'surname'     => $request->surname,
                'phone'       => $request->phone,
                'url'         => buildUrl($request->name),
                'description' => $request->description,
            ]);
            
            $response = array(
                'success' => true,
                'type' => 'snackbar',
                'message' => array('Cont modificat cu succes.'),
                'area' => 'accountDesigner',
                'resetForm' => false,
                'returnedResponse' => $request->all()
            );

            return response()->json($response);
        }
    }

    public function addAddress(Request $request){
        
        $accountID = AccountModel::getAccountID();

        $is_billing_address = (isset($request->is_billing_address) && is_string($request->is_billing_address)) ? filter_var($request->is_billing_address, FILTER_VALIDATE_BOOLEAN) ? 1 : 0 : 0;
        if($is_billing_address){
            AccountAddresses::where('account_id', $accountID)->update([
                'is_billing_address' => 0,
            ]);
        }

        $validator = Validator::make($request->all(), [
            'contact_person'     => 'required',
            'street'             => 'required',
            'nr'                 => 'required',
            'city'               => 'required',
            'county'             => 'required',
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'type'    => 'display',
                'message' => $validator->errors()
            ], 422);
        }else{
            
            $accountAddress = new AccountAddresses;
            
            $accountAddress->account_id    = $accountID;
            $accountAddress->contact_person = $request->contact_person;
            $accountAddress->street         = $request->street;
            $accountAddress->nr             = $request->nr;
            $accountAddress->bloc           = ($request->filled('bloc'))  ? $request->bloc : 'N/A';
            $accountAddress->scara          = ($request->filled('scara')) ? $request->scara : 'N/A';
            $accountAddress->apartament     = ($request->filled('apartament')) ? $request->apartament : 'N/A';
            $accountAddress->city           = $request->city;
            $accountAddress->county         = $request->county;
            $accountAddress->country        = 'Rommânia';
            $accountAddress->comments       = ($request->filled('comments')) ? $request->comments : '';
            $accountAddress->zip_code       = ($request->filled('zip_code')) ? $request->zip_code : 'N/A';
            $accountAddress->ordering       = getOrdering($accountAddress->getTable(), 'ordering');
            $accountAddress->is_billing_address = $is_billing_address;
            $accountAddress->save();

            $accountAddressInfo = AccountAddresses::find($accountAddress->id);

            $response = array(
                'success' => true,
                'type'    => 'snackbar',
                'message' => array('Adresă adăugată cu succes.'),
                'area'    => 'addressAdd',
                'resetForm' => true,
                'returnedResponse' => $accountAddressInfo
            );

            return response()->json($response);

        }
    }

    public function editAddress(Request $request){
        $validator = Validator::make($request->all(), [
            'update_contact_person'     => 'required',
            'update_street'             => 'required',
            'update_nr'                 => 'required',
            'update_city'               => 'required',
            'update_county'             => 'required',
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'type'    => 'display',
                'message' => $validator->errors()
            ], 422);
        }else{
            $accountID = AccountModel::getAccountID();
            
            $is_billing_address = (isset($request->update_is_billing_address) && is_string($request->update_is_billing_address)) ? filter_var($request->update_is_billing_address, FILTER_VALIDATE_BOOLEAN) ? 1 : 0 : 0;
            if($is_billing_address){
                AccountAddresses::where('account_id', $accountID)->update([
                    'is_billing_address' => 0,
                ]);
            }


            AccountAddresses::where('id', $request->address_id)->update([
                'account_id'        => $accountID,
                'contact_person'     => $request->update_contact_person,
                'street'             => $request->update_street,
                'nr'                 => $request->update_nr,
                'bloc'               => ($request->filled('bloc'))  ? $request->bloc : 'N/A',
                'scara'              => ($request->filled('scara')) ? $request->scara : 'N/A',
                'apartament'         => ($request->filled('apartament')) ? $request->apartament : 'N/A',
                'city'               => $request->update_city,
                'county'             => $request->update_county,
                'country'            => 'Rommânia',
                'comments'           => ($request->filled('comments')) ? $request->comments : '',
                'zip_code'           => ($request->filled('zip_code')) ? $request->zip_code : 'N/A',
                'is_billing_address' => $is_billing_address
            ]);

            $response = array(
                'success' => true,
                'type'    => 'addressUpdated',
                'message' => array('Adresă modificata cu succes.'),
                'resetForm' => false,
                'returnedResponse' => $request->all()
            );

            return response()->json($response);

        }
    }

    public function deleteAccountAddress(Request $request){
        $data = $request->json()->all();
        $address_id = $data['address_id'];

        $addressToDelete  = AccountAddresses::find($address_id);
        $isDeleted = $addressToDelete->delete();
        
        return response()->json([
            'success' => $isDeleted,
            'type'    => 'addressDeleted',
            'id'      => $address_id,
            'message' => array('Adresa a fost ștearsă.')
        ]);
    }

    public function getAccountAddress(Request $request){
        $data = $request->json()->all();
        $address = AccountAddresses::find($data['address_id']);
        return response()->json([
            'success' => true,
            'type' => 'appendAddress',
            'message' => array(''),
            'area' => 'appendAddress',
            'returnedResponse' => $address
        ]);
    }
}
