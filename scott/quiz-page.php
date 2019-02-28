<?php
/**
 * Template Name: Quiz Page
 */

get_header(); ?>

<div class="content_page">
    <div class="quiz_main">
        <div class="container">
            <div class="row">
                <?php if(get_field('item_quizzes')): 
                 while(has_sub_field('item_quizzes')): ?>
                <div class="col-sm-4">
                    <div class="item_quiz">
                        <div class="show_quiz">
                            <div class="img_quiz">
                                <img src="<?php the_sub_field('image'); ?>" />
                            </div>
                            <h3><?php the_sub_field('title'); ?></h3>
                        </div>
                        <div class="hide_quiz">
                            <div class="content_quiz">
                            <?php the_sub_field('iframe'); ?>
                             </div>
                            <div class="close_quiz"><img src="/wp-content/uploads/2018/10/close.png" /></div>
                        </div>
                        
                    </div>
                </div>
                <?php endwhile;  endif; ?>
            </div>
        </div>
    </div>
</div>
    <script>

    jQuery("document").ready(function(){ 
        jQuery(".show_quiz").click(function(){       
            jQuery(this).parent().children('.hide_quiz').fadeIn();
        });
        jQuery(".close_quiz").click(function(){       
            jQuery('.hide_quiz').fadeOut();
        });    
});
</script>
<?php get_footer(); ?>