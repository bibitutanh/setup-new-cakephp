$(document).ready(function() {
	//Sortable
	//$('.sortable').sortable();

	//Forms
	$('form fieldset.collapsable > legend').click(function(e) {
    	var fieldset = $(this).parent('fieldset');
		fieldset.toggleClass('collapsed');
    });

	//$('form div.input').each(function() {
	//	$(this).addClass('control-group');
	//});

	$('form div.input div.error-message').each(function() {
		$(this).addClass('help-block');
	});
	
	$('form button, form input[type="submit"]').each(function() {
		$(this).addClass('btn btn-primary');
	});
	
	$('form div.submit').each(function() {
		if ($(this).parent().hasClass('form-actions') || $(this).hasClass('no-pretty'))
			return false;
		
		$(this).addClass('form-actions');
	});
	
    //Action Buttons
    $('td.actions,div.actions').each(function() {
    	
    	$(this).children('ul').each(function() {
    		
    		// heading
    		var heading = "Actions";
        	if ($(this).prev('h3').length > 0) {
        		heading = $(this).prev('h3').html();
        		$(this).prev('h3').hide();
        	}
        	
        	if ($(this).data('title')) {
        		heading = $(this).data('title');
        	}
        	
        	// create clone to work on
        	var clone = $(this).clone();
        	clone.addClass('dropdown-menu');
        	clone.css({'right': '0', 'left': 'auto'});
        	
        	// create twitter-bootstrap style button
        	var btn = $('<a>',{ 'class': 'btn btn-small dropdown-toggle', 'data-toggle': 'dropdown', 'href': '#'})
        		.append(heading+"&nbsp;")
        		.append('<span class="caret"></span>');
        	
        	// create twitter-bootstrap style buttongroup
        	var out = $('<div>',{ 'class': 'btn-group'})
        		.append(btn)
        		.append(clone);
        	
        	$(this).after(out);
        	$(this).remove();	
    	});

    	$(this).children('a, button').each(function() {
    		
    		if ($(this).parent().prop("tagName") == "TD") {
    			$(this).addClass('btn btn-small');
    		} else {
    			$(this).addClass('btn btn-small');
    		}
        	
    	});
    });
    
    // Flash messages
    $('.message').each(function() {
    	$(this).addClass('alert');
    });
    
    // Chosen
    $('select').each(function() {
    	if ($(this).hasClass('no-pretty') || $(this).hasClass('chzn-done'))
    		return;
    	
    	if ($(this).data('chosenAllowSingleDeselect') == true) {
	    	$(this).chosen({allow_single_deselect:true});
    	}
    	else {
    		$(this).chosen();
    	}
    });
    
});