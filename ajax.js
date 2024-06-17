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
	$('.cat-list-item').on('click', function() {
		$('.cat-list-item').removeClass('active');
		$(this).addClass('active');

		$.ajax({
			type: 'POST',
			url: '/wp-admin/admin-ajax.php',
			dataType: 'html',
			data: {
				action: 'filter_projects',
				category: $(this).data('slug'),
				type: $(this).data('type'),
			},
			success: function(res) {
				$('.project-container').html(res);
				console.warn(res);
			},
			error: function(result){
				console.warn(result);
			}
		});
	});
});