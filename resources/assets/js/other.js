$("#inpt_search").on('focus', function () {
	$(this).parent('label').addClass('active');
});

$("#inpt_search").on('blur', function () {
	if($(this).val().length == 0)
		$(this).parent('label').removeClass('active');
});
var div = document.querySelector( 'svg' );

// Toggle class
div.addEventListener( 'click', function() {
  this.classList.toggle( 'close' );
}, false );
$(".sidebar-dropdown > a").click(function() {
	$(".sidebar-submenu").slideUp(200);
	if (
	  $(this)
		.parent()
		.hasClass("active")
	) {
	  $(".sidebar-dropdown").removeClass("active");
	  $(this)
		.parent()
		.removeClass("active");
	} else {
	  $(".sidebar-dropdown").removeClass("active");
	  $(this)
		.next(".sidebar-submenu")
		.slideDown(200);
	  $(this)
		.parent()
		.addClass("active");
	}
  });

  $("#close-sidebar").click(function() {
	$(".page-wrapper").removeClass("toggled");
  });
  $("#show-sidebar").click(function() {
	$(".page-wrapper").addClass("toggled");
  });

  $('.counter').each(function() {
  var $this = $(this),
      countTo = $this.attr('data-count');

  $({ countNum: $this.text()}).animate({
    countNum: countTo
  },

  {

    duration: 1000,
    easing:'linear',
    step: function() {
      $this.text(Math.floor(this.countNum));
    },
    complete: function() {
      $this.text(this.countNum);
      //alert('finished');
    }

  });



});
