/*! Speaker v1.0.0 */ 
!function(a){"use strict";a(".wolf-close-admin-notice").click(function(){a(this).parent().parent().slideUp()}),a(".wolf-dismiss-admin-notice").click(function(){var b=a(this);if(b.attr("id")){var c=b.attr("id");a.cookie(c,"false",{path:"/",expires:365}),a(this).parent().parent().slideUp()}})}(jQuery),function(a){"use strict";a(".wolf-options-set-img, .wolf-options-set-bg").click(function(b){b.preventDefault();var c=a(this).parent(),d=wp.media({title:"Choose an image",library:{type:"image"},multiple:!1}).on("select",function(){var b=d.state().get("selection"),e=b.first().toJSON();a("input",c).val(e.url),a("img",c).attr("src",e.url).show()}).open()}),a(".wolf-options-set-file").click(function(b){b.preventDefault();var c=a(this).parent(),d=wp.media({title:"Choose a file",multiple:!1}).on("select",function(){var b=d.state().get("selection"),e=b.first().toJSON();a("input",c).val(e.url),a("span",c).html(e.url).show()}).open()}),a(".wolf-options-reset-img, .wolf-options-reset-bg").click(function(){return a(this).parent().find("input").val(""),a(this).parent().find(".wolf-options-img-preview").hide(),!1}),a(".wolf-options-reset-file").click(function(){return a(this).parent().find("input").val(""),a(this).parent().find("span").empty(),!1}),a(".hastip").tipsy({fade:!0,gravity:"s"})}(jQuery),function(a){"use strict";a.isFunction(a.fancybox)&&a(".wolf-help-img").fancybox()}(jQuery);