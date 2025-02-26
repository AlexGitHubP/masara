@extends('admin::inc/header')
@section('title', 'Editează articol blog')
@include('admin::inc/generalErrors')

@section('content')
<div class='details-bar'><!--details-bar-->
	<div class='details-left'>
		<h2>Editează: {{ \Illuminate\Support\Str::limit($item->name, $limit = 15, $end = '...') }} </h2>
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
				<a href="" data-target="categorii">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16">
						<path d="M9.665,2.079a.75.75,0,0,1,.671,0L17.585,5.7a.75.75,0,0,1,0,1.342l-7.25,3.625a.75.75,0,0,1-.671,0L2.415,7.046a.75.75,0,0,1,0-1.342Zm-5.238,4.3L10,9.161l5.573-2.786L10,3.589ZM2.079,13.29a.75.75,0,0,1,1.006-.335L10,16.412l6.915-3.457a.75.75,0,0,1,.671,1.342l-7.25,3.625a.75.75,0,0,1-.671,0L2.415,14.3A.75.75,0,0,1,2.079,13.29Zm1.006-3.96a.75.75,0,0,0-.671,1.342L9.665,14.3a.75.75,0,0,0,.671,0l7.25-3.625a.75.75,0,0,0-.671-1.342L10,12.787Z" transform="translate(-2 -2)" fill="#6C7A87" fill-rule="evenodd"/>
					  </svg>											
					Categorii
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
        <ul class='action-controls'>
			<li>
				<a class='general-btn backBtn' href="/admin/blog">Înapoi</a>
			</li>
			<li>
				<a href="/admin/blog/create" class='iconControl'>
					<span>
						<svg id="Plus" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 12 12">
							<path id="Plus-2" data-name="Plus" d="M11,5A1,1,0,0,0,9,5V9H5a1,1,0,0,0,0,2H9v4a1,1,0,0,0,2,0V11h4a1,1,0,0,0,0-2H11Z" transform="translate(-4 -4)" fill="#ffffff" fill-rule="evenodd"/>
						  </svg>											
					</span>
				</a>
			</li>
		</ul>	
	</div>
</div><!--details-bar-->

<div class="content-container">
    <div class="cms-body">
        <div class="tab-content">
			<div class="tab-pane active" id="detalii">
                <form method="POST" action='/admin/blog/{{$item->id}}'>
                    @csrf
                    @method('PUT')
                    
                    <div class='flex-inputs flex100'>
                        <div class="input-element">
                            <label for="name">Nume categorie</label>
                            <input class='builNiceUrl' data-target='url' type="text" name="name" id='name' value="{{$item->name}}">
                        </div>
                        <div class="input-element">
                            <label for="url">Url</label>
                            <input type="text" name="url" id='url' value="{{$item->url}}">
                        </div>
						<div class="input-element textarea">
                            <label for="short_description">Descriere scurtă</label>
                            <textarea class='initTinyMce' name="short_description" id="short_description" value='{{$item->short_description}}'>{{$item->short_description}}</textarea>
                        </div>
                        <div class="input-element textarea">
                            <label for="description">Descriere</label>
                            <textarea name="description" id="description" value='{{$item->description}}'>{{$item->description}}</textarea>
                        </div>
						
                        <div class="input-element">
                            <label for="status">Status</label>
                            <select name='status' id='status' value="{{$item->status}}">
                                <option value="">Alege status</option>
                                <option value="published"  {{$item->status=='published' ? 'selected' : '' }}>Publicat</option>
								<option value="hidden"     {{$item->status=='hidden' ? 'selected' : '' }}>Ascuns</option>
								<option value="pending"    {{$item->status=='pending' ? 'selected' : '' }}>În așteptare</option>
                            </select>
                        </div>
                        
                    </div>
                    <input class="general-btn" type="submit" value="Update">
                </form>
            </div>
			<div class="tab-pane" id="categorii">
				{!! $associatedCategories !!}
			</div>	
            <div class="tab-pane" id="imagini">
				<h2>Imagini:</h2>
                {!! $associatedMedia !!}
			</div>
        </div><!--tab-content-->
	</div>
</div>


@endsection
