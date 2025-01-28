
<form id='addProductsMetasForm' method="POST" action='/admin/productsMeta/' class='spaced-form'>
    @csrf
    <input type="hidden" name="pid" id='pid' value='{{$product_id}}'>
    <input type="hidden" name="meta_name" id='meta_name' value=''>
    <input type="hidden" name="meta_owner" id='meta_owner' value='product'>
    <input type="hidden" name="meta_key" id='meta_key' value=''>
    <input type="hidden" name="meta_attribute" id='meta_attribute' value=''>
    
    
    <div class="input-element">
        <label for="product_type">Construieste produsul din:</label>
        <select name='attr_type_select' id='attr_type_select' value=''>
            <option value="">Alege element:</option>
            @foreach ($productsAttributes as $productsAttribute )
                <option data-id="{{$productsAttribute->attr_identifier}}" value="{{$productsAttribute->id}}">{{$productsAttribute->attr_name}}</option>
            @endforeach
            
        </select>
    </div>
    <div class="constructAttrSelectors"></div>
    <div class="attrSelectors"></div>
    <input data-tableName='products_metas' data-formID='addProductsMetasForm' data-submitUrl='/admin/productsMeta/storeAjax' class='general-btn ajaxSubmit' type="submit" value="Asociază elemente">
</form>
    