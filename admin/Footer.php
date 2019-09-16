    <script src="js/jquery.easing.min.js"></script>
    <script src="js/grayscale.js"></script>
    <!-- Menu -->
    <script>

      $(".menu-toggle").click(function(e) {
        $("#wrapper").toggleClass("active");
        $(".Area_Oscura").fadeIn('fast');
      });
      $(".Ocultar_A").click(function(e) {
        $(".Area_Oscura").fadeOut('fast');
      });
      /***************check*******************/
      $(function () {
        $('.list-group.checked-list-box .list-group-item').each(function () {

        // Settings
        var $widget = $(this),
        $checkbox = $('<input type="checkbox" class="hidden" />'),
        color = ($widget.data('color') ? $widget.data('color') : "primary"),
        style = ($widget.data('style') == "button" ? "btn-" : "list-group-item-"),
        settings = {
          on: {
            icon: 'glyphicon glyphicon-check'
          },
          off: {
            icon: 'glyphicon glyphicon-unchecked'
          }
        };

        $widget.css('cursor', 'pointer')
        $widget.append($checkbox);

        // Event Handlers
        $widget.on('click', function () {
          $checkbox.prop('checked', !$checkbox.is(':checked'));
          $checkbox.triggerHandler('change');
          updateDisplay();
        });
        $checkbox.on('change', function () {
          updateDisplay();
        });


        // Actions
        function updateDisplay() {
          var isChecked = $checkbox.is(':checked');

            // Set the button's state
            $widget.data('state', (isChecked) ? "on" : "off");

            // Set the button's icon
            $widget.find('.state-icon')
            .removeClass()
            .addClass('state-icon ' + settings[$widget.data('state')].icon);

            // Update the button's color
            if (isChecked) {
              $widget.addClass(style + color + ' active');
            } else {
              $widget.removeClass(style + color + ' active');
            }
          }

        // Initialization
        function init() {

          if ($widget.data('checked') == true) {
            $checkbox.prop('checked', !$checkbox.is(':checked'));
          }

          updateDisplay();

            // Inject the icon if applicable
            if ($widget.find('.state-icon').length == 0) {
              $widget.prepend('<span class="state-icon ' + settings[$widget.data('state')].icon + '"></span>');
            }
          }
          init();
        });

        $('#get-checked-data').on('click', function(event) {
          event.preventDefault(); 
          var checkedItems = {}, counter = 0;
          $("#check-list-box li.active").each(function(idx, li) {
            checkedItems[counter] = $(li).text();
            counter++;
          });
          $('#display-json').html(JSON.stringify(checkedItems, null, '\t'));
        });
      });
/*
Tabla de Grados
*/
$(document).ready(function(){
  $('.filterable .btn-filter').click(function(){
    var $panel = $(this).parents('.filterable'),
    $filters = $panel.find('.filters input'),
    $tbody = $panel.find('.table tbody');
    if ($filters.prop('disabled') == true) {
      $filters.prop('disabled', false);
      $filters.first().focus();
    } else {
      $filters.val('').prop('disabled', true);
      $tbody.find('.no-result').remove();
      $tbody.find('tr').show();
    }
  });

  $('.filterable .filters input').keyup(function(e){
    /* Ignore tab key */
    var code = e.keyCode || e.which;
    if (code == '9') return;
    /* Useful DOM data and selectors */
    var $input = $(this),
    inputContent = $input.val().toLowerCase(),
    $panel = $input.parents('.filterable'),
    column = $panel.find('.filters th').index($input.parents('th')),
    $table = $panel.find('.table'),
    $rows = $table.find('tbody tr');
    /* Dirtiest filter function ever ;) */
    var $filteredRows = $rows.filter(function(){
      var value = $(this).find('td').eq(column).text().toLowerCase();
      return value.indexOf(inputContent) === -1;
    });
    /* Clean previous no-result if exist */
    $table.find('tbody .no-result').remove();
    /* Show all rows, hide filtered ones (never do that outside of a demo ! xD) */
    $rows.show();
    $filteredRows.hide();
    /* Prepend no-result row if all rows are filtered */
    if ($filteredRows.length === $rows.length) {
      $table.find('tbody').prepend($('<tr class="no-result text-center"><td colspan="'+ $table.find('.filters th').length +'">No result found</td></tr>'));
    }
  });
});

window.page = window.location.hash || "#about";

$(document).ready(function () {
  if (window.page != "#about") {
    $(".menu").find("li[data-target=" + window.page + "]").trigger("click");
  }
});

