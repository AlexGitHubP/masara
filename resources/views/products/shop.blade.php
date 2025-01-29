@extends('inc.layout')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/slimselect/slimselect.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/slimselect/customStyles.css') }}">
@endsection

@section('content')

<section class='menu-space'></section>

<section class='designeri-section general-styles'>
    <div class='large-container'>
        <div class='breadcrumbs'>
            <ul>
                <li>
                    <a href="{{url('produse.html')}}">Shop</a>
                </li>
            </ul>
        </div>
        <h1>Shop</h1>
        <p class='width60'>Explorează toate produsele noastre, de la mese din lemn masiv până la obiecte de decor distincte, fiecare piesă reprezentând o capodoperă în eleganța naturală a lemnului.</p>
        <div class='main-listing'>
            <div class='left-list'>
                <div class='filter-infos perfect-flex-hold'>
                    <div class='perfect-left'>
                        <p><span class='totalFiltered'>@php echo $products->total() @endphp</span> produse în total</p>
                    </div>
                    <div class='perfect-center openFiltersHolder'>
                        <a class="general-btn openFilters">Deschide filtre</a>
                    </div>
                    <div class='perfect-right'>
                        <a href="" class='clearAllFilters'>Curăță filtre
                            <svg viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10.9125 16.2525C14.13 15.405 16.5 12.48 16.5 9C16.5 4.86 13.17 1.5 9 1.5C3.9975 1.5 1.5 5.67 1.5 5.67M1.5 5.67V2.25M1.5 5.67H3.0075H4.83" stroke="#A7A7A7" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M1.5 9C1.5 13.14 4.86 16.5 9 16.5" stroke="#A7A7A7" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" stroke-dasharray="3 3"/>
                            </svg>
                        </a>
                    </div>
                </div>
                <div class='input-hold sorter-hold'>
                    <label for="sorder">Sortează după:</label>
                    <select name="sorder" id="sorder" value='' class='sorder'>
                        <option value="">Alege</option>
                        <option value="scump">De la scump la ieftin</option>
                        <option value="ieftin">De la ieftin la scump</option>
                    </select>
                </div>
                <form action="" method='POST' id='filterForm'>
                    <div class="mobileFilter">
                        <svg viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" class="close-filter">
                            <path d="M18.8242 18.8198L1 1" stroke="#000000" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M18.8242 1L1 18.8198" stroke="#000000" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </div>
                    <fieldset class='filter-element' id='filter-element-type'>
                        <h3>Tip produs:</h3>
                        <div class="desktopFilter">
                            <div class='input-hold checkbox-hold search-element'>
                                <label for="masara">MASARA</label>
                                <input type="checkbox" name="product_type" id="masara" value='masara'>
                                <div class='fake-check'></div>
                            </div>
                            <div class='input-hold checkbox-hold search-element'>
                                <label for="designer">Designer</label>
                                <input type="checkbox" name="product_type" id="designer" value='designer'>
                                <div class='fake-check'></div>
                            </div>
                        </div>
                        <div class="mobileFilter">
                            <select name="product_type" id="product_type" value='' class='selectMobileFilter' multiple>
                                <option value="masara">Masara</option>
                                <option value="designer">Designer</option>
                            </select>
                        </div>
                    </fieldset><!--filter-element-->

                    <fieldset class='filter-element' id='filter-element-categories'>
                        <h3>Categorii/subcategorii</h3>
                        <div class="desktopFilter">
                            @foreach ($filterCategory as $category)
                                <div class='input-hold checkbox-hold search-element isCategory'>
                                    <label for="category_{{$category->category_url}}">{{$category->category_name}}</label>
                                    <input type="checkbox" name="categories" id="category_{{$category->category_url}}" value='{{$category->id}}'>
                                    <div class='fake-check'></div>
                                </div>
                                @foreach ($category->subcategories as $kk => $subcategory )
                                <div class="input-hold checkbox-hold search-element isSubcategory">
                                    <label for="subcategory_{{$subcategory->subcategory_url}}">{{$subcategory->subcategory_name}}</label>
                                    <input type="checkbox" {{ $subcategory->selected==true ? 'checked' : '' }} name="subcategories" id='subcategory_{{$subcategory->subcategory_url}}' value="{{$subcategory->id}}" data-parent='category_{{$category->category_url}}'>
                                    <div class='fake-check'></div>
                                </div>
                                @endforeach
                            @endforeach
                        </div>
                        <div class="mobileFilter">
                            <select name="categories" id="categories" value='' class='selectMobileFilter' multiple>
                                @foreach ($filterCategory as $key => $category )
                                    <optgroup label="{{$category->category_name}}">
                                        @foreach ($category->subcategories as $kk => $subcategory )
                                            <option value="{{$subcategory->id}}">{{$subcategory->subcategory_name}}</option>
                                        @endforeach
                                    </optgroup>
                                @endforeach
                            </select>
                        </div>

                    </fieldset><!--filter-element-->

                    <fieldset class='filter-element' id='filter-element-area'>
                        <h3>Zona:</h3>
                        <div class="desktopFilter">
                            @foreach ($filterArea as $area)
                            <div class='input-hold checkbox-hold search-element isCategory'>
                                <label for="area_{{$area->area_url}}">{{$area->area_name}}</label>
                                <input type="checkbox" name="area" id="area_{{$area->area_url}}" value='{{$area->id}}'>
                                <div class='fake-check'></div>
                            </div>
                            @endforeach
                        </div>
                        <div class="mobileFilter">
                            <select name="areas" id="areas" value='' class='selectArea' multiple>
                                <option data-placeholder="true"></option>
                                @foreach ($filterArea as $key => $area )
                                    <option value="{{$area->id}}">{{$area->area_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </fieldset><!--filter-element-->


                    @foreach ($filterAttributes as $attributeKey => $attribute )
                    <fieldset class='filter-element' id='filter-element-{{$attributeKey}}'>
                        <h3>{{ucfirst($attributeKey)}}</h3>
                        @foreach ($attribute as $atrKey => $attr)
                        <div class='groupedFilter'>
                            <p>{{ucfirst($atrKey)}}: </p>
                            <div class='multipleCheckboxHold'>
                                @foreach ($attr as $kk => $value)
                                <div class='multipleCheckbox'>
                                    <input type="checkbox" name="{{$attributeKey}}_{{$atrKey}}" id='filter_{{$attributeKey}}_{{$atrKey}}_{{$kk}}' value="{{$value}}">
                                    <label for="filter_{{$attributeKey}}_{{$atrKey}}_{{$kk}}">{{$value}}</label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endforeach
                    </fieldset>
                    @endforeach
                    <div class="mobileFilter applyFilterHold">
                    <a class="general-btn black-btn applyMobileFilters">Aplică filtre</a>
                    </div>
                </form>
            </div><!--left-list-->
            <div class='right-list'>
                <div class='filter-loader'>
                    <img src="{{url('/img/loader.svg')}}" alt="">
                </div>
                <div class='shop-list-flex' id='productScroll'>
                    @if(count($products) > 0)

                    @foreach ($products as $product)
                    <div class='product-element' data-id='{{$product->id}}' data-name='{{$product->name}}' data-main_url='{{$product->main_url}}' data-mainimg='{{$product->mainImg}}' data-price='{{$product->price}}' data-amount='1'>
                        <div class='product-item'>
                            <a href='{{$product->main_url}}' class='product-image'>
                                <picture>
                                    <source media="(max-width:770px)" srcset="{{ $product->mainImg }}">
                                    <img src="{{ $product->mainImg }}" alt="Product image">
                                </picture>
{{--                                <span class='fav-btn'>--}}
{{--                                    <svg viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                                        <circle cx="12" cy="12.3044" r="11.5" stroke="#909090"/>--}}
{{--                                        <path d="M12.372 17.9444C12.168 18.0185 11.832 18.0185 11.628 17.9444C9.888 17.3326 6 14.7803 6 10.4545C6 8.54494 7.494 7 9.336 7C10.428 7 11.394 7.54382 12 8.38427C12.606 7.54382 13.578 7 14.664 7C16.506 7 18 8.54494 18 10.4545C18 14.7803 14.112 17.3326 12.372 17.9444Z" fill="#909090" stroke="#909090" stroke-linecap="round" stroke-linejoin="round"/>--}}
{{--                                    </svg>--}}
{{--                                </span>--}}
                                <span class='new-tag'>
                                    <p>NOU!</p>
                                </span>
                            </a>
                            <div class='product-content'>
                                <div class='product-content-top'>
                                    <a href="{{$product->main_url}}">{{$product->name}}</a>
                                    <div class='product-list-price'>
                                        <p>{{$product->price}} lei</p>
                                    </div>
                                </div>
                                <div class='product-content-bottom'>
                                    <a href="" class='quickAddToCart'>Adaugă în coș</a>
                                </div>
                            </div>
                        </div>
                    </div><!--product-element-->
                    @endforeach
                    @else
                    <p>Nu există produse în shop momentan.</p>
                    @endif
                </div><!--shop-list-flex-->
                {{ $products->links() }}
            </div>
        </div>
    </div>

</section>

@section('scripts')
    <script src="{{ asset('js/slimselect/slimselect.min.js') }}" defer></script>
@endsection
@stop
