
    <h2>Adaugă valoare nouă</h2>
	<form method="POST" action='/admin/productsAttributesValues/'>
		@csrf
		<input type="hidden" name='attr_id' id='attr_id' value='{{$attr_id}}'>
		<input type="hidden" name='attr_value_identifier' id='attr_value_identifier' value=''>
		<input type="hidden" name='attr_value_status' id='attr_value_status' value='published'>
		
		<div class='flex-inputs flex100'>
			<div class="input-element">
				<label for="attr_value_name">Nume:</label>
				<input class='buildAttributeIdentifier' data-target='attr_value_identifier' type="text" name="attr_value_name" id='attr_value_name' value="" placeholder="Ex: Culoare, Înălțime">
			</div>
			
			<div class="input-element">
				<label for="attr_value">Valoare/Valori:</label>
				<input class='tagElement' type="text" name="attr_value" id='attr_value' value="" placeholder="Ex: mov, 20">
			</div>
			
		</div>
		<input class='general-btn' type="submit" value="Adaugă valorile pentru acest atribut">
	</form>

