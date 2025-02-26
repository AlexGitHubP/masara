@extends('admin::inc/header')
@section('title', 'Editează zonă')
@include('admin::inc/generalErrors')

@section('content')
<div class='details-bar'><!--details-bar-->
	<div class='details-left'>
		<h2>Editează: {{ \Illuminate\Support\Str::limit($item->category_name, $limit = 15, $end = '...') }} </h2>
	</div>
	<div class='details-center'>
		<ul class='details-nav nav-tabs'>
			<li class='detail-selected'>
				<a href="" data-target="detalii">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 13.1 16">
						<path id="Text-2" data-name="Text" d="M5.2,2H11a.75.75,0,0,1,.53.22l4.35,4.35a.75.75,0,0,1,.22.53v8.7A2.222,2.222,0,0,1,13.9,18H5.2A2.222,2.222,0,0,1,3,15.8V4.2A2.222,2.222,0,0,1,5.2,2Zm0,1.5a.721.721,0,0,0-.7.7V15.8a.721.721,0,0,0,.7.7h8.7a.721.721,0,0,0,.7-.7V7.85H11a.75.75,0,0,1-.75-.75V3.5Zm6.55,1.061L13.539,6.35H11.75ZM5.9,7.825a.75.75,0,0,1,.75-.75H8.1a.75.75,0,0,1,0,1.5H6.65A.75.75,0,0,1,5.9,7.825Zm.75,2.15a.75.75,0,1,0,0,1.5h5.8a.75.75,0,1,0,0-1.5Zm0,2.9a.75.75,0,0,0,0,1.5h5.8a.75.75,0,0,0,0-1.5Z" transform="translate(-3 -2)" fill="#6C7A87" fill-rule="evenodd"/>
					</svg> 
					Detalii
				</a>
			</li>
            <li>
				<a href="" data-target="imagini">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16">
						<path id="Image" d="M4.361,3.5a.861.861,0,0,0-.861.861V15.639a.861.861,0,0,0,.593.818l8.6-8.6a.75.75,0,0,1,1.061,0L16.5,10.606V4.361a.861.861,0,0,0-.861-.861ZM16.5,12.727,13.222,9.45,6.172,16.5h9.467a.861.861,0,0,0,.861-.861ZM2,4.361A2.361,2.361,0,0,1,4.361,2H15.639A2.361,2.361,0,0,1,18,4.361V15.639A2.361,2.361,0,0,1,15.639,18H4.361A2.361,2.361,0,0,1,2,15.639ZM7.181,6.722a.458.458,0,1,0,.458.458A.458.458,0,0,0,7.181,6.722Zm-1.958.458A1.958,1.958,0,1,1,7.181,9.139,1.958,1.958,0,0,1,5.222,7.181Z" transform="translate(-2 -2)" fill="#6C7A87" fill-rule="evenodd"/>
					</svg>					  
					Imagini
				</a>
			</li>
		</ul>	
	</div>
	<div class='details-right'>
		<a class='general-btn backBtn' href="/admin/productsArea">Înapoi</a>	
	</div>
</div><!--details-bar-->

<div class="content-container">
    <div class="cms-body">
        <div class="tab-content">
			<div class="tab-pane active" id="detalii">
                <form method="POST" action='/admin/productsArea/{{$item->id}}'>
                    @csrf
                    @method('PUT')
                    
                    <div class='flex-inputs flex100'>
                        <div class="input-element">
                            <label for="area_name">Nume Zonă</label>
                            <input class='builNiceUrl' data-target='area_url' type="text" name="area_name" id='area_name' value="{{$item->area_name}}">
                        </div>
                        <div class="input-element">
                            <label for="category_url">Url zonă</label>
                            <input type="text" name="area_url" id='area_url' value="{{$item->area_url}}">
                        </div>
                        <div class="input-element">
                            <label for="category_status">Status</label>
                            <select name='status' id='status' value="{{$item->status}}">
                                <option value="">Alege status</option>
                                <option value="published" {{$item->status=='published' ? 'selected' : '' }}>Publicat</option>
								<option value="hidden"    {{$item->status=='hidden' ? 'selected' : '' }}>Ascuns</option>
                            </select>
                        </div>
                        
                    </div>
                    <input class="general-btn" type="submit" value="Update">
                </form>
            </div>
            <div class="tab-pane" id="imagini">
				<h2>Imagini:</h2>
                {!! $associatedMedia !!}
			</div>
        </div><!--tab-content-->
	</div>
</div>


@endsection
