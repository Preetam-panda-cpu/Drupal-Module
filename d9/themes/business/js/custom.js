// Can also be used with $(document).ready()
jQuery(window).on('load', function() {
  jQuery('.flexslider').flexslider({
    animation: "slide"
  });
});

jQuery('.navbar-toggle').click(function() {
  jQuery('.navbar-header').toggleClass('active');
});
