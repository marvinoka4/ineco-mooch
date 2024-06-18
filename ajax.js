var ppp = 6; // Projects Per Page
var pageNumber = 1;

function loadMoreProjects() {
	pageNumber++;
	var str = '&pageNumber=' + pageNumber + '&ppp=' + ppp + '&action=ajaxMoreProjects';
	$.ajax({
		type: "POST",
		dataType: "html",
		url: ajax_projects.ajaxurl,
		data: str,
		success: function(data) {
			var $data = $(data);
			if($data.length) {
				$("#projects").append($data);
				$data.hide();
				$data.fadeIn();
				$("#load-more-projects").attr("loading", false);
			} else {
				$("#load-more-projects").attr("loading", false);
				$("#load-more-projects").attr("complete", true);
			}
		},
		error : function(jqXHR, textStatus, errorThrown) {
			$loader.html(jqXHR + " :: " + textStatus + " :: " + errorThrown);
		}

	});
	return false;
}

$(document).ready(function() {
	$('.cat-list-item').on('click', function(event) {
		(event).preventDefault();
		$('.cat-list-item').removeClass('active');
		$(this).addClass('active');

		var category =$(this).data('category');

		$.ajax({
			type: "POST",
			dataType: "html",
			url:  ajax_projects.ajaxurl,
			data: {
				action: 'filter_projects',
				type: $(this).data('type'),
				category: $(this).data('category'),
			},
			success: function(res) {
				$('#projects').html(res);
			},
			error: function(result){
				console.warn(result);
			}
		});
	});
});