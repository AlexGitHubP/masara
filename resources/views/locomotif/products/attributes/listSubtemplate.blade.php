
<h3>Produsul este compus din:</h3>
@if ($productsAttributes>0)
	@foreach ($productsAttributes as $key => $attributesValue )
	<div class='attr_values_group gID{{$key}}'>
		<p class='displayBlock'>{{strtoupper($key)}}:</p>
		@if (count($attributesValue)>0)
			@foreach ( $attributesValue as $k => $attribute )
				<div class='attr_group'>
					<p>{{ucfirst($k)}}:</p>
					@if (count($attribute)>0)
						<ul class='attr_meta'>
							<li data-id="{{$attribute[1]}}">{{$attribute[0]}}<span>X</span></li>
						</ul>
					@endif
				</div>
			@endforeach
			
		@endif
	</div>
	@endforeach	
@else
<p>Nu exista elemente asociate.</p>
@endif
<div class='dynamicParent'></div>