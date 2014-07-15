//$(document).ready(function(){
	var yn = [{id:0, name: "No"}, {id:1, name: "Yes"}];
	var wg = [{id:0, name: "Underestimated"}, {id:1, name:"Accurate"}, {id:2, name:"Overestimated"}];
	var water = [{id:1, name: "Ocean"}, {id:2, name: "Sea"}];
	var direction = [{id:1, name: "On"}, {id:2, name: "Off"}];
	var quality = [{id:1, name: "consistent"}, {id:2, name: "nasty"}];
	var weather = [{id:1, name: "sunny"}, {id:2, name: "rainy"}, {id:3, name:"cloudy"}];

	$.fn.getType = function(){ return this[0].tagName == "INPUT" ? this[0].type.toLowerCase() : this[0].tagName.toLowerCase(); }
	
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
					msg.html('The value you entered is not valid');
					if(msg)
						msg.show();
					result = false;
				}
				else
				{
					$(champ).removeClass("error");
					if(msg)
						msg.hide();
					result = true;
				}
	            }
	    else {
	           $(champ).removeClass("error");
	           if(msg)
	           		msg.hide();
	           result = true;
	    }
		return result;
	}

	function controle_regex_number(champ, regex, min, max) {
		var msg = $(champ).siblings('.error-message');
		var val = parseInt($(champ).val());
		//console.log(val+" "+min+" "+max);
		if(!regex.test(val) || val > max || val < min )
			{
				$(champ).addClass("error");
				if(msg){
					msg.show();
					msg.html("The value you entered is not valid");
				}
				
				result = false;
			}
			else
			{
				console.log('ik');
				$(champ).removeClass("error");
				if(msg) msg.hide();
				result = true;
			}
		return result;
	}
	        
	        //regex
	var text_num_reg = /^[a-zA-Z0-9éèàçùú&.\,-\/:\'_ !?();]+$/;
	var text_reg = /^[a-zA-Zéèàçùú.\,-\/:\' ]+$/;
	var email_reg = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.[a-zA-Z]{2,4}$/;
	var tel_reg = /^0[0-9]{9,9}$/;
	var cp_reg = /^[0-9]{5,5}$/;
	var pwd_reg = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z@*.]{6,}$/;
	var num_reg = /^[0-9]+$/;
	var date_reg = /^([0-2][0-9]|3[0-1])+\/(0[1-9]|1[0-2])+\/(19[0-9]{2}|20[0-9]{2})$/;
	var year_reg = /^(19[0-9]{2}|20[0-9]{2})$/;

	
	var arrayToString = function(arr){
		var string = "";
		//console.log(arr); 	
		$.each(arr, function(i, v){
			string += v + "<br/>";
		});
		return string;
	}

/* prevent from selecting more than one tag */
	var deselectTag = function(arrTag){
		$.each(arrTag, function(i, v){
			var tag = $(this);
			if(tag.hasClass('active')){
				tag.removeClass('active');
			}
		});	
	}

	var getElementId = function(arrEl){
		var id = 0;
		$.each(arrEl, function(i, v){
			var el = $(this);
			if(el.hasClass('active')){
				id = el.attr('id');
				return false;
			}
		});	
		return id;
	}

	/* range inputs */
$(function(){

	/* get the csrf called on evey ajax call */
	 $.ajaxSetup({
			headers: {
			'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
			},
			cache:false
	});

	 /* control textarea */
	 $(document).on('keyup focusout blur', 'textarea',
	        function(e) {
	           if (e.keyCode !== 9 && e.keyCode !== 16) /* Différent de Tab et Shift*/ {
	                controle_regex_or_null(this, text_num_reg); 
	                //console.log("ok");
	           }
	  });

	 $(document).on('keyup focusout blur', 'input[type=number]',
	        function(e) {
	           if (e.keyCode !== 9 && e.keyCode !== 16) /* Différent de Tab et Shift*/ {
	                controle_regex_number(this, num_reg, parseInt($(this).attr('min')), parseInt($(this).attr('max'))); 
	                //console.log("ok");
	           }
	  });

	 $(document).on("keyup focusout", "input[type=email]", throttle(function(e){ 
	           if (e.keyCode !== 9 && e.keyCode !== 16) /* Différent de Tab et Shift*/ {
	                controle_regex(this, email_reg); 
	                //console.log("ok");
	           }
	  }));

	 

	 /* sticker */
	 //var s = $(".sticker");
     //var pos = s.position(); 
     //console.log(pos);                 
     /*var stickermax = $(document).outerHeight() - $("#footer").outerHeight() - s.outerHeight() - 40; //40 value is the total of the top and bottom margin
     $(window).scroll(function() {
     	var windowpos = $(window).scrollTop();
     	//console.log("Distance from top:" + pos.top + "<br />Scroll position: " + windowpos);
     	if (windowpos >= pos.top && windowpos < stickermax) {
     		s.attr("style", ""); //kill absolute positioning
     		s.addClass("stick"); //stick it
     	} else if (windowpos >= stickermax) {
     		s.removeClass(); //un-stick
     		s.css({position: "absolute", top: stickermax + "px"}); //set sticker right above the footer
     		
     	} else {
     		s.removeClass(); //top of page
     	}
     });*/                  
	/*$(window).scroll(function() {
	        var windowpos = $(window).scrollTop();
	        //console.log(windowpos+" "+pos.top);
	        //s.html("Distance from top:" + pos.top + "<br />Scroll position: " + windowpos);
	        if (windowpos >= pos.top) {
	            s.addClass("stick");
	        } else {
	            s.removeClass("stick");
	        }
	    });*/

	   $(".sticker a").on("click", function(e){
	   		//e.preventDefault();
	   		$("html, body").animate({ scrollTop: $(document).height() }, "slow");
	   });

	/* tabs -- refresh current tab */
	if(location.hash) {
	       $('a[href=' + location.hash + ']').tab('show');
	    }

	$(document.body).on("click", "a[data-toggle]", function(event) {
	    location.hash = this.getAttribute("href");
	  });

	$(window).on('popstate', function() {
	    var anchor = location.hash || $("a[data-toggle=tab]").first().attr("href");
	    $('a[href=' + anchor + ']').tab('show');

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

	 var generateInput = function(type, val, height, width){
	 	var input = "";
	 	type = type.split('-');
	 	switch(type[0]) {
	 		case 'text':
	 			input = $("<textarea>", { html: val, height: height, width:width } );
	 			break;
	 		case 'select':
	 			input = $("<select>");
	 			var arr = eval(type[1]);
	 			$.each(arr, function(i, v){
	 				input.append($('<option value="'+v.id+'">'+v.name+'</option>'));
	 			});
	 			break;
	 		case 'range':
	 			var max = type[1];
	 			var step = 1;
	 			if(max == 10)
	 				step = 0.1;
	 			input = $('<input type="number" min="0" max="'+type[1]+'" step="'+step+'" />');
	 			break;
	 	}
	 	return input;
	 }
	 //click on the editable zones for editing
	 $(document).on("dblclick", ".editable", function(){
	 	var obj = $(this);
	 	var btn_wrap = obj.closest('div').find('aside');
	 	var height = obj.height();
	 	var width = obj.width();
	 	var val = obj.text();
	 	var type = obj.attr('type');
	 	obj.removeClass('editable');
	 	obj.addClass('edited');
	 	btn_wrap.html('<button class="btn btn-xs btn-success save-btn"><span class="glyphicon glyphicon-ok">OK</span></button>');
	 	//console.log(height+" "+width+" "+val);
	 	var input = generateInput(type, val, height, width);
	 	input.addClass('form-control');
	 	//console.log(option);
	 	//input.css({height: height, width:width });
	 	//var textarea = $("<textarea>", { html: val, height: height, width:width } );
	 	obj.append(input);

	 });

	 //console.log({{ App::make('water')}});

	 //click on save button after editing
	 $(document).on('click', '.save-btn', function(){
	 	var parent = $(this).closest("div");
	 	var edit_zones = parent.find('p.edited');
	 	var model = parent.attr('model').split('-');
	 	var upd_fields = [];
	 	var url = "";
	 	var error = false;
	 	var inputs = edit_zones.find('input');
	 	inputs.each(function () {
          $(this).blur();
          if($(this).hasClass('error')) { 
              error = true;
              //return false;
          }
         });

	 	if(error == false) {
		 	if(model[0] == "spotinperiod"){
		 		url = "/"+model[0]+"/"+model[1]+"/edit/period";
		 		edit_zones.each(function(v){
			 		upd_fields.push({
			 			field: $(this).attr('field'),
			 			new_val: $(this).children(":first").val(),
			 			period: $(this).attr('period')
			 		});
			 	});
		 	}
		 	else {
		 		url = "/"+model[0]+"/"+model[1]+"/edit";

			 	edit_zones.each(function(v){
			 		upd_fields.push({
			 			field: $(this).attr('field'),
			 			new_val: $(this).children(":first").val() //$(this).find('textarea').val()
			 		});
			 	});
			 }
	 	//console.log(url);
		 	$.ajax({
		 		url: url,
		 		type: "POST",
		 		dataType: "json",
		 		data: { fields: upd_fields },
		 		success: function(data){
		 			if(data.success){
		 				//console.log('ok');
		 				window.location.reload();
		 			}
		 			else{
		 				//console.log('not ok');
		 			}
		 		}
		 	});
		 }
	 });

	        

});








