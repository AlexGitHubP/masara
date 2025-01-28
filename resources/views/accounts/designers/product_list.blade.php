@extends('inc.layout')

@section('content')

<section class='menu-space'></section>

<section class='all-categories general-styles'>
    <div class='large-container'>
        <div class='breadcrumbs'>
            <ul>
                <li>
                    <a href="{{url('produse.html')}}">Shop</a>
                </li>
                <li>
                    <a href="{{url('categorii.html')}}">Designeri</a>
                </li>
            </ul>
        </div>
        <h1>Produse designeri</h1>
        <p class='width60'>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam congue, dolor et pharetra consequat, dui enim interdum justo, vitae gravida massa est eu elit.</p>
        <div class='main-listing'>
            <div class='left-list'>
                <div class='filter-infos perfect-flex-hold'>
                    <div class='perfect-left'>
                        <p>Showing <span>1003</span> products</p>
                    </div>
                    <div class='perfect-right'>
                        <a href="">Clear filters
                            <svg viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10.9125 16.2525C14.13 15.405 16.5 12.48 16.5 9C16.5 4.86 13.17 1.5 9 1.5C3.9975 1.5 1.5 5.67 1.5 5.67M1.5 5.67V2.25M1.5 5.67H3.0075H4.83" stroke="#A7A7A7" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M1.5 9C1.5 13.14 4.86 16.5 9 16.5" stroke="#A7A7A7" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" stroke-dasharray="3 3"/>
                            </svg>                                
                        </a>
                    </div>
                </div>
                <div class='input-hold sorter-hold'>
                    <label for="sorder">Sort by</label>
                    <select name="sorder" id="sorder" value=''>
                        <option value="populare">Popular</option>
                        <option value="scump">De la scump la ieftin</option>
                        <option value="ieftin">De la ieftin la scump</option>
                    </select>
                </div>
                <form action="" method='POST' id='filterForm'>
                    <div class='filter-element'>
                        <h3>Categorie</h3>
                        <div class='input-hold checkbox-hold search-element'>
                            <label for="cat1">Categorie nume</label>
                            <input type="checkbox" name="category[]" id="cat1" value=''>
                            <div class='fake-check'></div>
                        </div>
                        <div class='input-hold checkbox-hold search-element'>
                            <label for="cat2">Categorie nume</label>
                            <input type="checkbox" name="category[]" id="cat2" value=''>
                            <div class='fake-check'></div>
                        </div>
                        <div class='input-hold checkbox-hold search-element'>
                            <label for="cat3">Categorie nume</label>
                            <input type="checkbox" name="category[]" id="cat3" value=''>
                            <div class='fake-check'></div>
                        </div>
                        <div class='input-hold checkbox-hold search-element'>
                            <label for="cat4">Categorie nume</label>
                            <input type="checkbox" name="category[]" id="cat4" value=''>
                            <div class='fake-check'></div>
                        </div>
                    </div><!--filter-element-->

                    <div class='filter-element'>
                        <h3>Material</h3>
                        <div class='input-hold checkbox-hold search-element'>
                            <label for="mat1">Material 1</label>
                            <input type="checkbox" name="material[]" id="mat1" value=''>
                            <div class='fake-check'></div>
                        </div>
                        <div class='input-hold checkbox-hold search-element'>
                            <label for="mat2">Material 2</label>
                            <input type="checkbox" name="material[]" id="mat2" value=''>
                            <div class='fake-check'></div>
                        </div>
                        <div class='input-hold checkbox-hold search-element'>
                            <label for="mat3">Material 3</label>
                            <input type="checkbox" name="material[]" id="mat3" value=''>
                            <div class='fake-check'></div>
                        </div>
                        <div class='input-hold checkbox-hold search-element'>
                            <label for="mat4">Material 4</label>
                            <input type="checkbox" name="material[]" id="mat4" value=''>
                            <div class='fake-check'></div>
                        </div>
                    </div><!--filter-element-->

                    <div class='filter-element'>
                        <h3>Colecții</h3>
                        <div class='input-hold checkbox-hold search-element'>
                            <label for="col1">Colecții 1</label>
                            <input type="checkbox" name="colectii[]" id="col1" value=''>
                            <div class='fake-check'></div>
                        </div>
                        <div class='input-hold checkbox-hold search-element'>
                            <label for="col2">Colecții 2</label>
                            <input type="checkbox" name="colectii[]" id="col2" value=''>
                            <div class='fake-check'></div>
                        </div>
                        <div class='input-hold checkbox-hold search-element'>
                            <label for="col3">Colecții 3</label>
                            <input type="checkbox" name="colectii[]" id="col3" value=''>
                            <div class='fake-check'></div>
                        </div>
                        <div class='input-hold checkbox-hold search-element'>
                            <label for="col4">Colecții 4</label>
                            <input type="checkbox" name="colectii[]" id="col4" value=''>
                            <div class='fake-check'></div>
                        </div>
                    </div><!--filter-element-->

                    <div class='filter-element'>
                        <h3>MASARA sau Designer?</h3>
                        <div class='input-hold checkbox-hold search-element'>
                            <label for="masara">MASARA</label>
                            <input type="checkbox" name="choose[]" id="masara" value=''>
                            <div class='fake-check'></div>
                        </div>
                        <div class='input-hold checkbox-hold search-element'>
                            <label for="designer">Designer</label>
                            <input type="checkbox" name="choose[]" id="designer" value=''>
                            <div class='fake-check'></div>
                        </div>
                    </div><!--filter-element-->
                </form>
            </div><!--left-list-->
            <div class='left-right'>
                <div class='shop-list-flex'>

                    <div class='product-element'>
                        <div class='product-item'>
                            <a href='{{url('produse/mese/')}}' class='product-image'>
                                <picture>
                                    <source media="(max-width:770px)" srcset="{{url('img/prod1.png')}}">
                                    <img src="{{url('img/prod1.png')}}" alt="Product image">
                                </picture>
                                <span class='fav-btn'>
                                    <svg viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="12" cy="12.3044" r="11.5" stroke="#909090"/>
                                        <path d="M12.372 17.9444C12.168 18.0185 11.832 18.0185 11.628 17.9444C9.888 17.3326 6 14.7803 6 10.4545C6 8.54494 7.494 7 9.336 7C10.428 7 11.394 7.54382 12 8.38427C12.606 7.54382 13.578 7 14.664 7C16.506 7 18 8.54494 18 10.4545C18 14.7803 14.112 17.3326 12.372 17.9444Z" fill="#909090" stroke="#909090" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>                                
                                </span>
                                <span class='new-tag'>
                                    <p>NOU!</p>                      
                                </span>
                            </a>
                            <div class='product-content'>
                                <div class='product-content-top'>
                                    <a href="">Leick Solid Ash Mission Console Table</a>
                                    <div class='product-list-price'>
                                        <p>3.826 lei</p>
                                    </div>
                                </div>
                                <div class='product-content-bottom'>
                                    <a href="">Adaugă în coș</a>
                                </div>
                            </div>
                        </div>
                    </div><!--product-element-->

                    <div class='product-element'>
                        <div class='product-item'>
                            <a href='' class='product-image'>
                                <picture>
                                    <source media="(max-width:770px)" srcset="{{url('img/prod1.png')}}">
                                    <img src="{{url('img/prod1.png')}}" alt="Product image">
                                </picture>
                                <span class='fav-btn'>
                                    <svg viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="12" cy="12.3044" r="11.5" stroke="#909090"/>
                                        <path d="M12.372 17.9444C12.168 18.0185 11.832 18.0185 11.628 17.9444C9.888 17.3326 6 14.7803 6 10.4545C6 8.54494 7.494 7 9.336 7C10.428 7 11.394 7.54382 12 8.38427C12.606 7.54382 13.578 7 14.664 7C16.506 7 18 8.54494 18 10.4545C18 14.7803 14.112 17.3326 12.372 17.9444Z" fill="#909090" stroke="#909090" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>                                
                                </span>
                                <span class='new-tag'>
                                    <p>NOU!</p>                      
                                </span>
                            </a>
                            <div class='product-content'>
                                <div class='product-content-top'>
                                    <a href="">Leick Solid Ash Mission Console Table</a>
                                    <div class='product-list-price'>
                                        <p>3.826 lei</p>
                                    </div>
                                </div>
                                <div class='product-content-bottom'>
                                    <a href="">Adaugă în coș</a>
                                </div>
                            </div>
                        </div>
                    </div><!--product-element-->

                    <div class='product-element'>
                        <div class='product-item'>
                            <a href='' class='product-image'>
                                <picture>
                                    <source media="(max-width:770px)" srcset="{{url('img/prod1.png')}}">
                                    <img src="{{url('img/prod1.png')}}" alt="Product image">
                                </picture>
                                <span class='fav-btn'>
                                    <svg viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="12" cy="12.3044" r="11.5" stroke="#909090"/>
                                        <path d="M12.372 17.9444C12.168 18.0185 11.832 18.0185 11.628 17.9444C9.888 17.3326 6 14.7803 6 10.4545C6 8.54494 7.494 7 9.336 7C10.428 7 11.394 7.54382 12 8.38427C12.606 7.54382 13.578 7 14.664 7C16.506 7 18 8.54494 18 10.4545C18 14.7803 14.112 17.3326 12.372 17.9444Z" fill="#909090" stroke="#909090" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>                                
                                </span>
                                <span class='new-tag'>
                                    <p>NOU!</p>                      
                                </span>
                            </a>
                            <div class='product-content'>
                                <div class='product-content-top'>
                                    <a href="">Leick Solid Ash Mission Console Table</a>
                                    <div class='product-list-price'>
                                        <p>3.826 lei</p>
                                    </div>
                                </div>
                                <div class='product-content-bottom'>
                                    <a href="">Adaugă în coș</a>
                                </div>
                            </div>
                        </div>
                    </div><!--product-element-->

                    <div class='product-element'>
                        <div class='product-item'>
                            <a href='' class='product-image'>
                                <picture>
                                    <source media="(max-width:770px)" srcset="{{url('img/prod1.png')}}">
                                    <img src="{{url('img/prod1.png')}}" alt="Product image">
                                </picture>
                                <span class='fav-btn'>
                                    <svg viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="12" cy="12.3044" r="11.5" stroke="#909090"/>
                                        <path d="M12.372 17.9444C12.168 18.0185 11.832 18.0185 11.628 17.9444C9.888 17.3326 6 14.7803 6 10.4545C6 8.54494 7.494 7 9.336 7C10.428 7 11.394 7.54382 12 8.38427C12.606 7.54382 13.578 7 14.664 7C16.506 7 18 8.54494 18 10.4545C18 14.7803 14.112 17.3326 12.372 17.9444Z" fill="#909090" stroke="#909090" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>                                
                                </span>
                                <span class='new-tag'>
                                    <p>NOU!</p>                      
                                </span>
                            </a>
                            <div class='product-content'>
                                <div class='product-content-top'>
                                    <a href="">Leick Solid Ash Mission Console Table</a>
                                    <div class='product-list-price'>
                                        <p>3.826 lei</p>
                                    </div>
                                </div>
                                <div class='product-content-bottom'>
                                    <a href="">Adaugă în coș</a>
                                </div>
                            </div>
                        </div>
                    </div><!--product-element-->

                    <div class='product-element'>
                        <div class='product-item'>
                            <a href='' class='product-image'>
                                <picture>
                                    <source media="(max-width:770px)" srcset="{{url('img/prod1.png')}}">
                                    <img src="{{url('img/prod1.png')}}" alt="Product image">
                                </picture>
                                <span class='fav-btn'>
                                    <svg viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="12" cy="12.3044" r="11.5" stroke="#909090"/>
                                        <path d="M12.372 17.9444C12.168 18.0185 11.832 18.0185 11.628 17.9444C9.888 17.3326 6 14.7803 6 10.4545C6 8.54494 7.494 7 9.336 7C10.428 7 11.394 7.54382 12 8.38427C12.606 7.54382 13.578 7 14.664 7C16.506 7 18 8.54494 18 10.4545C18 14.7803 14.112 17.3326 12.372 17.9444Z" fill="#909090" stroke="#909090" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>                                
                                </span>
                                <span class='new-tag'>
                                    <p>NOU!</p>                      
                                </span>
                            </a>
                            <div class='product-content'>
                                <div class='product-content-top'>
                                    <a href="">Leick Solid Ash Mission Console Table</a>
                                    <div class='product-list-price'>
                                        <p>3.826 lei</p>
                                    </div>
                                </div>
                                <div class='product-content-bottom'>
                                    <a href="">Adaugă în coș</a>
                                </div>
                            </div>
                        </div>
                    </div><!--product-element-->

                    <div class='product-element'>
                        <div class='product-item'>
                            <a href='' class='product-image'>
                                <picture>
                                    <source media="(max-width:770px)" srcset="{{url('img/prod1.png')}}">
                                    <img src="{{url('img/prod1.png')}}" alt="Product image">
                                </picture>
                                <span class='fav-btn'>
                                    <svg viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="12" cy="12.3044" r="11.5" stroke="#909090"/>
                                        <path d="M12.372 17.9444C12.168 18.0185 11.832 18.0185 11.628 17.9444C9.888 17.3326 6 14.7803 6 10.4545C6 8.54494 7.494 7 9.336 7C10.428 7 11.394 7.54382 12 8.38427C12.606 7.54382 13.578 7 14.664 7C16.506 7 18 8.54494 18 10.4545C18 14.7803 14.112 17.3326 12.372 17.9444Z" fill="#909090" stroke="#909090" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>                                
                                </span>
                                <span class='new-tag'>
                                    <p>NOU!</p>                      
                                </span>
                            </a>
                            <div class='product-content'>
                                <div class='product-content-top'>
                                    <a href="">Leick Solid Ash Mission Console Table</a>
                                    <div class='product-list-price'>
                                        <p>3.826 lei</p>
                                    </div>
                                </div>
                                <div class='product-content-bottom'>
                                    <a href="">Adaugă în coș</a>
                                </div>
                            </div>
                        </div>
                    </div><!--product-element-->

                    <div class='product-element'>
                        <div class='product-item'>
                            <a href='' class='product-image'>
                                <picture>
                                    <source media="(max-width:770px)" srcset="{{url('img/prod1.png')}}">
                                    <img src="{{url('img/prod1.png')}}" alt="Product image">
                                </picture>
                                <span class='fav-btn'>
                                    <svg viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="12" cy="12.3044" r="11.5" stroke="#909090"/>
                                        <path d="M12.372 17.9444C12.168 18.0185 11.832 18.0185 11.628 17.9444C9.888 17.3326 6 14.7803 6 10.4545C6 8.54494 7.494 7 9.336 7C10.428 7 11.394 7.54382 12 8.38427C12.606 7.54382 13.578 7 14.664 7C16.506 7 18 8.54494 18 10.4545C18 14.7803 14.112 17.3326 12.372 17.9444Z" fill="#909090" stroke="#909090" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>                                
                                </span>
                                <span class='new-tag'>
                                    <p>NOU!</p>                      
                                </span>
                            </a>
                            <div class='product-content'>
                                <div class='product-content-top'>
                                    <a href="">Leick Solid Ash Mission Console Table</a>
                                    <div class='product-list-price'>
                                        <p>3.826 lei</p>
                                    </div>
                                </div>
                                <div class='product-content-bottom'>
                                    <a href="">Adaugă în coș</a>
                                </div>
                            </div>
                        </div>
                    </div><!--product-element-->

                    <div class='product-element'>
                        <div class='product-item'>
                            <a href='' class='product-image'>
                                <picture>
                                    <source media="(max-width:770px)" srcset="{{url('img/prod1.png')}}">
                                    <img src="{{url('img/prod1.png')}}" alt="Product image">
                                </picture>
                                <span class='fav-btn'>
                                    <svg viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="12" cy="12.3044" r="11.5" stroke="#909090"/>
                                        <path d="M12.372 17.9444C12.168 18.0185 11.832 18.0185 11.628 17.9444C9.888 17.3326 6 14.7803 6 10.4545C6 8.54494 7.494 7 9.336 7C10.428 7 11.394 7.54382 12 8.38427C12.606 7.54382 13.578 7 14.664 7C16.506 7 18 8.54494 18 10.4545C18 14.7803 14.112 17.3326 12.372 17.9444Z" fill="#909090" stroke="#909090" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>                                
                                </span>
                                <span class='new-tag'>
                                    <p>NOU!</p>                      
                                </span>
                            </a>
                            <div class='product-content'>
                                <div class='product-content-top'>
                                    <a href="">Leick Solid Ash Mission Console Table</a>
                                    <div class='product-list-price'>
                                        <p>3.826 lei</p>
                                    </div>
                                </div>
                                <div class='product-content-bottom'>
                                    <a href="">Adaugă în coș</a>
                                </div>
                            </div>
                        </div>
                    </div><!--product-element-->

                    <div class='product-element'>
                        <div class='product-item'>
                            <a href='' class='product-image'>
                                <picture>
                                    <source media="(max-width:770px)" srcset="{{url('img/prod1.png')}}">
                                    <img src="{{url('img/prod1.png')}}" alt="Product image">
                                </picture>
                                <span class='fav-btn'>
                                    <svg viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="12" cy="12.3044" r="11.5" stroke="#909090"/>
                                        <path d="M12.372 17.9444C12.168 18.0185 11.832 18.0185 11.628 17.9444C9.888 17.3326 6 14.7803 6 10.4545C6 8.54494 7.494 7 9.336 7C10.428 7 11.394 7.54382 12 8.38427C12.606 7.54382 13.578 7 14.664 7C16.506 7 18 8.54494 18 10.4545C18 14.7803 14.112 17.3326 12.372 17.9444Z" fill="#909090" stroke="#909090" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>                                
                                </span>
                                <span class='new-tag'>
                                    <p>NOU!</p>                      
                                </span>
                            </a>
                            <div class='product-content'>
                                <div class='product-content-top'>
                                    <a href="">Leick Solid Ash Mission Console Table</a>
                                    <div class='product-list-price'>
                                        <p>3.826 lei</p>
                                    </div>
                                </div>
                                <div class='product-content-bottom'>
                                    <a href="">Adaugă în coș</a>
                                </div>
                            </div>
                        </div>
                    </div><!--product-element-->

                    
                </div><!--shop-list-flex-->
                <div class='pagination-hold'>
                    <ul>
                        <li>
                            <a href="" class='prevPage'>
                                <svg viewBox="0 0 9 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M7.99984 16.92L1.47984 10.4C0.709844 9.62996 0.709844 8.36996 1.47984 7.59996L7.99984 1.07996" stroke="black" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </a>
                        </li>
                        <li>
                            <a href="">1</a>
                        </li>
                        <li>
                            <a href="">2</a>
                        </li>
                        <li>
                            <a href="">3</a>
                        </li>
                        <li>
                            <a href="">4</a>
                        </li>
                        <li>
                            <a href="">5</a>
                        </li>
                        <li>
                            <a href="">...</a>
                        </li>
                        <li>
                            <a href="">25</a>
                        </li>
                        <li>
                            <a href="" class='nextPage'>
                                <svg viewBox="0 0 9 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1.00016 1.08004L7.52016 7.60004C8.29016 8.37004 8.29016 9.63004 7.52016 10.4L1.00016 16.92" stroke="black" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>                                    
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

</section>
@stop 