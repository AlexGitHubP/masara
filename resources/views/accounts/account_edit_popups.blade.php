<div class='update-profile-modal'>
    <div class='modal-element'>
        <svg viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" class='close-modal'>
            <path d="M18.8242 18.8198L1 1" stroke="#909090" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M18.8242 1L1 18.8198" stroke="#909090" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>            
        <h2>Modifcă informații profil</h2>
        <form action="" method='POST' id='updateAccountForm'>
            @csrf
            <div class="perfect-flex-hold normalise">
                <div class="perfect-left">
                    <div class="input-hold">
                        <label for="name">Nume</label>
                        <input type="text" name="name" id="name" value="{{ isset($accountInfo->name) ? $accountInfo->name : '' }}">
                    </div>
                </div>
                <div class="perfect-right">
                    <div class="input-hold">
                        <label for="surname">Prenume</label>
                        <input type="text" name="surname" id="surname" value="{{ isset($accountInfo->surname) ? $accountInfo->surname : '' }}">
                    </div>
                </div>
            </div>

            <div class="perfect-flex-hold normalise">
                <div class="perfect-left">
                    <div class="input-hold">
                        <label for="email">Email (acest câmp nu este editabil)</label>
                        <input type="text" name="email" id="email" value="{{ isset($accountInfo->email) ? $accountInfo->email : '' }}" readonly>
                    </div>
                </div>
                <div class="perfect-right">
                    <div class="input-hold">
                        <label for="phone">Telefon</label>
                        <input type="text" name="phone" id="phone" value="{{ isset($accountInfo->phone) ? $accountInfo->phone : '' }}">
                    </div>
                </div>
            </div>

            <div class="input-hold">
                <label for="description">Descriere profil</label>
                <textarea name="description" id="description" value=''>{{ isset($accountInfo->description) ? $accountInfo->description : '' }}</textarea>
            </div>

            <div class='separator-space'></div>
            <div class='double-btn-hold'>
                <div class='btn-hold'>
                    <input type="submit" value='Salvează adresa' class='general-btn' id='updateAccountInfos' data-endpoint='/cont-designer/editare-cont.html' data-method='POST' data-form='updateAccountForm'>
                    <div class='loader'>
                        <img src="{{url('img/loader.svg')}}" alt="">
                    </div>
                </div>
                <div class='btn-hold'>
                    <a href="" class='general-btn transparent-btn closeModal'>Închide</a>
                </div>
            </div>
        </form>
    </div>
</div>

