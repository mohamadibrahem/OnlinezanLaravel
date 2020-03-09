/*!
 * Offcanvas Sidebar v0.1
 * Copyright 2017 - present Morten Sørensen (https://moso.io)
 * Licensed under the MIT license
 * --------------------------------------------------------------
 * Script that clones the current Bootstrap markup,
 * and inserts it into a sidebar with some smooth animations
 *
 * - Built to work with Bootstrap 4 and supports multiple navbars
 * - Fully customizable with comments
 */

var window_height;
var window_width;
var navbar_initialized = false;
var nav_toggle;

var offCanvas = {
    sidenav: {
        // Sidenav is not visible by default.
        // Change to 1 if necessary
        sidenav_visible: 0
    },
    initSideNav: function initSideNav() {
        if (!navbar_initialized) {
            var $nav = $('nav');

            // Add the offcanvas class to the navbar if it's not initialized
            $nav.addClass('navbar-offcanvas');

            // Clone relevant navbars
            var $navtop = $nav.find('.navbar-top').first().clone(true);
            var $navbar = $nav.find('.navbar-collapse').first().clone(true);

            // Let's start with some empty vars
            var ul_content = '';
            var top_content = '';

            // Set min-height of the new sidebar to the screen height
            $navbar.css('min-height', window.screen.height);

            // Take the content of .navbar-top
            $navtop.each(function() {
                var navtop_content = $(this).html();
                top_content = top_content + navtop_content;
            });

            // Take the content of .navbar-collapse
            $navbar.children('ul').each(function() {
                var nav_content = $(this).html();
                ul_content = ul_content + nav_content;
            });

            // Wrap the new content inside an <ul>
            ul_content = '<ul class="navbar-nav sidebar-nav">' + ul_content + '</ul>';

            // Insert the html content into our cloned content
            $navbar.html(ul_content);
            $navtop.html(top_content);

            // Append the navbar to body,
            // and insert the content of the navicons navbar just below the logo/nav-image
            $('body').append($navbar);
            $('.nav-image').after($navtop);


            // Set the toggle-variable to the Bootstrap navbar-toggler button
            var $toggle = $('.navbar-toggler');

            // Add/remove classes on toggle and set the visiblity of the sidenav,
            // and append the overlay. Also if the user clicks the overlay,
            // the sidebar will close
            $toggle.on('click', function () {
                if (offCanvas.sidenav.sidenav_visible == 1) {
                    $('html').removeClass('nav-open');
                    offCanvas.sidenav.sidenav_visible = 0;
                    $('#overlay').remove();
                    setTimeout(function() {
                        $toggle.removeClass('toggled');
                    }, 300);
                } else {
                    setTimeout(function() {
                        $toggle.addClass('toggled');
                    }, 300);

                    // Add the overlay and make it close the sidenav on click
                    var div = '<div id="overlay"></div>';
                    $(div).appendTo("body").on('click', function() {
                        $('html').removeClass('nav-open');
                        offCanvas.sidenav.sidenav_visible = 0;
                        $('#overlay').remove();
                        setTimeout(function() {
                            $toggle.removeClass('toggled');
                        }, 300);
                    });

                    $('html').addClass('nav-open');
                    offCanvas.sidenav.sidenav_visible = 1;
                }
            });
            // Set navbar to initialized
            navbar_initialized = true;
        }
    }
};

$(document).ready(function () {
    window_width = $(window).width();

    nav_toggle = $('nav').hasClass('navbar-offcanvas') ? true : false;

    // Responsive checks
    if (window_width < 992 || nav_toggle) {
        offCanvas.initSideNav();
    }

    // Close the sidebar if the user clicks a link or a dropdown-item,
    // and close the sidebar
    $('.nav-link:not(.dropdown-toggle), .dropdown-item').on('click', function () {
        var $toggle = $('.navbar-toggler');

        $('html').removeClass('nav-open');
        offCanvas.sidenav.sidenav_visible = 0;
        setTimeout(function () {
            $toggle.removeClass('toggled');
        }, 300);
    });
});

$(window).resize(function () {
    window_width = $(window).width();

    // More responsive checks if the user resize the browser
    if (window_width < 992) {
        offCanvas.initSideNav();
    }

    if (window_width > 992 && !nav_toggle) {
        $('nav').removeClass('navbar-offcanvas');
        offCanvas.sidenav.sidenav_visible = 1;
        navbar_initialized = false;
    }
});


/* See related post at
https://codepen.io/Javarome/post/full-page-sliding
*/
function ScrollHandler(pageId) {
    var page = document.getElementById(pageId);
    var pageStart = page.offsetTop;
    var pageJump = false;
    var viewStart;
    var duration = 1000;
    var scrolled = document.getElementById("scroll");

    function scrollToPage() {
      pageJump = true;

      // Calculate how far to scroll
      var startLocation = viewStart;
      var endLocation = pageStart;
      var distance = endLocation - startLocation;

      var runAnimation;

      // Set the animation variables to 0/undefined.
      var timeLapsed = 0;
      var percentage, position;

      var easing = function(progress) {
        return progress < 0.5
          ? 4 * progress * progress * progress
          : (progress - 1) * (2 * progress - 2) * (2 * progress - 2) + 1; // acceleration until halfway, then deceleration
      };

      function stopAnimationIfRequired(pos) {
        if (pos == endLocation) {
          cancelAnimationFrame(runAnimation);
          setTimeout(function() {
            pageJump = false;
          }, 0);
        }
      }

      var animate = function() {
        timeLapsed += 16;
        percentage = timeLapsed / duration;
        if (percentage > 1) {
          percentage = 1;
          position = endLocation;
        } else {
          position = startLocation + distance * easing(percentage);
        }
        scrolled.scrollTop = position;
        runAnimation = requestAnimationFrame(animate);
        stopAnimationIfRequired(position);
        console.log("position=" + scrolled.scrollTop + "(" + percentage + ")");
      };
      // Loop the animation function
      runAnimation = requestAnimationFrame(animate);
    }

    window.addEventListener("wheel", function(event) {
      viewStart = scrolled.scrollTop;
      if (!pageJump) {
        var pageHeight = page.scrollHeight;
        var pageStopPortion = pageHeight / 2;
        var viewHeight = window.innerHeight;

        var viewEnd = viewStart + viewHeight;
        var pageStartPart = viewEnd - pageStart;
        var pageEndPart = pageStart + pageHeight - viewStart;

        var canJumpDown = pageStartPart >= 0;
        var stopJumpDown = pageStartPart > pageStopPortion;

        var canJumpUp = pageEndPart >= 0;
        var stopJumpUp = pageEndPart > pageStopPortion;

        var scrollingForward = event.deltaY > 0;
        if (
          (scrollingForward && canJumpDown && !stopJumpDown) ||
          (!scrollingForward && canJumpUp && !stopJumpUp)
        ) {
          event.preventDefault();
          scrollToPage();
        }
        false; //
      } else {
        event.preventDefault();
      }
    });
  }
  new ScrollHandler("one");
  new ScrollHandler("two");
  new ScrollHandler("three");
  new ScrollHandler("four");
  new ScrollHandler("five");



  $(".hover").mouseleave(
    function () {
      $(this).removeClass("hover");
    }
  );
