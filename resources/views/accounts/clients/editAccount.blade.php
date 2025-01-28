@extends('inc.layout')

@section('content')

<section class='menu-space'></section>

<section class='client-account'>
    <div class='large-container'>
        <div class='dashboard-flex'>
            <div class='dashboard-left'>
                <div class='dashboard-left-content'>
                    @include('accounts.clients.clients_left_menu')
                </div>
            </div>
            <div class='dashboard-right editTab'>
                <h1>Editare cont</h1>
                <div class='edit-tab'>
                    <h2>Adresa de livrare</h2>
                    <h3>2 adrese salvate</h3>
                    <div class='infos-panel'>
                        <p>Bulevardul Barbu Vacarescu,  Numaru 90, Bloc X, Scara 2, Etaj 7, Apartament 64, Interfon 112, Bucureşti (Sectorul 2), Bucureşti</p>
                        <p><strong>Persoana de contact:</strong> Andrei Popescu</p>
                        <a href="" class='editDeliveryAddress'>Editează adresa de livrare</a>
                        <a href="" class='stergeAdresa'>Șterge adresa</a>
                    </div><!--infos-panel-->
                    <div class='infos-panel lastPanel'>
                        <p>Bulevardul Barbu Vacarescu,  Numaru 90, Bloc X, Scara 2, Etaj 7, Apartament 64, Interfon 112, Bucureşti (Sectorul 2), Bucureşti</p>
                        <p><strong>Persoana de contact:</strong> Andrei Popescu</p>
                        <a href="" class='editDeliveryAddress'>Editează adresa de livrare</a>
                        <a href="" class='stergeAdresa'>Șterge adresa</a>
                    </div><!--infos-panel-->
                    <div class='add-delivery-address-hold'>
                        <a href="" class="general-btn transparent-btn add-delivery-address">Adaugă adresă</a>
                    </div>
                </div>

                <div class='edit-tab'>
                    <h2>Date de facturare</h2>
                    <h3>1 persoană fizică</h3>
                    <div class='infos-panel lastPanel'>
                        <p>Bulevardul Barbu Vacarescu,  Numaru 90, Bloc X, Scara 2, Etaj 7, Apartament 64, Interfon 112, Bucureşti (Sectorul 2), Bucureşti</p>
                        <p><strong>Persoana de contact:</strong> Andrei Popescu</p>
                        <a href="" class='editInvoiceAddress'>Editează adresa de livrare</a>
                        <a href="" class='stergeAdresa'>Șterge adresa</a>
                    </div><!--infos-panel-->
                   
                    <div class='add-invoice-address-hold'>
                        <a href="" class="general-btn transparent-btn add-invoice-address">Adaugă adresă</a>
                    </div>
                </div>
                
                <div class='separator-space'></div>
                <div class='separator-space'></div>
            </div><!--dashboard-right-->
        </div>
    </div>

</section>
@include('accounts.clients.account_edit_popups')

@stop 