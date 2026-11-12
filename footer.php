			<!-- footer -->
			<footer class="footer" role="contentinfo">

				<!-- copyright -->
				<p class="container copy-right">
					&copy; <?php echo date('Y'); ?> Copyright <?php bloginfo('name'); ?> 
				</p>
				<!-- /copyright -->

			</footer>
			<!-- /footer -->

		<?php wp_footer(); ?>

		<!-- analytics -->
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-xxxxxxxx-x"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-xxxxxxxx-x');
</script>

		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
		<script>
		    $('.menu-toggle').click(function(e) {
		        //click event for left clicks only! http://www.jacklmoore.com/notes/click-events
		        if (!(e.which > 1 || e.shiftKey || e.altKey || e.metaKey)) {
		            e.preventDefault();
		            if ($(this).parent().find('.menu').hasClass('expanded-mobile-menu')) {
		                $(this).removeClass('expanded-menu-toggle').parent().removeClass('nav-expanded').find('.menu').removeClass('expanded-mobile-menu');
		            } else {
		                $(this).addClass('expanded-menu-toggle').parent().addClass('nav-expanded').find('.menu').addClass('expanded-mobile-menu');
		            }
		        }
		    });
		    var navPosition=$('.header').offset().top;


			//STICKY MENU
			$(window).scroll(function(){
			  var navTop=$(window).scrollTop();
			  if(navPosition < navTop){
			    $('.header').addClass('fixed');
			  }
			  else{
			    $('.header').removeClass('fixed');
			  }
			});
			AOS.init();
		</script>
		<?php if (is_front_page()) { ?>
		<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/main.js"></script>
		
		<?php } elseif (is_page(array('service','careers'))) { ?>
			<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.flexslider-min.js"></script>
			<script>
			$('.flexslider').flexslider({
			    animation: "slide"
			  });

			</script>
		<?php } ?>
	</body>
</html>
