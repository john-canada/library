<?php
/*
 *Template Name: Home Page
 */
get_header(); ?>


<script>
		var TxtType = function(el, toRotate, period) {
        this.toRotate = toRotate;
        this.el = el;
        this.loopNum = 0;
        this.period = parseInt(period, 10) || 2000;
        this.txt = '';
        this.tick();
        this.isDeleting = false;
    };

    TxtType.prototype.tick = function() {
        var i = this.loopNum % this.toRotate.length;
        var fullTxt = this.toRotate[i];

        if (this.isDeleting) {
        this.txt = fullTxt.substring(0, this.txt.length - 1);
        } else {
        this.txt = fullTxt.substring(0, this.txt.length + 1);
        }

        this.el.innerHTML = '<span class="wrap">'+this.txt+'</span>';

        var that = this;
        var delta = 200 - Math.random() * 100;

        if (this.isDeleting) { delta /= 2; }

        if (!this.isDeleting && this.txt === fullTxt) {
        delta = this.period;
        this.isDeleting = true;
        } else if (this.isDeleting && this.txt === '') {
        this.isDeleting = false;
        this.loopNum++;
        delta = 500;
        }

        setTimeout(function() {
        that.tick();
        }, delta);
    };

    window.onload = function() {
        var elements = document.getElementsByClassName('typewrite');
        for (var i=0; i<elements.length; i++) {
            var toRotate = elements[i].getAttribute('data-type');
            var period = elements[i].getAttribute('data-period');
            if (toRotate) {
              new TxtType(elements[i], JSON.parse(toRotate), period);
            }
        }
        // INJECT CSS
        var css = document.createElement("style");
        css.type = "text/css";
        css.innerHTML = ".typewrite > .wrap { border-right: 0.08em solid #fff}";
        document.body.appendChild(css);
    };

</script>


	<div class="Mind-body-section-head">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                   <h2 class="lead_line lead_line2"><?php the_field('testimonials_section_heading_content'); ?></h2>
	</div>	
</div>
</div>
</div>	
   <!-- slogan banner -->
	
  
		 <section class="slogan">
	<img src="<?php the_field('scott_fishmans_image'); ?>" alt="Scott Fishman Avatar" class="avatar" />
    </section>	
  <!-- end slogan banner -->	
    
    <!-- testimonials -->
    <div class="work_content work_home">
	<script>
document.addEventListener('DOMContentLoaded',function(event){
  // array with texts to type in typewriter
  var dataText = [ "Welcome", "Welcome", "Welcome", "Welcome"];
  
  // type one text in the typwriter
  // keeps calling itself until the text is finished
  function typeWriter(text, i, fnCallback) {
    // chekc if text isn't finished yet
    if (i < (text.length)) {
      // add next character to h1
     document.querySelector("h2.welcomes").innerHTML = text.substring(0, i+1) +'<span aria-hidden="true"></span>';

      // wait for a while and call this function again for next character
      setTimeout(function() {
        typeWriter(text, i + 1, fnCallback)
      }, 100);
    }
    // text finished, call callback if there is a callback function
    else if (typeof fnCallback == 'function') {
      // call callback after timeout
      setTimeout(fnCallback, 700);
    }
  }
  // start a typewriter animation for a text in the dataText array
   function StartTextAnimation(i) {
     if (typeof dataText[i] == 'undefined'){
        setTimeout(function() {
          StartTextAnimation(0);
        }, 1000);
     }
     // check if dataText[i] exists
    if (i < dataText[i].length) {
      // text exists! start typewriter animation
     typeWriter(dataText[i], 0, function(){
       // after callback (and whole text has been animated), start next text
       StartTextAnimation(i + 1);
     });
    }
  }
  // start the text animation
  StartTextAnimation(0);
});