<div class='delivery-address-modal'>
    <div class='modal-element'>
        <svg viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" class='close-modal'>
            <path d="M18.8242 18.8198L1 1" stroke="#909090" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M18.8242 1L1 18.8198" stroke="#909090" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>            
        <h2>Adaugă o adresă de livrare</h2>
        <form action="" method='POST' id='deliveryAddressForm'>
            @csrf
            <div class="perfect-flex-hold normalise">
                <div class="perfect-left">
                    <div class="input-hold">
                        <label for="contact_person">Persoana de contact</label>
                        <input type="text" name="contact_person" id="contact_person" value="{{$accountInfo->name.' '.$accountInfo->surname }}">
                    </div>
                </div>
                <div class="perfect-right">
                    <div class="input-hold">
                        <label for="street">Strada</label>
                        <input type="text" name="street" id="street" value="">
                    </div>
                </div>
            </div>
            <div class='lineFlex'>
                <div class="input-hold">
                    <label for="nr">Nr.</label>
                    <input type="text" name="nr" id="nr" value="">
                </div>
                <div class="input-hold">
                    <label for="bloc">Bloc</label>
                    <input type="text" name="bloc" id="bloc" value="">
                </div>
                <div class="input-hold">
                    <label for="scara">Scara</label>
                    <input type="text" name="scara" id="scara" value="">
                </div>
                <div class="input-hold">
                    <label for="apartament">Apartament</label>
                    <input type="text" name="apartament" id="apartament" value="">
                </div>
                <div class="input-hold">
                    <label for="zip_code">Cod poștal</label>
                    <input type="text" name="zip_code" id="zip_code" value="">
                </div>
            </div>

            <div class="perfect-flex-hold normalise">
                <div class="perfect-left">
                    <div class="input-hold">
                        <label for="county">Județ</label>
                        <select name="county" id="county" value="" class='changeCounty'>
                            <option value="">Alege Județ</option>
                            @foreach ($judete as $judet)
                                <option value="{{$judet->judet}}">{{$judet->judet}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="perfect-right">
                    <div class="input-hold">
                        <label for="city">Localitate/Oraș</label>
                        <select name="city" id="city" value="" class='changeCity'>
                            <option value="">Alege un Județ pentru lista de orașe</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="input-hold">
                <label for="user_address">Alte mențiuni pentru adresă</label>
                <textarea name="comments" id="comments"></textarea>
            </div>
            <div class="input-hold checkbox-hold">
                <label for="is_billing_address">Setează această adresă ca adresa de facturare</label>
                <input type="checkbox" name="is_billing_address" id="is_billing_address" value="">
                <div class="fake-check"></div>
            </div>
            <div class='separator-space'></div>
            <div class='double-btn-hold'>
                <div class='btn-hold'>
                    <input type="submit" value='Salvează adresa' id='addAddress' class='general-btn' data-endpoint='/cont-designer/adauga-adresa.html' data-method='POST' data-form='deliveryAddressForm'>
                    <div class='loader'>
                        <img src="{{url('img/loader.svg')}}" alt="">
                    </div>
                </div>
                <div class='btn-hold'>
                    <a href="" class='general-btn transparent-btn closeModal'>Anulează</a>
                </div>
            </div>
        </form>
    </div>
</div>

<div class='update-delivery-address-modal'>
    <div class='modal-element'>
        <svg viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" class='close-modal'>
            <path d="M18.8242 18.8198L1 1" stroke="#909090" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M18.8242 1L1 18.8198" stroke="#909090" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>            
        <h2>Modifică o adresă de livrare</h2>
        <form action="" method='POST' id='updateDeliveryAddressForm'>
            @csrf
            <input type="hidden" id='address_id' name='address_id' value=''>
            <div class="perfect-flex-hold normalise">
                <div class="perfect-left">
                    <div class="input-hold">
                        <label for="update_contact_person">Persoana de contact</label>
                        <input type="text" name="update_contact_person" id="update_contact_person" value="{{$accountInfo->name.' '.$accountInfo->surname }}">
                    </div>
                </div>
                <div class="perfect-right">
                    <div class="input-hold">
                        <label for="update_street">Strada</label>
                        <input type="text" name="update_street" id="update_street" value="">
                    </div>
                </div>
            </div>
            <div class='lineFlex'>
                <div class="input-hold">
                    <label for="update_nr">Nr.</label>
                    <input type="text" name="update_nr" id="update_nr" value="">
                </div>
                <div class="input-hold">
                    <label for="bloc">Bloc</label>
                    <input type="text" name="bloc" id="bloc" value="">
                </div>
                <div class="input-hold">
                    <label for="scara">Scara</label>
                    <input type="text" name="scara" id="scara" value="">
                </div>
                <div class="input-hold">
                    <label for="apartament">Apartament</label>
                    <input type="text" name="apartament" id="apartament" value="">
                </div>
                <div class="input-hold">
                    <label for="zip_code">Cod poștal</label>
                    <input type="text" name="zip_code" id="zip_code" value="">
                </div>
            </div>

            <div class="perfect-flex-hold normalise">
                <div class="perfect-left">
                    <div class="input-hold">
                        <label for="update_county">Județ</label>
                        <select name="update_county" id="update_county" value="" class='changeCounty'>
                            <option value="">Alege Județ</option>
                            @foreach ($judete as $judet)
                                <option value="{{$judet->judet}}">{{$judet->judet}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="perfect-right">
                    <div class="input-hold">
                        <label for="update_city">Localitate/Oraș</label>
                        <select name="update_city" id="update_city" value="" class='changeCity'>
                            <option value="">Alege un Județ pentru lista de orașe</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="input-hold">
                <label for="user_address">Alte mențiuni pentru adresă</label>
                <textarea name="comments" id="comments"></textarea>
            </div>
            <div class="input-hold checkbox-hold">
                <label for="update_is_billing_address">Setează această adresă ca adresa de facturare</label>
                <input type="checkbox" name="update_is_billing_address" id="update_is_billing_address" value="">
                <div class="fake-check"></div>
            </div>
            <div class='separator-space'></div>
            <div class='double-btn-hold'>
                <div class='btn-hold'>
                    <input type="submit" value='Salvează adresa' id='updateAddAddress' class='general-btn' data-endpoint='/cont-designer/modifica-adresa.html' data-method='POST' data-form='updateDeliveryAddressForm'>
                    <div class='loader'>
                        <img src="{{url('img/loader.svg')}}" alt="">
                    </div>
                </div>
                <div class='btn-hold'>
                    <a href="" class='general-btn transparent-btn closeModal'>Anulează</a>
                </div>
            </div>
        </form>
    </div>
</div>



<div class='delivery-invoice-address-modal'>
    <div class='modal-element'>
        <svg viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" class='close-modal'>
            <path d="M18.8242 18.8198L1 1" stroke="#909090" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M18.8242 1L1 18.8198" stroke="#909090" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>            
        <h2>Modifca adresa de facturare</h2>
        <form action="" method='POST' id='invoiceAddressForm'>
            <div class="perfect-flex-hold normalise">
                <div class="perfect-left">
                    <div class="input-hold">
                        <label for="user_name">Persoana de contact</label>
                        <input type="text" name="user_name" id="user_name" value="">
                    </div>
                </div>
                <div class="perfect-right">
                    <div class="input-hold">
                        <label for="phone">Telefon</label>
                        <input type="text" name="phone" id="phone" value="">
                    </div>
                </div>
            </div>

            <div class="perfect-flex-hold normalise">
                <div class="perfect-left">
                    <div class="input-hold">
                        <label for="county2">Județ</label>
                        <select name="county2" id="county2" value="">
                            <option value="">Alege Județ</option>
                            <option value="alba">ALba</option>
                            <option value="cluj">Cluj</option>
                        </select>
                    </div>
                </div>
                <div class="perfect-right">
                    <div class="input-hold">
                        <label for="city">Localitate/Oraș</label>
                        <select name="city" id="city" value="">
                            <option value="">Alege Localitate/Oraș</option>
                            <option value="blaj">Blaj</option>
                            <option value="cluj">Cluj</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="input-hold">
                <label for="user_address">Adresa de contact</label>
                <input type="text" name="user_address" id="user_address" value="">
            </div>
            <div class='separator-space'></div>
            <div class='double-btn-hold'>
                <div class='btn-hold'>
                    <input type="submit" value='Salvează adresa' class='general-btn'>
                    <div class='loader'>
                        <img src="{{url('img/loader.svg')}}" alt="">
                    </div>
                </div>
                <div class='btn-hold'>
                    <a href="" class='general-btn transparent-btn closeModal'>Anulează</a>
                </div>
            </div>
        </form>
    </div>
</div>