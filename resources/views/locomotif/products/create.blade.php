@extends('admin::inc/header')
@section('title', 'Add product')
@include('admin::inc/generalErrors')

@section('content')
<div class="content-container">
    <div class="cms-body">
		
		<a href="/admin/products"><--- Înapoi</a>
		<p>Create a new product</p>
		<form method="POST" action=/admin/products>
			@csrf

			<div class="field-group">
				<label for="name">Product name</label>
				<input type="text" name="name" id='name' value="">
			</div>
			<div class="field-group">
				<label for="url">Product url</label>
				<input type="text" name="url" id='url' value="">
			</div>
			<div class="field-group">
				<label for="designer_id">Designer</label>
				<select name='designer_id' id='designer_id'>
					<option value="0">Alege designer</option>
					<option value="1">Masara</option>
					<option value="2">Alt designer</option>
				</select>
			</div>
			<div class="field-group">
				<label for="product_type">Tip produs</label>
				<select name='product_type' id='product_type'>
					<option value="">Alege tipul</option>
					<option value="designer">Designer</option>
					<option value="simple">Simplu/de sine statator</option>
				</select>
			</div>
			<div class="field-group">
				<label for="sku">SKU</label>
				<input type="text" name="sku" id='sku' value="">
			</div>
			<div class="field-group">
				<label for="stock">Stoc</label>
				<input type="text" name="stock" id='stock' value="">
			</div>
			<div class="field-group">
				<label for="price">Preț</label>
				<input type="text" name="price" id='price' value="">
			</div>
			<div class="field-group">
				<label for="price_estimate">Preț estimat de designer</label>
				<input type="text" name="price_estimate" id='price_estimate' value="">
			</div>
			<div class="field-group">
				<label for="description">Descriere produs</label>
				<textarea name="description" id="description"></textarea>
			</div>
			<div class="field-group">
				<label for="technical_specs">Descriere tehnica produs</label>
				<textarea name="technical_specs" id="technical_specs"></textarea>
			</div>
			<div class="field-group">
				<label for="technical_file">Încarcă fișă tehnică</label>
				<input type="file" name="technical_file" id="technical_file">
			</div>
			<div class="field-group">
				<label for="product_area">Zona produs</label>
				<select name='product_area' id='product_area'>
					<option value="">Alege zona produsului</option>
					<option value="bucatarie">Bucătărie</option>
					<option value="balcon">Balcon</option>
				</select>
			</div>
			<div class="field-group">
				<label for="rand_3d">Are randare 3d?</label>
				<input type="checkbox" name="rand_3d" id='rand_3d' value="1">
			</div>
			<div class="field-group">
				<label for="favourite_product">Este setat ca si produs favorit?</label>
				<input type="checkbox" name="favourite_product" id='favourite_product' value="0">
			</div>
			<div class="field-group">
				<label for="product_status">Status produs</label>
				<select name='product_status' id='product_status'>
					<option value="pending">În așteptare</option>
					<option value="in_review">În review</option>
					<option value="hidden">Ascuns</option>
					<option value="published">Publicat</option>
				</select>
			</div>
			<input type="submit" value="Creează produs">
		</form>
	</div>
</div>
@endsection
