$(document).ready(function() {
	$(".new_script_button").click(function() {
		$("#add_script").show();
		return false;
	});
	$(".cancel").click(function() {
		$("#add_script").hide();
	});
});
