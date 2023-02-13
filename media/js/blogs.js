var Comment = {
	GLOBAL: {},

	CONSTS: {},

	SELECTORS: {
		comment_contain: 	"#comments .comment-contain",
		comment_form:		"form.comment-form",
		comment: 			"textarea#message",
		comment_button:		"div button.comment-btn",
		like_button: 		".media ul .like-btn",
		reply_button: 		".media ul .reply-btn",
	},

	init: function () {
		Comment.addComment();
		Comment.like();
	},

	addComment: function () {
		$(Comment.SELECTORS.comment_form).on("click", Comment.SELECTORS.comment_button, function (event) {
			event.stopPropagation();
			tc = $(this);
			
			//var cf = confirm("Are you sure!");
			// host = 'http://' + window.location.host;
			//if (cf == true) {
				url = tc.attr("alt");
				
				$.ajax({
					url: url,
					type: "POST",
					data: {
						content: $(Comment.SELECTORS.comment).val(),
					},
					dataType: "json",
				})
					.done(function (data) {
						imgURL = "media/upload/users/" + auth_img;
						let html = `<div class="media d-flex flex-row">\
										<a class="pull-left" href="#"><img class="w-75 rounded-circle" src="${imgURL}" alt=""></a>\
										<div class="media-body flex-grow-1">\
											<h4 class="media-heading">${auth_name}</h4>\
											<p>  ${data.comment_content} </p>\
											<div class="d-flex flex-row justify-content-between">\
												<ul class="list-unstyled list-inline media-detail d-flex">\
													<li><i class="fa fa-calendar"></i>${data.created}</li>\
													<li><i class="fa fa-thumbs-up"></i>${data.like_count}</li>\
												</ul>\
												<ul class="list-unstyled list-inline media-detail d-flex">\
													<li class="like-btn"><a href="">Like</a></li>\
													<li class="reply-btn"><a href="">Reply</a></li>\
												</ul>\
											</div>\
										</div>\
									</div>`;
						$(Comment.SELECTORS.comment_contain).append(html);
					})

					.fail(function (xhr, status, errorThrown) {
						alert("Sorry, there was a problem!");
						console.log("Error: " + errorThrown);
						console.log("Status: " + status);
						console.dir(xhr);
					});
					return false;
			//}	
		});
	},

	like: function() {
		$(Comment.SELECTORS.comment_contain).on("click", Comment.SELECTORS.like_button, function (event) {
			event.stopPropagation();
			tc = $(this);

			url = tc.attr("alt");
			$.ajax({
				url: url,
				type: "POST",
				data: {
					//comment_id: 1000,
					//comment_id: $(Comment.SELECTORS.like_button).attr('value')
				},
				//dataType: "json",
			})
			.done(function (response) {
				
			})

			.fail(function (xhr, status, errorThrown) {
				alert("Sorryyy, there was a problem!");
				console.log("Error: " + errorThrown);
				console.log("Status: " + status);
				console.dir(xhr);
			});
			return false;
		});
	}
};

$(document).ready(function () {
	Comment.init();
});
