$(document).ready(function () {
    $("body").on("keyup", ".intro-input input", function () {
        var query = $(this).val();
        $.ajax({
            type: 'POST',
            dataType: 'html',
            url: "/intro/ajaxgetquestions",
            data: {
                q: query,
            },
            timeout: 5000,
            cache: false,
            success: function (html) {
                $(".intro-question-list").html(html);
            },
        });
    });
    
    $("body").on("click", ".question-choice, .question-choice-related", function () {
	    var question = $(this);
	    var qid = question.data("indexNumber");
        $.ajax({
            type: 'POST',
            dataType: 'html',
            url: "/intro/ajaxgetquestion",
            data: {
                qid: qid,
            },
            timeout: 5000,
            cache: false,
            success: function (html) {
                $(".intro-input input").val(html);
                $(".intro-question-list").html("");
            },
        });
        $.ajax({
            type: 'POST',
            dataType: 'html',
            url: "/intro/ajaxgetresult",
            data: {
                qid: qid,
            },
            timeout: 5000,
            cache: false,
            success: function (html) {
                $(".intro-result-container").html(html);
                makeTags();
                hoverTags();
            },
        });
    });
    
});

function makeTags() {
	$(".ref-tag").each(function(){
		var tag = $(this);
		var overflow = 5;
		var region = tag.data("region");
		tag.append("<sup>" + region + "</sup>");
		tag.append("<div class='tag-highlight'></div>");
		var height = tag.height();
		var width = tag.width();
		tag.find(".tag-highlight").height(height + overflow * 2);
		tag.find(".tag-highlight").width(width + overflow * 2);
		tag.find(".tag-highlight").css("top", "-" + overflow + "px");
		tag.find(".tag-highlight").css("left", "-" + overflow + "px");
	});
}

function hoverTags() {
	$(".intro-region").hover(function(){
		var region = $(this).data("region");
		$(".ref-tag").each(function(){
			var tag = $(this);
			if (tag.data("region") === region) {
				tag.find(".tag-highlight").show();
			}
		});
	}, function(){
		var region = $(this).data("region");
		$(".ref-tag").each(function(){
			var tag = $(this);
			if (tag.data("region") === region) {
				tag.find(".tag-highlight").hide();
			}
		});
	});
	$(".ref-tag").hover(function(){
		var region = $(this).data("region");
		var tag = $(this);
		tag.find(".tag-highlight").show();
		$(".intro-region").each(function(){
			var ref = $(this);
			if (ref.data("region") === region) {
				ref.addClass("hover-tag");
			}
		});
	}, function(){
		var region = $(this).data("region");
		var tag = $(this);
		tag.find(".tag-highlight").hide();
		$(".intro-region").each(function(){
			var ref = $(this);
			if (ref.data("region") === region) {
				ref.removeClass("hover-tag");
			}
		});
	});
}

