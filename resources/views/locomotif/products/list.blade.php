@extends('admin::inc/header')
@section('title', 'Products list')

@section('content')
<div class="content-container">
	<div class="cms-body">
		<p>this is products listingsssssss</p>
		<a href="/admin/products/create">Add new producsssssdadasdasdt</a>
		@foreach($products as $product)
			<p>Product: {{ $product->name }} <a href="/admin/products/{{$product->id}}/edit">Edit product</a> <form action="/admin/products/{{ $product->id }}" method="POST">@method('DELETE') @csrf <input type="submit" value="Delete product"/></form></p>
		@endforeach
    	</div>
</div>

@endsection

