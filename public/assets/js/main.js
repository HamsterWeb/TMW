//$(document).ready(function(){

	function throttle(f, delay){
	    var timer = null;
	    return function(){
	        var context = this, args = arguments;
	        clearTimeout(timer);
	        timer = window.setTimeout(function(){
	            f.apply(context, args);
	        },
	        delay || 2000);
	    };
	}

	function controle_regex(champ, regex) {
		//var result = false;
		var msg = $(champ).siblings('.error-message');
		if(!regex.test($(champ).val()))
			{
				$(champ).addClass("error");
				msg.show();
				msg.html("The value you entered is not valid");
				result = false;
			}
			else
			{
				$(champ).removeClass("error");
				msg.hide();
				result = true;
			}
			return result;
		}
	        
	function controle_regex_or_null(champ, regex){ //soit null soit controlé
	            //var result = false;
	    if($(champ).val().length > 0){
	    	var msg = $(champ).siblings('.error-message');
			if(!regex.test($(champ).val()))
				{
					$(champ).addClass("error");
					msg.html('The value you entered is not valid')
					msg.show();
					result = false;
				}
				else
				{
					$(champ).removeClass("error");
					msg.hide();
					result = true;
				}
	            }
	    else {
	           $(champ).removeClass("error");
	           msg.hide();
	           result = true;
	    }
		return result;
	}
	        
	        //regex
	var text_num_reg = /^[a-zA-Z0-9éèàçùú&.\,-\/:\'_ ]+$/;
	var text_reg = /^[a-zA-Zéèàçùú.\,-\/:\' ]+$/;
	var email_reg = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.[a-zA-Z]{2,4}$/;
	var tel_reg = /^0[0-9]{9,9}$/;
	var cp_reg = /^[0-9]{5,5}$/;
	var pwd_reg = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z@*.]{6,}$/;
	var num_reg = /^[0-9]+$/;
	var date_reg = /^([0-2][0-9]|3[0-1])+\/(0[1-9]|1[0-2])+\/(19[0-9]{2}|20[0-9]{2})$/;
	var year_reg = /^(19[0-9]{2}|20[0-9]{2})$/;

	/* range inputs */
$(function(){

	/* get the csrf called on evey ajax call */
	 $.ajaxSetup({
			headers: {
			'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
			}
	});

	/* show the value of a slider */
	var el, newPoint, newPlace, offset;
	 
	 // Select all range inputs, watch for change
	$("input[type='range']").change(function() {
	   // Cache this for efficienc
	   el = $(this);
	   // Measure width of range input
	   width = el.width();
	   
	   // Figure out placement percentage between left and right of input
	   newPoint = (el.val() - el.attr("min")) / (el.attr("max") - el.attr("min"));
	   
	   // Janky value to get pointer to line up better
	   offset = 3;
	   
	   // Prevent bubble from going beyond left or right (unsupported browsers)
	   if (newPoint < 0) { newPlace = 0; }
	   else if (newPoint > 1) { newPlace = width; }
	   else { offset -= newPoint; newPlace = width * newPoint + offset; }
	   
	   // Move bubble
	   el
	    .siblings("output")
	     .css({
	       left: newPlace,
	       marginLeft: offset + "%"
	     })
	     .html(el.val());
	 })
	 // Fake a change to position bubble at page load
	 .trigger('change');


	 /*    EDITABLE     */
	 //click on the edit button
	 $(".edit-btn button").on("click", function(){
	 	var parent = $(this).closest("div");
	 	var edit_zones = parent.find('p');
	 	edit_zones.each(function(){
	 		$(this).addClass('editable');
	 	});
	 });

	 //click on the editable zones for editing
	 $(document).on("dblclick", ".editable", function(){
	 	var obj = $(this);
	 	var btn_wrap = obj.parent().siblings('aside');
	 	var height = obj.height();
	 	var width = obj.width();
	 	var val = obj.text();
	 	obj.removeClass('editable');
	 	obj.addClass('edited');
	 	btn_wrap.html('<button class="btn btn-xs btn-success save-btn"><span class="glyphicon glyphicon-ok">OK</span></button>');
	 	//console.log(height+" "+width+" "+val);
	 	var textarea = $("<textarea>", { html: val, height: height, width:width } );
	 	obj.append(textarea);

	 });

	 //click on save button after editing
	 $(document).on('click', '.save-btn', function(){
	 	var parent = $(this).closest("div");
	 	var edit_zones = parent.find('p.edited');
	 	var model = parent.attr('model').split('-');
	 	var upd_fields = [];
	 	var url = "/"+model[0]+"/"+model[1]+"/edit";
	 	edit_zones.each(function(v){
	 		upd_fields.push({
	 			field: $(this).attr('field'),
	 			new_val: $(this).find('textarea').val()
	 		});
	 	});
	 	//console.log(url);
	 	$.ajax({
	 		url: url,
	 		type: "POST",
	 		dataType: "json",
	 		data: { fields: upd_fields },
	 		success: function(data){
	 			if(data.success){
	 				console.log('ok');
	 			}
	 			else{
	 				console.log('ok');
	 			}
	 		}
	 	});
	 });

	        

});








