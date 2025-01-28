
<form id='addAreasToProduct' method="POST" action='' class='spaced-form'>
    @csrf
    <input type="hidden" name="pid" id='pid' value='{{$product_id}}'>
    
    @foreach ($list as $key => $area )
        <div class='subcategoryHold'>
            <div class="input-element checkbox-input">
                <label for="area_{{$area->area_url}}">{{$area->area_name}}</label>
                <input type="checkbox" {{ $area->selected==true ? 'checked' : '' }} name="areas[]" id='area_{{$area->area_url}}' value="{{$area->id}}">
                <div class='fakecheck'></div>
            </div>
        </div>
    @endforeach
    
    <input data-tableName='' data-formID='addAreasToProduct' data-submitUrl='/admin/productsArea/addAreasToProducts' class='general-btn ajaxSubmit' type="submit" value="Asociază zonele">
</form>
    