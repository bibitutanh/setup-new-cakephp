$(document).ready(function() {
	//Sortable
	//$('.sortable').sortable();

	//Forms
	$('fieldset.collapsable > legend').click(function(e) {
    	var fieldset = $(this).parent('fieldset');
		fieldset.toggleClass('collapsed');
    });

    //Actions
    $('td.actions > ul.actions, div.actions > ul').each(function() {
	    var actions = $(this).html();
	    var html = '<li><button class="ym-button ym-actions">Actions</button><ul>'+actions+'</ul></li>'
	    $(this).html(html);
		$(this).addClass('dd-actions');
		$(this).parent().addClass('dd-actions');
    });
});