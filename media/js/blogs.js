var Comment = {
	GLOBAL: {},

	CONSTS: {},

	SELECTORS: {
		comment_ances: 		".comment-contain .comment-ances",
		comment_contain: 	"#comments .comment-contain",
		comment_form: 		"form.comment-form",
		comment: 			"textarea#message",
		comment_button: 	"div button.comment-btn",
		like_button: 		".media ul .like-btn",
		like_group: 		".media ul .like-group",
		like_count: 		".media ul .like-group span",
		like_icon: 			".media ul .like-icon",
		reply_button: 		".media ul .reply-btn",
		reply_comment: 		".media .reply-comment",
		reply_form: 		"form.reply-form",
		reply_submit: 		"div button.reply-button",
		reply_content: 		"textarea.reply-content",
	},

	init: function () {
		Comment.addComment();
		Comment.like();
		Comment.showFormReply();
		Comment.replyComment();
	},

	addComment: function () {
		$(Comment.SELECTORS.comment_form).on("click", Comment.SELECTORS.comment_button,	function (event) {
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
				let html = Comment.renderComment(data, "likes", "comments", "add", "reply", "&comment_id="+data.id );				
				$(Comment.SELECTORS.comment_ances).prepend(html);
				$(Comment.SELECTORS.comment).val("");
				//Comment.showFormReply();
			})

			.fail(function (xhr, status, errorThrown) {
				alert("Sorry, there was a problem!");
				console.log("Error: " + errorThrown);
				console.log("Status: " + status);
				console.dir(xhr);
			});
			return false;
		});
	},

	like: function () {
		$(Comment.SELECTORS.comment_ances).on("click", Comment.SELECTORS.like_button,	function (event) {
			event.stopPropagation();
			tc = $(this);

			url = tc.attr("alt");
			$.ajax({
				url: url,
				type: "POST",
			})
			.done(function (response) {
				let alt = `[alt = ${tc.attr("value")}]`;
				console.log(response);
				if ($(Comment.SELECTORS.like_group + alt).hasClass("liked")) {
					$(Comment.SELECTORS.like_group + alt).removeClass("liked");
				} else {
					$(Comment.SELECTORS.like_group + alt).addClass("liked");
				}
				console.log('cccccccccccccccccccccc');
				//$(Comment.SELECTORS.like_count + alt).html(response);
				$(`.media ul .like-group span${alt}`).html(response);
			})
			.fail(function (xhr, status, errorThrown) {
				alert("Sorryyy, there was a problem!");
				console.log("Error: " + errorThrown);
				console.log("Status: " + status);
				console.dir(xhr);
			});
			return false;
		});
	},

	showFormReply: function () {
		$(Comment.SELECTORS.comment_ances).on( "click", Comment.SELECTORS.reply_button, function (event) {
			console.log("cccc");
			event.stopPropagation();
			tc = $(this);
			let alt = `[alt = "${tc.attr("value")}"]`,
		 		thisComment = $(Comment.SELECTORS.reply_comment + alt);
				console.log(thisComment.css("display"));
			if (thisComment.css("display") === "none") {
				thisComment.css("display", "block");
				$(Comment.SELECTORS.reply_content).focus();
			} else {
				thisComment.css("display", "none");
			}
		});
	},

	replyComment: function () {
		$(Comment.SELECTORS.comment_ances).on("click", Comment.SELECTORS.reply_submit, function (event) {
			event.stopPropagation();
			tc = $(this);
			url = tc.attr("alt");
			idCmt = tc.attr("value");
			alt = `[alt = ${idCmt}]`;
			$.ajax({
				url: url, 
				type: "POST",
				data: {
					blog_id: blog_id,
					content: $(Comment.SELECTORS.reply_content + alt).val(),
					parentId: idCmt
				},
				dataType: "json",
			})
			.done(function (data) {
				let html = Comment.renderComment(data, "likes", "comments", "add", "reply", "&comment_id="+data.id );
				$(Comment.SELECTORS.comment_ances).append(html);
				$(Comment.SELECTORS.reply_content + alt).val("");
				//Comment.replyComment();
				//Comment.like();
			})

			.fail(function (xhr, status, errorThrown) {
				alert('Sorry, vcccctoo many bugs');
				console.log("Error: " + errorThrown);
				console.log("Status: " + status);
				console.dir(xhr);
			});
			return false;
		});
	},	

	renderComment: function (data, ctl_like, ctl_comment, act_like, act_reply, params) {
		imgURL = "media/upload/users/" + auth_img;
		let html = `<div class="media d-flex flex-column">\
						<div class="d-flex flex-row">\
							<a class="pull-left" href="#"><img class="w-75 rounded-circle" src="${imgURL}"></a>\
							<div class="media-body flex-grow-1">\
								<h4 class="media-heading">${auth_name}</h4>\
								<p>  ${data.comment_content} </p>\
								<div class="d-flex flex-row justify-content-between">\
									<ul class="list-unstyled list-inline media-detail d-flex">\
										<li><i class="fa fa-calendar"></i><span>${data.created}</span></li>\
										<li class="like-group" alt="${data.id}">\
											<i class="fa fa-thumbs-up like-icon"></i>\
											<span alt="${data.id}">${data.like_count}</span>\
										</li>\
									</ul>\
									<ul class="list-unstyled list-inline media-detail d-flex">\
										<li>\
											<a class="like-btn" href="" value="${data.id}" alt="index.php?ctl=${ctl_like}&act=${act_like+params}">\
												Like\
											</a>\
										</li>\
										<li>\
											<a class="reply-btn" value="${data.id}">\
												Reply\
											</a>\
										</li>\
									</ul>\
								</div>\
							</div>\
						</div>\
						<div class="reply-comment" alt="${data.id}">\
							<form name="reply-form" class="reply-form ps-5 mt-3">\
								<h3 class="ps-4">Reply</h3>\
								<fieldset>\
									<div class="row">\
										<div class="col-sm-3 col-lg-2">\
											<img class="img-responsive w-50 rounded-circle" src="${imgURL}">\
										</div>\
										<div class="form-group col-xs-12 col-sm-9 col-lg-10">\
											<textarea class="reply-content form-control" alt="${data.id}" placeholder="Your comment" required></textarea>\
										</div>\
									</div>\
								</fieldset>\
								<div class="d-flex justify-content-end">\
									<button name="reply" id="test_btn" type="button" class="btn btn-custom-auth text-light reply-button" value="${data.id}" alt="index.php?ctl=${ctl_comment}&act=${act_reply}">Reply</button>\
								</div>\
							</form>\
						</div>\
						<div class="comment-reply" alt="${data.id}">\
						</div>\
					</div>`;
					return html;
	}
};

$(document).ready(function () {
	Comment.init();
});