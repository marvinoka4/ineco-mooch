<?php
/**
 * Footer file
 */
?>

<style>

  .container{
    max-width: 1170px;
    margin:auto;
  }
  .row{
    display: flex;
    flex-wrap: wrap;
    padding-top: 35px;
    padding-bottom: 70px;
  }
  .footer-div {
    width: 100%;
    position: relative;
  }
  .overlay {
    top: 0;
    left: 0;
    z-index:99;
    width: 100%;
    position: absolute;
    background-size: contain;
    background-repeat: no-repeat;
    background-position: top left, 50%, 50%;
    background-image: url('/wp-content/uploads/2024/06/Ineco-Black-Cropped.svg');
  }
  .overlay-image{
    width: 100%;
    height: 100%;
    background-color: rgba(225, 243, 246, 0.95);
  }
  .footer-div h2 {
    margin-top: 170px;
    font-size: 3em;
  }
  .footer-div p {
    font-size: 16px;
    color: #2d636c;
  }
  ul{
    list-style: none;
    padding: 0;
  }
  .footer-col-left{
    width: 25%;
    padding: 0 15px;
  }
  .footer-col-right{
    width: 40%;
    padding: 0 15px;
  }
  .footer-col h3{
    font-size: 16px;
    color: #7ea7a7;
    text-transform: capitalize;
    margin-bottom: 35px;
    position: relative;
  }
  .footer-col h4{
    font-size: 16px;
    color: #7ea7a7;
    text-transform: capitalize;
    margin-bottom: 35px;
    position: relative;
  }
  .footer-col h5{
    font-size: 16px;
    color: #7ea7a7;
    text-transform: capitalize;
    position: relative;
  }
  .footer-col ul li:not(:last-child){
    margin-bottom: 10px;
  }
  .footer-col ul li a{
    font-size: 16px;
    text-transform: capitalize;
    text-decoration: none;
    color: #2d636c;
    display: block;
  }
  .footer-col ul li a:hover{
    color: #000;
  }
  .footer-col .social-links a{
    width: 40px;
    height: 40px;
    text-align: left;
    color: #2d636c;
    display: inline-block;
    margin:5px 0 0 0;
    transition: all 0.1s ease;
    background-color: transparent;
  }
  .social-links {
    margin-bottom: 35px;
  }
  .phone {
    margin-bottom: 35px;
  }
  .phone a{
    color: #2d636c;
    text-decoration: none;
  }
  .email {
    margin-bottom: 35px;
  }
  .email a{
    color: #2d636c;
    text-decoration: none;
  }
  .mt-35{
    margin-top: 35px;
  }
  .newsletter input[type="email"] {
    padding: 0 !important;
    border: 0 !important;
    border-bottom: 1px solid #2d636c !important;
    border-radius: 0 !important;
    background: transparent;
    color: #2d636c !important;
    line-height: 2;
  }
  .newsletter input[type="email"]:focus {
    border: none;
    background-color: transparent;
    outline: 0;
    width: 300px;
    height: 30px;
  }
  .newsletter input[type="email"]::placeholder {
    color: #2d636c;
    opacity: 1;
  }
  .newsletter input[type="email"]::-ms-input-placeholder {
    color: #2d636c;
  }
  .newsletter .cf7-form > div input.wpcf7-submit {
    margin: 0;
    color: #e1f3f6;
    font-size: 15px;
    position: relative;
    padding: 10px 35px;
    border-radius: 50px;
    text-decoration: none;
    display: inline-block;
    background-color: #2d636c;
    border: 1px solid #2d636c;
    transition: color 300ms, transform 300ms, background-color 300ms, border-color 300ms;
  }
  .newsletter .cf7-form > div input.wpcf7-submit:hover {
    color: #2d636c;
    background-color: #e1f3f6;
    border-color: #2d636c;
    transform: scale(1.05);
  }
  .cf7-form p {
    display: inline-flex;
  }
  .cf7-form p br {
    display: none;
  }
  .cf7-form div {
    display: flex;
    margin-bottom: 35px;
  }
  .ineco-logo{
    width: 100%;
    height: 110px;
    margin-top: 35px;
    background-size: contain;
    background-position: center;
    background-repeat: no-repeat;
    background-image: url('/wp-content/uploads/2024/06/Logo-Green.svg');
  }
  .bottom {
    width: 100%;
    display: flex;
    justify-content: flex-start;
    align-items: center;
    margin-top: 35px;
    font-size: 12px;
  }
  .bottom p{
    font-size: 12px;
    width: 25%;
    padding: 0 15px;
    color: #7ea7a7;
  }
  .bottom a{
    font-size: 12px;
    text-transform: capitalize;
    text-decoration: none;
    color: #7ea7a7;
    display: block;
    width: 25%;
    padding: 0 15px;
  }

  /*responsive*/
  @media(max-width: 767px){
    .footer-col-left{
      width: 100%;
      text-align: center;
      margin-bottom: 30px;
    }
    .footer-col-right{
      width: 100%;
      text-align: center;
      margin-bottom: 30px;
    }
    .bottom p{
      width: 75%;
    }
    .bottom a{
      width: 25%;
    }
    .newsletter .cf7-form > div input.wpcf7-submit {
      margin-top: 15px;
    }
    .overlay {
      background-position: bottom;
    }
  }
  @media(max-width: 574px){
    .footer-col-left{
      width: 100%;
      text-align: center;
    }
    .footer-col-right{
      width: 100%;
      text-align: center;
    }
    .bottom p{
      width: 75%;
    }
    .bottom a{
      width: 25%;
    }
    .newsletter .cf7-form > div input.wpcf7-submit {
      margin-top: 15px;
    }
    .overlay {
      background-position: bottom;
    }
  }

