//Tooltip on hover
$("[data-toggle='tooltip']").tooltip();

// Makes tooltips work on ajax generated content
$(document).ajaxStop(function () {
	$("[data-toggle='tooltip']").tooltip();
});

$(document).ready(function () {
	let list = $('#list-view');
	let grid = $('#grid-view');

	list.click(function () {
		list.addClass('active');
		$('.product-block').removeClass('col-sm-4');
		grid.removeClass('active');
	});

	grid.click(function () {
		grid.addClass('active');
		$('.product-block').addClass('col-sm-4');
		list.removeClass('active');
	});
});
