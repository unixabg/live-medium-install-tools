$(document).ready(function() {
	$('#select_all').click(function() {
		if (this.checked) {
			$('.checkbox1').each(function() {
				this.checked = true;
			});
		} else {
			$('.checkbox1').each(function() {
				this.checked = false;
			});
		}
	});
});
