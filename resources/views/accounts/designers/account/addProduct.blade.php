@extends('inc.layout')

@section('styles')
<link rel="stylesheet" href="{{ mix('css/slimselect/slimselect.min.css') }}">
<link rel="stylesheet" href="{{ mix('css/dropzone/dropzone.min.css') }}">
<link rel="stylesheet" href="{{ mix('css/slimselect/customStyles.css') }}">
@endsection

@section('content')

<section class='menu-space'></section>

<section class='dashboard-account'>
    <div class='large-container'>
        <div class='dashboard-flex'>
            <div class='dashboard-left'>
                <div class='dashboard-left-content'>
                    @include('accounts.designers.account.designers_left_menu', ['accountID'=>$accountID, 'userRole'=>$userRole, 'profilePicture'=>$profilePicture])
                </div>
            </div>
            <div class='dashboard-right addProductDashboard'>
                <h1>Adaugă un produs nou</h1>
                <h3>Informatii utile inainte de adaugare produs:</h3>
                <ul class='link-uriGhid'>
                    <li>
                        <a href="">Ghid adăugare produs</a>
                    </li>
                    <li>
                        <a href="">Politica de preturi</a>
                    </li>
                </ul>
                <form action="" method='POST' id='addProductForm'>
                    @csrf
                    <input type="hidden" name="pid" id='pid' value=''>
                    <input type="hidden" name="meta_name" id='meta_name' value=''>
                    <input type="hidden" name="meta_owner" id='meta_owner' value='product'>
                    <input type="hidden" name="meta_key" id='meta_key' value=''>
                    <input type="hidden" name="meta_attribute" id='meta_attribute' value=''>

                    <div class='lineFlex'>
                        <div class="input-hold">
                            <label for="name">Nume produs</label>
                            <input type="text" name="name" id="name" value="">
                        </div>
                        <div class="input-hold">
                            <label for="price_estimate">Categorie produs</label>
                            <select name="category" id="category" value='' class='selectCategory' multiple>
                                @foreach ($productCategories as $key => $category )
                                <optgroup label="{{$category->category_name}}">
                                    @foreach ($category->subcategories as $kk => $subcategory )
                                        <option value="{{$subcategory->id}}">{{$subcategory->subcategory_name}}</option>
                                    @endforeach
                                </optgroup>
                                @endforeach
                            </select>
                        </div>
                        <div class="input-hold">
                            <label for="area">Zona produs</label>
                            <select name="area" id="area" value='' class='selectArea' multiple>
                                <option data-placeholder="true"></option>
                                @foreach ($productsAreas as $key => $area )
                                <option value="{{$area->id}}">{{$area->area_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class='perfect-flex-hold componentBuilderHold'>
                        <div class='perfect-left'>
                            <div class="input-hold" style='margin-bottom:1.28125VW'>
                                <label for="attr_type_select">Compune produsul din:</label>
                                <select name="attr_type_select" id="attr_type_select" class='attr_type_select selectAttr' value=''>
                                    <option data-placeholder="true"></option>
                                    @foreach ($productsAttributes as $productsAttribute )
                                        <option data-name="{{$productsAttribute->attr_identifier}}" value="{{$productsAttribute->id}}">{{$productsAttribute->attr_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="input-hold">
                                <div class="constructAttrSelectors"></div>
                            </div>
                            <div class="input-hold">
                                <div class="constructValsSelectors"></div>
                            </div>
                        </div>
                        <div class='perfect-right'>

                            <div class='dynamicParent'>
                                @if ($components !=0)
                                @foreach ($components as $key => $component )
                                <div class="attr_values_group gID{{$component['meta_key']}} bar">
                                    <p class="displayBlock">{{$component['meta_name']}}</p>
                                    @foreach ($component['meta_attributes'] as $kk => $attribute )
                                    <div class="attr_group">
                                        <p>{{$kk}}:</p>
                                        <ul class="attr_meta">
                                            <li data-id="{{$component['meta_key']}}_">{{$attribute}}<span>X</span></li>
                                        </ul>
                                    </div>
                                    @endforeach
                                </div>
                                @endforeach
                                @endif
                            </div>

                            <div class='btn-hold'>
                                <a href="" class='general-btn black-btn addComponent'>Adaugă componenta: <span class='component'></span></a>
                                <a href="" class='general-btn orange-btn deleteAllComponents {{ $components != 0 ? "showBtn" : "" }} '>Șterge toate componentele</a>
                            </div>
                        </div><!--perfect-right-->

                    </div>




                    <p class='color-label' style='display:none;'>Culoare (selectați toate variantele posibile)</p>
                    <div class='color-selector-flex' style='display:none;'>

                        <div class='color-selector-element'>
                            <div class='color-selector-item'>
                                <input type="checkbox" name='color[]' id='color1'>
                                <label for='color1' class='colorChecker color1'></label>
                            </div>
                        </div><!--color-selector-element-->

                        <div class='color-selector-element'>
                            <div class='color-selector-item'>
                                <input type="checkbox" name='color[]' id='color2'>
                                <label for='color2' class='colorChecker color2'></label>
                            </div>
                        </div><!--color-selector-element-->

                        <div class='color-selector-element'>
                            <div class='color-selector-item'>
                                <input type="checkbox" name='color[]' id='color3'>
                                <label for='color3' class='colorChecker color3'></label>
                            </div>
                        </div><!--color-selector-element-->

                        <div class='color-selector-element'>
                            <div class='color-selector-item'>
                                <input type="checkbox" name='color[]' id='color4'>
                                <label for='color4' class='colorChecker color4'></label>
                            </div>
                        </div><!--color-selector-element-->

                        <div class='color-selector-element'>
                            <div class='color-selector-item'>
                                <input type="checkbox" name='color[]' id='color5'>
                                <label for='color5' class='colorChecker color5'></label>
                            </div>
                        </div><!--color-selector-element-->

                        <div class='color-selector-element'>
                            <div class='color-selector-item'>
                                <input type="checkbox" name='color[]' id='color6'>
                                <label for='color6' class='colorChecker color6'></label>
                            </div>
                        </div><!--color-selector-element-->

                        <div class='color-selector-element'>
                            <div class='color-selector-item'>
                                <input type="checkbox" name='color[]' id='color7'>
                                <label for='color7' class='colorChecker color7'></label>
                            </div>
                        </div><!--color-selector-element-->

                        <div class='color-selector-element'>
                            <div class='color-selector-item'>
                                <input type="checkbox" name='color[]' id='color8'>
                                <label for='color8' class='colorChecker color8'></label>
                            </div>
                        </div><!--color-selector-element-->

                        <div class='color-selector-element'>
                            <div class='color-selector-item'>
                                <input type="checkbox" name='color[]' id='color9'>
                                <label for='color9' class='colorChecker color9'></label>
                            </div>
                        </div><!--color-selector-element-->

                        <div class='color-selector-element'>
                            <div class='color-selector-item'>
                                <input type="checkbox" name='color[]' id='color10'>
                                <label for='color10' class='colorChecker color10'></label>
                            </div>
                        </div><!--color-selector-element-->

                        <div class='color-selector-element'>
                            <div class='color-selector-item'>
                                <input type="checkbox" name='color[]' id='color11'>
                                <label for='color11' class='colorChecker color11'></label>
                            </div>
                        </div><!--color-selector-element-->

                        <div class='color-selector-element'>
                            <div class='color-selector-item'>
                                <input type="checkbox" name='color[]' id='color12'>
                                <label for='color12' class='colorChecker color12'></label>
                            </div>
                        </div><!--color-selector-element-->

                        <div class='color-selector-element'>
                            <div class='color-selector-item'>
                                <input type="checkbox" name='color[]' id='color13'>
                                <label for='color13' class='colorChecker color13'></label>
                            </div>
                        </div><!--color-selector-element-->

                    </div><!--color-selector-flex-->
                    <div class='separator-space'></div>
                    <div class='input-hold'>
                        <label for="description">Descriere produs</label>
                        <textarea name="description" id="description"></textarea>
                        <p class='textarea-count'>Max. 600 de caractere</p>
                    </div>
                    <div class='separator-space'></div>

                    <div class='perfect-flex-hold'>
                        <div class='perfect-left'>
                            <div class='multiple-upl-img-hold' id='multiple-upl-img-hold'>
                                {{-- <input type="file" id="multiple-uploader" name="multiple-uploader" multiple> --}}
                                <div class='multiple-uploader' >
                                    <div class='cload-img-hold'>
                                        <div class="cload-img">
                                            <svg viewBox="0 0 47 38" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M32 27L24 19L16 27" stroke="black" stroke-opacity="0.4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M24 19V37" stroke="black" stroke-opacity="0.4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M40.7789 31.78C42.7296 30.7166 44.2706 29.0338 45.1587 26.9973C46.0468 24.9608 46.2314 22.6865 45.6834 20.5334C45.1353 18.3803 43.8859 16.4711 42.1323 15.1069C40.3786 13.7428 38.2207 13.0015 35.9989 13H33.4789C32.8736 10.6585 31.7453 8.4847 30.1788 6.64202C28.6124 4.79933 26.6486 3.33573 24.4351 2.36124C22.2216 1.38676 19.816 0.926747 17.3992 1.01579C14.9823 1.10484 12.6171 1.74063 10.4813 2.87536C8.34552 4.01009 6.49477 5.61424 5.06819 7.56719C3.64161 9.52015 2.67632 11.7711 2.2449 14.1508C1.81348 16.5305 1.92715 18.9771 2.57737 21.3066C3.22759 23.636 4.39743 25.7878 5.99894 27.6" stroke="black" stroke-opacity="0.4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M32 27L24 19L16 27" stroke="black" stroke-opacity="0.4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </div>
                                    </div><!--cload-img-->

                                    <div class='cloud-disclaimer'>
                                        <h4>Selectează o imagine sau mai multe și adaugă aici</h4>
                                        <p>Format: JPG, PNG. Dimensiune maximă: 6MB</p>
                                    </div>
                                    <div class='cloud-btn'>
                                        <div class='uploadImgFile'>Selectează fișier</div>
                                    </div>
                                </div>
                            </div><!--multiple-upl-img-hold-->
                            <p class='imgDisclaimer'><span>IMPORTANT!</span> Prima imagine va reprezenta imaginea de coperta. Aceasta va fi pusă automat pe fundal alb, iar ea poate fi setată din lista de mai jos.</p>
                            <div class='img-uploader-track' id='sortableImages'>
                                <!--active-upload-->



                            </div><!--img-uploader-track-->

                        </div><!--perfect-left-->
                        <div class='perfect-right'>
                            <div class='main-img-upload-preview'>
                                <img src="{{url('img/prod2.png')}}" alt="">
                            </div>
                            <div class='swiper addPRoductSlide'>
                                <div class="swiper-wrapper">

                                </div>
                            </div>
                            <div class='scrollbar-hold'>
                                <div class="swiper-scrollbar"></div>
                            </div>

                            {{-- <div class='upload-img-gallery-flex'>


                            </div> --}}
                        </div>
                    </div><!--perfect-flex-hold-->
                    <div class='separator-space'></div>
                    <div class='separator-large'></div>
                    <div class='separator-space'></div>

                    <div class="input-hold checkbox-hold">
                        <label for="gdpr">Sunt de acord cu <a href="" target="_blank">termenii și condițiile</a> și cu <a href="" target="_blank">politica de prelucrare a datelor</a>.</label>
                        <input type="checkbox" name="gdpr" id="gdpr" value="">
                        <div class="fake-check"></div>
                    </div>
                    <div class="input-hold checkbox-hold">
                        <label for="nl">Vreau să mă abonez la newsletter.</label>
                        <input type="checkbox" name="nl" id="nl" value="">
                        <div class="fake-check"></div>
                    </div>
                    <div class='separator-space'></div>
                    <div class='double-btn-hold'>
                        <input type="submit" id='addProduct' class='general-btn addprod' data-endpoint='/saveProduct' data-method='POST' data-form='addProductForm' value='Adaugă produs în shop' >
                        <div class="loader">
                            <img src="{{url('img/loader.svg')}}" alt="">
                        </div>
                        {{-- <a href="" class='general-btn black-btn'>Preview produs</a> --}}
                    </div>
                    <div class='separator-space'></div>
                </form>
            </div><!--dashboard-right-->
        </div>
    </div>

</section>

<div class='update-profile-modal'>
    <div class='modal-element'>
        <svg viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" class='close-modal'>
            <path d="M18.8242 18.8198L1 1" stroke="#909090" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M18.8242 1L1 18.8198" stroke="#909090" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        <h2>Modifcă informații profil</h2>
        <form action="" method='POST' id='updateAccountForm'>
            @csrf
            <h2>I. Informaţii generale</h2>

            <p>Activ7 Product SRL, proprietarul brandului Masara şi operatorul site-ului www.masara.ro, permite designerilor să încarce design-uri de mobilier în format digital, care vor fi produse fizic și
            vândute de Masara.</p>

                <h2>II. Înregistrare Designer</h2>

            <p>Platforma este dedicată exclusiv persoanelor juridice. Prin înregistrare, designerii acceptă
            termenii și condițiile de uzilizare.</p>

                    <h2>III. Drepturi și Obligații</h2>

            <p>Proprietate Intelectuală: Designerii garantează că design-urile sunt creații originale și dețin toate drepturile legate de acestea. Orice dispută legată de proprietate intelectuală este
            responsabilitatea designerului.</p>

            <p>Răspundere Conflictuală: În caz de litigii referitoare la autenticitatea unui produs, designerul
            este responsabil pentru rezolvarea amiabilă sau juridică a acestor dispute.</p>

            <p>Transparență în Vânzări: Designerii pot solicita rapoarte de vânzări detaliate pentru produsele
            lor.</p>

            <p>Retragerea Produselor: Designerii pot retrage produsele de la vânzare, cu excepția cazului în
            care produsul este în producție sau în proces de livrare.</p>

            <p>Litigii: Disputele legate de copierea sau furtul de proprietate intelectuală sunt rezolvate între
            designer și terța parte implicată.</p>

            <p>Modificări ale Termenilor: Masara își rezervă dreptul de a modifica termenii și condițiile fără
            notificare prealabilă.</p>

            <div class='separator-space'></div>
            <div class='double-btn-hold'>
                <div class='btn-hold'>
                    <input type="submit" value='Sunt deacord cu termenii si conditiile MASARA' class='general-btn' id='updateAccountInfos' data-endpoint='/cont-designer/editare-cont.html' data-method='POST' data-form='updateAccountForm'>
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

@section('scripts')
    <script>
        if(document.getElementsByClassName('addprod').length > 0){
            document.body.addEventListener('click', function(e) {
                if (e.target.matches('#addProduct')) {
                    e.preventDefault();
                    let modal = document.querySelector('.update-profile-modal');
                    modal.style = 'display:block;opacity:1;visibility:visible;';
                }
            });
        }
    </script>
<script src="{{ mix('js/slimselect/slimselect.min.js') }}" defer></script>
<script src="{{ mix('js/dropzone/dropzone.min.js') }}" defer></script>
<script src="{{ mix('js/sortable/sortable.min.js') }}" defer></script>
@endsection

@stop
