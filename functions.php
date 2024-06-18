<?php
function site_enqueue_styles() {
	wp_enqueue_style( 'site-style', get_template_directory_uri() . '/style.css', array(), false, 'all' );
	wp_enqueue_style( 'aos', get_template_directory_uri() . '/assets/css/aos.css', array(), '2.3.4' , false);
	wp_enqueue_style( 'odometer-style', get_template_directory_uri() . '/assets/css/odometer-theme-minimal.css', array(), '2.3.4' , false);
}
add_action( 'wp_enqueue_scripts', 'site_enqueue_styles' );

function site_enqueue_scripts() {
	wp_deregister_script( 'jquery' );
	wp_enqueue_script( 'jquery', get_template_directory_uri() . '/assets/js/jquery-3.7.1.min.js', array(), '3.7.1' );
	wp_enqueue_script( 'aos', get_template_directory_uri() . '/assets/js/aos.js', array(), '2.3.4' );
	
	// The core GSAP library
    wp_enqueue_script( 'gsap-js', get_template_directory_uri() . '/assets/js/gsap.min.js', array(), false, true );
    // ScrollTrigger - with gsap.js passed as a dependency
    wp_enqueue_script( 'gsap-st', get_template_directory_uri() . '/assets/js/ScrollTrigger.min.js', array('gsap-js'), false, true );
	// Flip - with gsap.js passed as a dependency
    wp_enqueue_script( 'gsap-flip', get_template_directory_uri() . '/assets/js/Flip.min.js', array('gsap-js'), false, true );
    // Your animation code file - with gsap.js passed as a dependency
    wp_enqueue_script( 'gsap-js2', get_template_directory_uri() . '/assets/js/gsap-app.js', array('gsap-js'), false, true );
    wp_enqueue_script( 'odometer', get_template_directory_uri() . '/assets/js/odometer.min.js', array(), false, true );
	
	wp_enqueue_script( 'custom_ajax', get_template_directory_uri() . '/assets/js/ajax.js', array(), '1.0' );
	wp_localize_script( 'custom_ajax', 'ajax_projects', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ), 'noposts' => __('No older posts found', 'ineco'), ));
}
add_action( 'wp_enqueue_scripts', 'site_enqueue_scripts' );

function post_features_mod() {
	remove_post_type_support('page', 'editor');
	add_post_type_support( 'post', 'excerpt' );
}
add_action('admin_init', 'post_features_mod');
add_theme_support( 'post-thumbnails' );

// Allow SVG
add_filter( 'wp_check_filetype_and_ext', function($data, $file, $filename, $mimes) {

  global $wp_version;
  if ( $wp_version !== '4.7.1' ) {
     return $data;
  }

  $filetype = wp_check_filetype( $filename, $mimes );

  return [
      'ext'             => $filetype['ext'],
      'type'            => $filetype['type'],
      'proper_filename' => $data['proper_filename']
  ];

}, 10, 4 );

function cc_mime_types( $mimes ){
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter( 'upload_mimes', 'cc_mime_types' );

function fix_svg() {
  echo '<style type="text/css">
        .attachment-266x266, .thumbnail img {
             width: 100% !important;
             height: auto !important;
        }
        </style>';
}
add_action( 'admin_head', 'fix_svg' );

// Ajax Projects
function ajaxMoreProjects() {

    $ppp = (isset($_POST["ppp"])) ? $_POST["ppp"] : 9;
    $page = (isset($_POST['pageNumber'])) ? $_POST['pageNumber'] : 0;

    header("Content-Type: text/html");
	
    $args = array(
        'suppress_filters'	=>	true,
        'post_type' 		=>	'project',
        'posts_per_page'	=>	$ppp,
        'paged'				=>	$page,
		'post__not_in' 		=>	array(
			'posts_per_page'	=>	9,
			'post_type'			=>	'project',
			'paged'				=>	1,
		),
	);

    $loop = new WP_Query($args);

    $out = '';

    if ($loop -> have_posts()) :  while ($loop -> have_posts()) : $loop -> the_post();
	
		if (has_post_thumbnail($post->ID)) {
			$featImg = get_the_post_thumbnail_url(null, 'full');
		} else {
			$featImg = '/wp-content/uploads/2024/04/CTA-Graphic.png';
		}
	
		$termList = get_the_terms($post->ID, 'project-category');
		$termPluckList = wp_list_pluck($termList, 'name');
		$termJoined = join(', ', $termPluckList);
	
		$stat1 = get_field('stat_1', $post->ID);
		$stat2 = get_field('stat_2', $post->ID);
		$stat3 = get_field('stat_3', $post->ID);

		$stat1Val = $stat1['prefix_suffix']['prefix'] . $stat1['stat_value'] . $stat1['prefix_suffix']['suffix'];
		$stat2Val = $stat2['prefix_suffix']['prefix'] . $stat2['stat_value'] . $stat2['prefix_suffix']['suffix'];
		$stat3Val = $stat3['prefix_suffix']['prefix'] . $stat3['stat_value'] . $stat3['prefix_suffix']['suffix'];
			
        $out .= '<a href="' . esc_url(get_the_permalink()) . '" class="project">
				<div class="background" style="background-image: url(' . $featImg . ');"></div>
				<div class="inside">
					<h3>' . esc_html(get_the_title()) . '</h3>

					<p class="cat">' . $termJoined . '</p>
				</div>
				<div class="hover">
					<div class="second-background">
						
					</div>
					<div class="stat">
						<p class="stat-title">' . $stat1["stat_name"] . '</p>
						<p class="stat-val">' . $stat1Val . '</p>
					</div>
					<div class="stat">
						<p class="stat-title">' . $stat2["stat_name"] . '</p>
						<p class="stat-val">' . $stat2Val . '</p>
					</div>
					<div class="stat">
						<p class="stat-title">' . $stat3["stat_name"] . '</p>
						<p class="stat-val">' . $stat3Val . '</p>
					</div>
				</div>
			</a>';

    endwhile;
    endif;
    wp_reset_postdata();
    die($out);
}

add_action('wp_ajax_nopriv_ajaxMoreProjects', 'ajaxMoreProjects');
add_action('wp_ajax_ajaxMoreProjects', 'ajaxMoreProjects');

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

    $projects = new WP_Query($args);

    if($projects->have_posts()): while($projects->have_posts()) : $projects->the_post();
    get_template_part('layouts/project_list_item');
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
