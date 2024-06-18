<div align="center">

  <h3 align="center">InEco Energy</h3>

   <div align="center">
     Implementation of filter for custom post type - Project, and rebuilding the footer section.
    </div>
</div>

## <a name="table">Contents</a>

1. [Brief](#brief)
2. [Points to Note](#to-note)
3. [Code Snippets](#snippets)


## <a name="brief">Task Brief</a>

- Build a product filter that automatically fetches all the Project Categories (A custom taxonomy id: 'project-category') and lists them out as buttons.
- When a button is clicked, the projects should be filtered by the category. Including any results retrieved via the ajax load more button.
- Add a sort dropdown in the same style that can sort the currently filtered results including anything retrieved by the ajax load more. Include the usual sort options e.g. Sort by Newest, Sort by Oldest, Sort by Author, Sort by Name.
- Build a responsive footer as per the design provided. 

## <a name="to-note">Points to Note</a>

- I had to restructure some of the code to be able to implement functionality. I tried keeping it to a minimum, but in some cases it was unavoidable.
- I edited some of the graphics to suit the design more closely. I was able to call all of them from the media library. I updated both my local server and the staging server with these files.
- The social icons do not match the design exactly, since they were being rendered from the WordPress backend. I had to use the icons from the media library and make them as close as possible to the website theme.
- The "Load More" button doesn't retrieve filtered data, and the sort dropdown still needs some work. I should be able to get around it with a few more hours of work.
- The "Load More" is particularly tricky because there is some functionality built around it and attempts to build on existing functionality haven't yielded just yet. I will continue to work on this and update the code as needed.
- I am sorry that this wasn't absolutely ready by Monday as agreed. I would do better to access further projects and give a more accurate estimate of the time needed to complete it.

## <a name="snippets">Code Snippets</a>

In the event that you'd prefer not to replace any of the existing files with the updated ones, here are core aspects of the code that I edited and that can be lifted and included in the codebase. Apart from the "load more" and sorting from the dropdown functionality, the rest of the code should work as expected.

If issues arise from including these files/ code snippets, I could take a look at it when no one is working on the staging server, pull down the most recent version, update it, test it and push it back to the server during inactive hours.

<details>
<summary><code>assets/js/ajax.js</code></summary>

```javascript
$(document).ready(function() {
  $('.cat-list-item').on('click', function(event) {
    (event).preventDefault();
    $('.cat-list-item').removeClass('active');
    $(this).addClass('active');

    var category =$(this).data('category');

    $.ajax({
      type: "POST",
      dataType: "html",
      url:  ajax_projects.ajaxurl,
      data: {
        action: 'filter_projects',
        type: $(this).data('type'),
        category: $(this).data('category'),
      },
      success: function(res) {
        $('#projects').html(res);
      },
      error: function(result){
        console.warn(result);
      }
    });
  });
});
```

</details>

<details>
<summary><code>function.php</code></summary>

```php
function filter_projects() {
    $postType = $_POST['type'];
    $termSlug = $_POST['category'];

    $args = array(
        'post_type' 		=>	$postType,
        'posts_per_page'	=>	6,
        'paged'				=>	1,
    );

    if ( ! empty( $termSlug ) ) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'project-category',
                'terms'    => $termSlug,
            ),
        );
    }

    $wp_query = new WP_Query($args);

    if($wp_query->have_posts()): while($wp_query->have_posts()) : $wp_query->the_post();
    get_template_part('layouts/project_list_item.php');
    endwhile;
    wp_reset_postdata();
    else :
        echo "No Projects Found";
        $response = 'empty';
    endif;
    wp_die();

}

add_action('wp_ajax_filter_projects', 'filter_projects');
add_action('wp_ajax_nopriv_filter_projects', 'filter_projects');
```

</details>

<details>
<summary><code>footer.php</code></summary>

```php
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
```

</details>


<details>
<summary><code>layouts/projects.php</code></summary>

```php
<div class="filter cat-container">
  <ul class="cat-list">
    <li><a class="button cat-list-item active" href="#!" data-slug="" style="display: none">All Projects</a></li>

      <?php $terms = get_terms(array(
          'taxonomy'		=>	'project-category',
          'hide_empty'	=>	false
      ));

      foreach ($terms as $term) { ?>
        <li>
          <a class="button cat-list-item" href="#!" data-slug="<?= $term->slug; ?>" data-category="<?= $term->term_id; ?>" data-type="project"><?php echo esc_html($term->name); ?></a>
        </li>
      <?php } ?>
  </ul>

  <div class="sort-container">
    <p class="sort-text">Sort by</p>
    <form action="#" class="sort-div" id="sort-div">
      <select name="sort" id="sort" class="sort" onchange="this.form.submit()">
        <option selected value="date-DESC">Newest</option>
        <option value="date-ASC">Oldest</option>
        <option value="author">Author</option>
        <option value="name">Name</option>
      </select>
      <input type="hidden" name="action" value="sort-filter" />
    </form>
  </div>
</div>

<div id="projects" class="project-container">

  <?php
  $order =  explode('-', esc_attr($_POST['sort-div']));
  $wp_query = new WP_Query([
      'post_type' => 'project',
      'posts_per_page' => 6,
      'orderby' => $order[0],
      'order' => $order[1],
      'paged' => 1,
  ]);
  ?>

  <?php if($wp_query->have_posts()): ?>

      <?php
      while($wp_query->have_posts()) : $wp_query->the_post();

      get_template_part('layouts/project_list_item');

      endwhile;
      ?>

      <?php wp_reset_postdata(); ?>

  <?php endif; ?>

</div>
```
</details>


<details>
<summary><code>layouts/project_list_item.php</code></summary>

```php
<a href="<?php echo esc_url(get_the_permalink()); ?>" class="project">
    <div class="background" style="background-image: url('<?php if (has_post_thumbnail()) { echo esc_url(get_the_post_thumbnail_url()); } else { echo '/wp-content/uploads/2024/04/CTA-Graphic.png'; } ?>');"></div>
    <div class="inside">
        <h3><?php echo esc_html(get_the_title()); ?></h3>

        <p class="cat">
            <?php
            $termList = get_the_terms($post->ID, 'project-category');
            $termPluckList = wp_list_pluck($termList, 'name');
            $termJoined = join(', ', $termPluckList);
            echo $termJoined;
            ?>
        </p>
    </div>
    <div class="hover">
        <div class="second-background"></div>
        <?php
        $stat1 = get_field('stat_1', $post->ID);
        $stat2 = get_field('stat_2', $post->ID);
        $stat3 = get_field('stat_3', $post->ID);

        $stat1Val = $stat1['prefix_suffix']['prefix'] . $stat1['stat_value'] . $stat1['prefix_suffix']['suffix'];
        $stat2Val = $stat2['prefix_suffix']['prefix'] . $stat2['stat_value'] . $stat2['prefix_suffix']['suffix'];
        $stat3Val = $stat3['prefix_suffix']['prefix'] . $stat3['stat_value'] . $stat3['prefix_suffix']['suffix'];
        ?>
        <div class="stat">
            <p class="stat-title"><?php echo $stat1['stat_name']; ?></p>
            <p class="stat-val"><?php echo $stat1Val; ?></p>
        </div>
        <div class="stat">
            <p class="stat-title"><?php echo $stat2['stat_name']; ?></p>
            <p class="stat-val"><?php echo $stat2Val; ?></p>
        </div>
        <div class="stat">
            <p class="stat-title"><?php echo $stat3['stat_name']; ?></p>
            <p class="stat-val"><?php echo $stat3Val; ?></p>
        </div>
    </div>
</a>
```
</details>


#
