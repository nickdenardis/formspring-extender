$(document).ready(function(){
	$('nav#primary .logout').click(function(){
		if (confirm("Are you sure you want to logout?")){
			return true;
		};
		return false;
	});
});