</style>

<footer class="footer-div" id="site-footer">
  <script>
    $( "[href='#carbon-calc-pop']" ).on( "click", function() {
      $( "#carbon-calc" ).css("display", "block");
    } );

    $( "#carbon-calc-x" ).on( "click", function() {
      $( "#carbon-calc" ).css("display", "none");
    } );
  </script>

  <?php
  $headerLogoGroup = get_field('logo', 'option');
  $headerLogo = $headerLogoGroup['inverse'];
  $cta = get_field('call_to_action', 'option');
  $call_us = $cta['call_us'];
  $email_us = $cta['email_us'];
  $footerLinks = get_field('footer_links', 'option');
  $followUs = $footerLinks['follow_us'];
  $findUs = $footerLinks['find_us'];
  ?>

  <div class="overlay">
    <div class="overlay-image">
      <div class="container">
        <div class="row">
          <div class="footer-col footer-col-left">
            <h4 class="mt-35">Navigation</h4>
            <ul>
                <?php

                $arrayMenu = wp_get_nav_menu_items("CompressedMenu");
                foreach ($arrayMenu as $navItem ) {

                    ?><li><a href="<?php echo $navItem->url; ?>" title="<?php echo $navItem->title; ?>"><?php echo $navItem->title; ?></a></li><?php

                }

                ?>
            </ul>
          </div>

          <div class="footer-col footer-col-left">
            <h4 class="mt-35">Connect</h4>


            <div class="phone">
              <h5>Call Us</h5>
                <?php
                if( $call_us ):
                    $link_url = $call_us['url'];
                    $link_title = $call_us['title'];
                    $link_target = $call_us['target'] ? $call_us['target'] : '_self';
                    ?>
                  <a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
                <?php endif; ?>
            </div>

            <div class="email">
              <h5>Email Us</h5>
                <?php
                if( $email_us ):
                    $link_url = $email_us['url'];
                    $link_title = $email_us['title'];
                    $link_target = $email_us['target'] ? $email_us['target'] : '_self';
                    ?>
                  <a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
                <?php endif; ?>
            </div>

            <div class="location">
              <h5>Visit Us</h5>
                <?php echo $findUs; ?>
            </div>

          </div>

          <div class="footer-col footer-col-right">
            <div class="newsletter">
                <?php echo do_shortcode('[contact-form-7 id="579c6e9" title="Newsletter Signup"]'); ?>
            </div>

            <h5>Follow Us</h5>
            <div class="social-links">
                <?php
                if( $followUs ) {
                    foreach( $followUs as $row ) {
                        $link = $row['link'];
                        $icon = $row['icon'];
                        if( $link ):
                            $link_url = $link['url'];
                            $link_title = $link['title'];
                            $link_target = $link['target'] ? $link['target'] : '_self';
                            ?>
                          <a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo $icon; ?></a>
                        <?php endif;
                    }
                } ?>
            </div>
            <div class="ineco-logo"></div>
          </div>

          <div class="bottom">
            <p><?php echo esc_html(get_field('copyright_text', 'option')); ?></p>
            <a href="#">Downloads</a>
          </div>

        </div>
      </div>

    </div>

  </div>

  <!-- Animate on Scroll (Body) -->
  <script>
    $( document ).ready(function() {
      AOS.init({
        once: true,
        duration: 1000,
      });
    });
  </script>

  <style>
    #cutout-intro {
      position: sticky;
      height: 0 !important;
      z-index: 500;
      top: 0;
      pointer-events: none;
    }

    #cutout-intro .inside {
      height: 100vh;
      width: 100vw;
      display: flex;
      align-items: center;
      justify-content: center;
      pointer-events: none;
    }
    #cutout-intro .inside .obj {
      background-image: url('/wp-content/uploads/2024/04/Ineco-Icon-inverted-White.svg');
      margin: auto;
      z-index: -1;
      height: 400px;
      width: 400px;
      box-shadow: 0 0 0 1000vw white;
      pointer-events: none;
      border-radius: 50%;
    }
  </style>

  <?php if (is_front_page()) { ?>
    <script>
      $( document ).ready(function() {
        // gsap.to("#cutout-intro .inside .obj", {borderRadius: "10%", duration: 2.2, delay: 0.7, ease: "elastic.inOut(1.8,1)",});
        gsap.to("#cutout-intro .inside", {rotation: 90, duration: 4, delay: 0,});
        gsap.to("#cutout-intro .inside", {scale: 6, opacity: 0, duration: 1.5, delay: 1, ease: "elastic.inOut(1.8,1)", display: "none"});
        gsap.set("html", {delay: 1.7, overflowY: "auto"});
      });
    </script>
  <?php } else { ?>
    <style>
      html {
        overflow-y: auto !important;
      }
    </style>
  <?php } ?>


</footer>

<?php wp_footer(); ?>
</div>
</body>
</html>