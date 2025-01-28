@extends('inc.layout')

@section('content')

<section class='menu-space'></section>

<section class='client-account'>
    <div class='large-container'>
        <div class='dashboard-flex'>
            <div class='dashboard-left'>
                <div class='dashboard-left-content'>
                    @include('accounts.designers.account.designers_left_menu', ['accountID'=>$accountID, 'userRole'=>$userRole, 'profilePicture'=>$profilePicture])
                </div>
            </div>
            <div class='dashboard-right editTab'>
                <h1>Editare profil</h1>
                <div class='edit-tab'>
                    <h2>Informații profil</h2>
                    <div class='infos-panel'>
                        <p class='dName'><strong>Nume:</strong> {{$accountInfo->name}}</p>
                        <p class='dSurname'><strong>Prenume:</strong> {{$accountInfo->surname}}</p>
                        <p><strong>Email:</strong> {{$accountInfo->email}}</p>
                        <p class='dPhone'><strong>Telefon:</strong> {{$accountInfo->phone}}</p>
                        <p class='dDescription'><strong>Descriere profil:</strong> {{$accountInfo->description}}</p>
                    </div><!--infos-panel-->
                    <div class='add-delivery-address-hold'>
                        <a href="" class="general-btn transparent-btn update-profile">Modifică</a>
                    </div>
                </div>

                <h1>Editare cont</h1>
                <div class='edit-tab'>
                    <h2>{{$addresses->total > 1 ? 'Adrese' : 'Adresa'}} de livrare</h2>
                    <h3>{{$addresses->total > 0 ? $addresses->total.' adrese salvate' : 'Nu există adrese de livrare salvate.'}} </h3>
                    @foreach ($addresses->addresses as $key => $value )
                    <div class='infos-panel address-{{$value->id}}'>
                        @if($value->is_billing_address==1)
                        <div class='billAddress'>
                            <p>Setat ca adresa de facturare</p>
                        </div>
                        @endif
                        <p><strong>Persoana de contact:</strong> {{$value->contact_person}}</p>
                        <p><strong>Strada:</strong> {{$value->street}}</p>
                        <p><strong>Nr.:</strong> {{$value->nr}}</p>
                        <p><strong>Bloc:</strong> {{$value->bloc}}</p>
                        <p><strong>Scara:</strong> {{$value->scara}}</p>
                        <p><strong>Apartament:</strong> {{$value->apartament}}</p>
                        <p><strong>Oraș:</strong> {{$value->city}}</p>
                        <p><strong>Județ:</strong> {{$value->county}}</p>
                        <p><strong>Țara:</strong> {{$value->country}}</p>
                        <p><strong>Cod poștal:</strong> {{$value->zip_code}}</p>
                        <p><strong>Detalii adresă:</strong> {{$value->comments}}</p>
                        <a href="" class='editDeliveryAddress' data-addressid='{{$value->id}}'>Editează adresa de livrare</a>
                        <a href="" class='stergeAdresa'  data-addressid='{{$value->id}}'>Șterge adresa</a>
                    </div><!--infos-panel-->
                    @endforeach
                    <div id='appendAddresses'></div>
                    
                    <div class='add-delivery-address-hold'>
                        <a href="" class="general-btn transparent-btn add-delivery-address">Adaugă adresă nouă</a>
                    </div>
                </div>

                
                <div class='separator-space'></div>
                <div class='separator-space'></div>
            </div><!--dashboard-right-->
        </div>
    </div>

</section>
@include('accounts.account_edit_popups', ['accountInfo'=>$accountInfo, 'judete'=>$judete])

@stop 