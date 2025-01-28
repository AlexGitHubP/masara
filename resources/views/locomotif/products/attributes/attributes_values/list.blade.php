

<div class='right-panel-elements-separator'>
@if ($attr_values>0)
	@foreach ($attr_values as $key => $attributesValue )
	<div class='attr_values_group'>
		<p>{{$key}}:</p>
		@if (count($attributesValue)>0)
			<ul class='attr_list'>
			@foreach ($attributesValue as $kk => $vv )
				<li data-id="{{$vv[1]}}"> {{$vv[0]}}<span>X</span></li>
			@endforeach
			</ul>
		@endif
	</div>
	@endforeach	
@else
<p>Nu exista valori asociate.</p>
@endif

</div>