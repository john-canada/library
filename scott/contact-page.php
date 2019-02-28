<?php

/*

 *Template Name: Contact Template

 */

get_header(); ?>



<div class="contact_template">

<div class="contact_sec1">

    <div class="container">

        <div class="row">

            

            <div class="col-sm-12 contact_text">

                <div class="contact_on_us">

                    <?php while(have_posts()):the_post(); ?>

                    	<?php the_content(); ?>

                    <?php endwhile; ?>

                </div>

                <div class="with_form font_style_1">

                        <?php echo do_shortcode('[contact-form-7 id="5046" title="Work With Us"]') ?>

                </div>

            </div>

        </div>

    </div>

</div>

</div>

<!---new check out form---->

<div class="container123">
        <h1 class="checkout-form">Checkout Form</h1>
        <form class="form cf">
            <section class="plan cf">
                <h2 class="h2class">Choose a plan:</h2>
                <input type="radio" name="radio1" id="free" value="free"><label class="free-label four col" for="free">Free</label>
                <input type="radio" name="radio1" id="basic" value="basic" checked><label class="basic-label four col" for="basic">Basic</label>
                <input type="radio" name="radio1" id="premium" value="premium"><label class="premium-label four col" for="premium">Premium</label>
            </section>
            <section class="payment-plan cf">
                <h2 class="h2class">Select a payment plan:</h2>
                <input type="radio" name="radio2" id="monthly" value="monthly" checked><label class="monthly-label four col" for="monthly">Monthly</label>
                <input type="radio" name="radio2" id="yearly" value="yearly"><label class="yearly-label four col" for="yearly">Yearly</label>
            </section>
            <section class="payment-type cf">
                <h2 class="h2class">Select a payment type:</h2>
                <input type="radio" name="radio3" id="credit" value="credit"><label class="credit-label four col" for="credit">Credit Card</label>
                <input type="radio" name="radio3" id="debit" value="debit"><label class="debit-label four col" for="debit">Debit Card</label>
                <input type="radio" name="radio3" id="paypal" value="paypal" checked><label class="paypal-label four col" for="paypal">Paypal</label>
            </section>  
            <input class="submit" type="submit" value="Submit">     
        </form>
    </div>



<!-----The new ------->
<dic class="container">
<div class="container-price-card">
   <div class="grid">
    <div class="card card1">
      <h3>BASIC</h3>
      <h2>Free</h2>
      <h4>Free</h4>
      <hr>
      <p>10 templates</p>
      <p>Default presets</p>
      <a href="#">Buy now</a>
    </div>
   
    <div class="card card3">
      <h3>ULTIMATE</h3>
      <h2>250</h2>
      <h4>$250</h4>
      <hr>
      <p>Unlimited templates</p>
      <p>Ultimate presets</p>
      <a href="#">Buy now</a>
   </div>
     <div class="card card2">
      <h3>PRO</h3>
      <h2>100</h2>
      <h4>$100</h4>
      <hr>
      <p>50 templates</p>
      <p>Pro presets</p>
      <a href="#">Buy now</a>
    </div>
  </div>
</div>
</div>

<?php get_footer(); ?>