</script>


	
	<h2 class="welcomes">Welcome</h2>
	
	<div class="section_new">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                   <h2><?php echo the_field('what_is_your_objective_heading'); ?></h2>
                <div class="benefits-grid">
            
        	    <?php $ark=1; if(have_rows('benefits_items_rep')): while(have_rows('benefits_items_rep')): the_row(); ?>
        	    <a href="<?php the_sub_field('item_link'); ?>">
		    <div class="item gr-sec<?php echo $ark; ?>">
                      <div class="benefits-img">
					<img class="without-rollover" src="<?php the_sub_field('item_icon'); ?>" alt="Personal Transformation" />
					  </div>
					   <div class="benefits-img-roll">
					   <img class="rollover-imgg" src="<?php the_sub_field('item_icon_rollover'); ?>" alt="Personal Transformation">
					     </div>
                      <h2 class="font_style_1"><?php the_sub_field('item_heading'); ?></h2>
                    </div>
		    </a>
		
        	    <?php $ark++; endwhile; endif; ?>
                   
        	   
                 </div>
                </div>
            </div>
        </div>
    </div>
	
	
	<div class="how_to_work_section">
	<div class="container">
	<div class="row">
	<h3><?php echo the_field('main_heading_how_it_work'); ?></h3>
	<div class="how_to_work_grid">
            
        	    <?php $htw=1; if(have_rows('how_it_work')): while(have_rows('how_it_work')): the_row(); ?>
        	    
		    <div class="col-md-3 how-work<?php echo $htw; ?>">
			<div class="how-to-box">
                      <div class="how-work-icon">
					<?php the_sub_field('how_it_work_icon'); ?>
					  </div>
					   
                      <h4><?php the_sub_field('how_it_work_heading_label'); ?></h4>
					  </div>
                    </div>
		    
		
        	    <?php $htw++; endwhile; endif; ?>
                   
        	   
                 </div>
	
	</div>
	</div>
	</div>
	
        <?php if(get_field('item_work')): 
                    $i=0;
                    while(has_sub_field('item_work')):
                    $i++;
                    $col =$i%2;
                  ?>
                    <div class="work_sec">
                        <div class="container">
                            <div class="row2">
                                <?php if($col ==0){
                                    $class_col = 'col_right';
                                    } else { 
                                     $class_col = 'col_left';  
                                    }  ?>
                                    <div class="col-md-12 work_img <?php echo $class_col; ?>">
                                        <div class="icon_work">
                                        <img src="<?php the_sub_field('icon') ?>" />
                                        </div>   
                                    </div>
                                    <div class="col-md-12 work_text">
                                        <h2><?php the_sub_field('title') ?></h2>
                                        <?php if(get_sub_field('content')){ ?>
                                        <div class="main_item_work font_style_1">
                                            <?php the_sub_field('content') ?>
                                        </div>
                                        <?php } ?>
                                       <?php if(get_sub_field('link') && get_sub_field('link_name')) { ?>
				       <div class="link_item_work">
					   <div class="btn1">
                                            <a class="" href="<?php the_sub_field('link') ?>"><?php the_sub_field('link_name') ?></a>
											 <div class="btn2"></div>
											</div>
                                        </div>
				       <?php } ?>
                                    </div>
                            </div>
                        </div>
                    </div>
                	<?php endwhile;  endif; ?>
        </div>
    
    <!-- end testimonials -->

  
    <div class="section_form_ct">
        <div class="container">
            <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-10">
                    <h2 class="ttct">Work With Us</h2>
                    <div class="with_form font_style_1 font_style_form">
                            <?php echo do_shortcode('[contact-form-7 id="5046" title="Work With Us"]') ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
	  <section class="new_post">
      <div class="post-container">
        <div class="row">
          <div class="col-lg-12 new-post_on">
                <h2 class="">INSIGHTS</h2>
          </div>
          <?php
                $args = array(
                	'post_type' => 'post',
                	'posts_per_page' => 4,
                );
                query_posts( $args );
                while ( have_posts() ) : the_post();
            ?>
            <div class="col-sm-3">
                    <div class="post_items">
                        <div class="image_post">
                            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('full'); ?></a>
                        </div>
                        <a href="<?php the_permalink(); ?>">
                        <h3><?php the_title(); ?></h3>
                        <div class="description_post font_style_1a"><?php the_excerpt();  ?></div>
                         </a>
                       <div class="read-btn1">
                        <a href="<?php the_permalink(); ?>">Read More</a>
						<div class="read-btn2"></div>
                        </div>
                    </div>
                </div>
            <?php endwhile; wp_reset_query(); ?>
        </div>
      </div>
    </section>
	  <div class="section_slider">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="wrap_slider">
                    <div class="slider_home">
                        <?php if(get_field('item_slider')): while(has_sub_field('item_slider')): 
                        ?>
                       <div class="item_slider_home">
                            <img src="/wp-content/uploads/2018/11/img-quote.png" />
                            <div class="des_slider font_style_1"><?php the_sub_field('content'); ?></div>
                            <div class="name_slider"><h3><?php the_sub_field('name'); ?></h3></div>
                       </div>
                       <?php endwhile; endif; ?>  
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
  <?php if(get_field('background_sl')){ ?>
  <style>
      .section_slider {
        background: url(<?php the_field('background_sl') ?>);
        background-size: cover !important;
        background-position: center !important;
    }
  </style>
  <?php } ?>
    <div class="section_partner">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 partner_on">
                    <h2><?php the_field('title_pn'); ?></h2>
                    <div class="partner_main">
                        <?php if(get_field('item_partner')): while(has_sub_field('item_partner')): 
                        ?>
                      <a href="<?php the_sub_field('link'); ?>" target="_blank"><img src="<?php the_sub_field('logo'); ?>" /></a>  
                      <?php endwhile; endif; ?>    
                    </div>
                </div>
            </div>
        </div>
    </div>
  
  <?php get_footer(); ?>