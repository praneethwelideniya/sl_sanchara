$(document).ready(function(){
    
    $('.qty-box > .form-control').click( function(e) {
        
        e.preventDefault(); // stops link from making page jump to the top
        e.stopPropagation(); // when you click the button, it stops the page from seeing it as clicking the body too
        $('.qty-box-content').toggleClass('active');
        
    });
    
    $('.qty-box-content').click( function(e) {
        
        e.stopPropagation(); // when you click within the content area, it stops the page from seeing it as clicking the body too
        
    });
    
    $('body').click( function() {
       
        $('.qty-box-content').removeClass('active');
        
    });


	var cartButtons = $('.quantity').find('.quantity-button');

	$(cartButtons).on('click', function(e) {
	  e.preventDefault();
	  var $this = $(this);
	  var target = $this.parent().data('target');
	  var target = $('#' + target);
	  var current = parseFloat($(target).val());
	  if ($this.hasClass('quantity-up'))
	    target.val(current + 1);
	  else {
	    (current < 2) ? null: target.val(current - 1);
	  }
	  
	  var total = 0;
	  $('.quantity input').each(function(){
	    total += +this.value;
	  });
	  
	  $("#total").val(total);
	  
	});

    
});