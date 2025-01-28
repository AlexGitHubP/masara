@extends('admin::inc/header')
@section('title', 'Product Attribute detail')


@section('content')
<div class="content-container">
    <div class="cms-body">
		<p>Product Attribute detail</p>
		<p>Attribute Name is: {{ $productsAttributes->attr_name }}</p>
        <p>status is: {{ $productsAttributes->attr_status }}</p>
        <a href="/admin/productsAttributes">Go back</a>
	</div>
</div>
@endsection
