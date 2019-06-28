(function($) {

	// Breakpoints.
		skel.breakpoints({
			xlarge:	'(max-width: 1680px)',
			large:	'(max-width: 1280px)',
			medium:	'(max-width: 980px)',
			small:	'(max-width: 736px)',
			xsmall:	'(max-width: 480px)'
		});

	$(function() {

		var	$window = $(window),
			$body = $('body');

			$body.addClass('is-loading');

			$window.on('load', function() {
				window.setTimeout(function() {
					$body.removeClass('is-loading');
				}, 100);
			});

			skel.on('+medium -medium', function() {
				$.prioritize(
					'.important\\28 medium\\29',
					skel.breakpoint('medium').active
				);
			});

			$(
				'<div id="navPanel">' +
					$('#nav').html() +
					'<a href="#navPanel" class="close"></a>' +
				'</div>'
			)
				.appendTo($body)
				.panel({
					delay: 500,
					hideOnClick: true,
					hideOnSwipe: true,
					resetScroll: true,
					resetForms: true,
					side: 'left'
				});

			if (skel.vars.os == 'wp' && skel.vars.osVersion < 10)
				$('#navPanel')
					.css('transition', 'none');

	});

  onload();
    function onload() {
        
        $.ajax({
            type: "POST",
            url: '/listAllreview.php',
            data: {},
            dataType: 'json',
            success: function (r) {
                var html = '';
                $('#reviewsIndex').html('');                
                $('#average').html('');
                var image = '';
                if (r.data.length > 0) {
                    $.each(r.data, function (i,k) {
                        if (this.profileid == '' || this.profileid == null) {
                            image = '/images/def_face.jpg';
                        } else {
                            image = '//graph.facebook.com/v3.3/' + this.profileid + '/picture?width=250&height=250';
                        }
                        if(i==1){
                            html = `<div class="carousel-item col-md-4 active">
          <div class="card">
            
            <div class="card-body">                            
              <h4 class="card-title">` + this.nombre + `</h4>
              <p class="card-text">` + this.comentario + `</p>
              <p class="card-text">
                <small class="text-muted">` + this.fecha + `</small>
              </p>
            </div>
          </div>
        </div>`;
                        }else{
                       html = `<div class="carousel-item col-md-4">                            
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">` + this.nombre + `</h4>
              <p class="card-text">` + this.comentario + `</p>
              <p class="card-text">
                <small class="text-muted">` + this.fecha + `</small>
              </p>
            </div>
          </div>
        </div>`;
                        }
                        $('#reviewsIndex').append(html);
                        
                        
  $('#myCarousel').carousel({
    interval: 3000
  });

  // Control buttons
  $('.next').click(function () {
    $('.carousel').carousel('next');
    return false;
  });
  $('.prev').click(function () {
    $('.carousel').carousel('prev');
    return false;
  });

 
  $("#myCarousel").on("slide.bs.carousel", function (e) {
    var $e = $(e.relatedTarget);
    var idx = $e.index();
    var itemsPerSlide = 3;
    var totalItems = $(".carousel-item").length;
    if (idx >= totalItems - (itemsPerSlide - 1)) {
      var it = itemsPerSlide -
          (totalItems - idx);
      for (var i = 0; i < it; i++) {
        // append slides to end 
        if (e.direction == "left") {
          $(
            ".carousel-item").eq(i).appendTo(".carousel-inner");
        } else {
          $(".carousel-item").eq(0).appendTo(".carousel-inner");
        }
      }
    }
  });

                        
                    });
                    
                } else {
                    
                }

            }
        });
    }

})(jQuery);