$(window).on("resize", function () {
  $("html, body").height($(window).height());
  $(".main, .menu").height($(window).height() - $(".header-panel").outerHeight());
  $(".pages").height($(window).height());
}).trigger("resize");

$(".menu li").click(function () {
    // Menu
    if (!$(this).data("target")) return;
    if ($(this).is(".active")) return;
    $(".menu li").not($(this)).removeClass("active");
    $(".page").not(page).removeClass("active").hide();
    window.page = $(this).data("target");
    var page = $(window.page);
    window.location.hash = window.page;
    $(this).addClass("active");


    page.show();

    var totop = setInterval(function () {
      $(".pages").animate({scrollTop: 0}, 0);
    }, 1);

    setTimeout(function () {
      page.addClass("active");
      setTimeout(function () {
        clearInterval(totop);
      }, 1000);
    }, 100);
  }); 
function cleanSource(html) {
  var lines = html.split(/\n/);

  lines.shift();
  lines.splice(-1, 1);

  var indentSize = lines[0].length - lines[0].trim().length,
  re = new RegExp(" {" + indentSize + "}");

  lines = lines.map(function (line) {
    if (line.match(re)) {
      line = line.substring(indentSize);
    }

    return line;
  });

  lines = lines.join("\n");

  return lines;
}

$("#opensource").click(function () {
  $.get(window.location.href, function (data) {
    var html = $(data).find(window.page).html();
    html = cleanSource(html);
    $("#source-modal pre").text(html);
    $("#source-modal").modal();
  });
});
</script>

<!-- Twitter Bootstrap -->
<script src="js/bootstrap.min.js"></script>
<!-- Material Design for Bootstrap -->
<script src="js/material.js"></script>
<script src="js/ripples.min.js"></script>
<script src="js/waypoints.min.js"></script>
<script>
  $.material.init();
</script>

<script type="text/javascript">
  jQuery(function($) { 
    $('.animar1').waypoint(function() {
      $(this).toggleClass( 'bounceIn animated' );
    },
    {
      offset: '70%',
      triggerOnce: true
    });

    $('.animar2').waypoint(function() {
      $(this).toggleClass( 'fadeInLeft animated' );
    },
    {
      offset: '70%',
      triggerOnce: true
    });        

    $('.animar3').waypoint(function() {
      $(this).toggleClass( 'fadeInRight animated' );
    },
    {
      offset: '70%',
      triggerOnce: true
    });      
    $('.animar4').waypoint(function() {
      $(this).toggleClass( 'fadeInUp animated' );
    },
    {
      offset: '70%',
      triggerOnce: true
    });        
  });
</script>
<!-- Sliders -->
<script src="js/jquery.nouislider.min.js"></script>
<script type="text/javascript">
  (function( $ ) {

    //Function to animate slider captions 
    function doAnimations( elems ) {
    //Cache the animationend event in a variable
    var animEndEv = 'webkitAnimationEnd animationend';
    
    elems.each(function () {
      var $this = $(this),
      $animationType = $this.data('animation');
      $this.addClass($animationType).one(animEndEv, function () {
        $this.removeClass($animationType);
      });
    });
  }
  
  //Variables on page load 
  var $myCarousel = $('#carousel-example-generic'),
  $firstAnimatingElems = $myCarousel.find('.item:first').find("[data-animation ^= 'animated']");

  //Initialize carousel 
  $myCarousel.carousel();
  
  //Animate captions in first slide on page load 
  doAnimations($firstAnimatingElems);
  
  //Pause carousel  
  $myCarousel.carousel('pause');
  
  
  //Other slides to be animated on carousel slide event 
  $myCarousel.on('slide.bs.carousel', function (e) {
    var $animatingElems = $(e.relatedTarget).find("[data-animation ^= 'animated']");
    doAnimations($animatingElems);
  });  
  $('#carousel-example-generic').carousel({
    interval:3000,
    pause: "false"
  });
  
})(jQuery); 
</script>
<!-- Dropdown.js -->
<script src="js/jquery.dropdown.js"></script>
<script type="text/javascript" src="js/SmoothScroll.js"></script>
<script type="text/javascript" src="js/jquery.isotope.js"></script>

<script src="js/owl.carousel.js"></script>

    <!-- Javascripts
    ================================================== -->
    <script type="text/javascript" src="js/main.js"></script>
    <script>
      $("#dropdown-menu select").dropdown();
    </script>

    </html>