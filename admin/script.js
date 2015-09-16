function autocomplet() {
	var min_length = 0; // min caracters to display the autocomplete
	var quality = $('#country_id').val();
	if (quality.length >= min_length) {
		$.ajax({
			url: 'ajex_refresh.php',
			type: 'POST',
			data: {quality:quality},
			success:function(data){
				$('#country_list_id').show();
				$('#country_list_id').html(data);
			}
		});
	} else {
		$('#country_list_id').hide();
	}
}
 
// set_item : this function will be executed when we select an item
function set_item(item) {
	// change input value
	$('#country_id').val(item);
	// hide proposition list
	$('#country_list_id').hide();
}