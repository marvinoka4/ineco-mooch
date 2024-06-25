<style>
  .news {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
  }
  .share-media {
    color: #2d636c;
    padding: 0 10px;
  }
  .share-text {
    color: #2d636c;
    font-size: 16px;
    cursor: default;
    padding-right: 10px;
  }


  /* Extra small devices (phones, 600px and down) */
  @media only screen and (max-width: 600px) {
    .content {
      order: 1;
      padding-left: 30px !important;
    }
    .mid {
      display: block !important;
    }
    .mid .content {
      width: 100% !important;
      padding-left: 0 !important;
    }
    .mid .right {
      width: 100% !important;
      display: flex;
      flex-wrap: wrap;
      align-items: flex-start;
      justify-content: center;
      flex-direction: column;
      padding-left: 0 !important;
    }
    .box {
      order: 2;
      width: 80%;
      display: flex;
      flex-direction: row;
      justify-content: space-between;
    }
    .box-left {
      width: 35%;
      text-align-last: center;
    }
    .box-right {
      width: 55%;
      padding-left: 30px;
    }
    .share-links {
      order: 1;
      display: flex;
      flex-direction: row;
      justify-content: space-between;
      margin: 30px 0;
    }
  }

  /* Small devices (portrait tablets and large phones, 600px and up) */
  @media only screen and (min-width: 600px) {
    .content {
      order: 1;
      padding-left: 30px !important;
    }
    .mid {
      display: block !important;
    }
    .mid .content {
      width: 100% !important;
      padding-left: 0 !important;
    }
    .mid .right {
      width: 100% !important;
      display: flex;
      flex-wrap: wrap;
      align-items: flex-start;
      justify-content: center;
      flex-direction: column;
      padding-left: 0 !important;
    }
    .box {
      order: 2;
      width: 90%;
      display: flex;
      flex-direction: row;
      justify-content: space-between;
    }
    .box-left {
      width: 30%;
      text-align-last: center;
    }
    .box-right {
      width: 60%;
      padding-left: 30px;
    }
    .share-links {
      order: 1;
      display: flex;
      flex-direction: row;
      justify-content: space-between;
      margin: 30px 0;
    }

  }


  /* Large devices (laptops/desktops, 1200px and up) */
  @media only screen and (min-width: 1200px) {
    .news-holder {
      row-gap: 0 !important;
    }
    .news {
      padding-bottom: 10px !important;
      margin-bottom: 10px !important;
    }
    .content {
      order: 1;
      padding-left: 30px !important;
    }
    .mid {
      display: block !important;
    }
    .image-holder {
      order: 1;
      width: 30% !important;
      margin-left: 0 !important;
      border-radius: 8px !important;
    }
    .main {
      order: 2;
    }
    .misc {
      order: 2;
    }
    .mid .content {
      width: 100% !important;
      padding-left: 0 !important;
    }
    .mid .right {
      width: 100% !important;
      display: flex;
      flex-wrap: wrap;
      align-items: flex-start;
      justify-content: center;
      flex-direction: column;
      padding-left: 0 !important;
    }
    .box {
      order: 2;
      width: 60% !important;
      display: flex;
      flex-direction: row;
      justify-content: space-between;
    }
    .box-left {
      width: 20%;
      text-align-last: center;
    }
    .box-right {
      width: 70%;
      padding-left: 30px;
    }
    .share-links {
      order: 1;
      display: flex;
      flex-direction: row;
      justify-content: space-between;
      margin: 30px 0;
    }
  }
</style>


<?php
$category = get_the_category();
$catName = $category[0]->cat_name;
$catID = $category[0]->cat_ID;


$link = get_the_permalink();
$title = get_the_title();
$newTitle = 'I just read this article on InEco: '. $title;
?>

<?php get_header(); ?>

<?php
if( get_post_type() == 'project' ) {
	if( have_rows('layouts') ) {
		while( have_rows('layouts') ) {
			the_row();

			// Row Options
			$ID = uniqid('id_', true);
			$ID = str_replace(".", "_", $ID);
			$backgroundColour = get_sub_field('background_colour');
			$spacing = get_sub_field('spacing');
			$anim = get_sub_field('animation');

			$paddingTopDesktop = $spacing['padding_top_desktop'];
			$paddingBottomDesktop = $spacing['padding_bottom_desktop'];
			$marginTopDesktop = $spacing['margin_top_desktop'];
			$marginBottomDesktop = $spacing['margin_bottom_desktop'];

			$paddingTopTablet = $spacing['padding_top_tablet'];
			$paddingBottomTablet = $spacing['padding_bottom_tablet'];
			$marginTopTablet = $spacing['margin_top_tablet'];
			$marginBottomTablet = $spacing['margin_bottom_tablet'];

			$paddingTopMobile = $spacing['padding_top_mobile'];
			$paddingBottomMobile = $spacing['padding_bottom_mobile'];
			$marginTopMobile = $spacing['margin_top_mobile'];
			$marginBottomMobile = $spacing['margin_bottom_mobile'];

			// Args Setup
			$rowOptions = array(
				'uniqueID' => $ID,
				'backgroundColour' => $backgroundColour,
				'anim' => $anim,
			);

			$layoutName = get_row_layout();
			?>
			<section id="<?php echo $ID; ?>" class="<?php echo get_row_layout(); ?>" style="background-color: <?php echo $backgroundColour;?>;">
				<?php get_template_part( "layouts/$layoutName", null, $rowOptions ); ?>

				<style>
					section#<?php echo $ID; ?> {
						padding-top: <?php echo $paddingTopDesktop; ?>px;
						padding-bottom: <?php echo $paddingBottomDesktop; ?>px;
						margin-top: <?php echo $marginTopDesktop; ?>px;
						margin-bottom: <?php echo $marginBottomDesktop; ?>px;
					}

					@media only screen and (max-width: 1200px) {
						section#<?php echo $ID; ?> {
							padding-top: <?php echo $paddingTopTablet; ?>px;
							padding-bottom: <?php echo $paddingBottomTablet; ?>px;
							margin-top: <?php echo $marginTopTablet; ?>px;
							margin-bottom: <?php echo $marginBottomTablet; ?>px;
						}
					}

					@media only screen and (max-width: 782px) {
						section#<?php echo $ID; ?> {
							padding-top: <?php echo $paddingTopMobile; ?>px;
							padding-bottom: <?php echo $paddingBottomMobile; ?>px;
							margin-top: <?php echo $marginTopMobile; ?>px;
							margin-bottom: <?php echo $marginBottomMobile; ?>px;
						}
					}
				</style>
			</section>
			<?php
		}
	}
} else {
	$postText = trim( strip_tags( get_the_content() ) );
	$wordCount = substr_count( "$postText ", ' ' );
	$readTime = round($wordCount / 200);
	if ($readTime == 0) {
		$readTime = 'Less than 1';
	}
	?>
	<div class="main-post-content">
		<div class="top">
			<h1><?php esc_html(the_title()); ?></h1>
			<div class="misc"><h3>Published by: <?php
              $author_id = get_the_author_meta('ID');
              echo esc_html(get_the_author_meta('display_name', $author_id)); ?></h3><span></div>
			<?php
			if (has_post_thumbnail()) {
				the_post_thumbnail();
			}
			?>
		</div>
		<div class="mid">
			<div class="content">
				<?php the_content(); ?>
			</div>
			<div class="right">

				<div class="box">
          <div class="box-left">
            <p class="writ">Written By</p>
            <img class="avatar" src="/wp-content/uploads/2024/04/CTA-Graphic.png">
          </div>
          <div class="box-right">
            <p class="auther"><?php echo esc_html(get_the_author_meta('display_name', $author_id)); ?></p>
            <p class="job">Marketing Manager at Ineco Energy</p>
            <p class="desc">Lauren specialises in marketing for the commerical energy sector, she has worked in clean technology for 5 years.</p>
          </div>
				</div>

        <div class="share-links">
          <a class="share-text">Share to</a>
          <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo $link ?>&amp;title=<?php echo $newTitle ?>" target="_blank" rel="noopener"><i class="fa-classic fa-brands fa-linkedin share-media" aria-hidden="true"></i></a>
          <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()) ?>" target="_blank" rel="noopener"><i class="fa-classic fa-brands fa-square-facebook share-media" aria-hidden="true"></i></a>
          <a href="https://x.com/share?url=<?php echo $link ?>&amp;text=<?php echo $newTitle ?>" target="_blank" rel="noopener"><i class="fa-classic fa-brands fa-x-twitter share-media" aria-hidden="true"></i></a>
        </div>


      </div>
		</div>
		</div>

		<div class="bot">
			
			<section class="newsletter_signup">
				<div class="container">
					<?php echo do_shortcode('[contact-form-7 id="579c6e9" title="Newsletter Signup"]'); ?>
				</div>
			</section>
			
			
			<section class="news">
				<div class="container">
					<?php
						$args = array(
							'post_type' => 'post',
							'orderby' => 'date',
							'post_Status' => 'publish',
							'order' => 'DESC',
							'posts_per_page' => 3
						);

						$posts = get_posts($args);
					?>

					<div class="news-holder" id="news">
						<?php foreach ($posts as $post) {
							setup_postdata($post); $id = get_the_ID(); ?>
							<div class="news news-<?php echo $id; ?>">
								<div class="main">
									<div class="inside">
										<div class="misc">
											<p class="date"><?php echo get_the_date() ?></p>
											<?php
												$postText = trim( strip_tags( get_the_content() ) );
												$wordCount = substr_count( "$postText ", ' ' );
												$readTime = round($wordCount / 200);
												if ($readTime == 0) {
													$readTime = 'Less than 1';
												}
											?>
											<p class="read"><?php echo $readTime; ?> min read</p>
										</div>
										<div class="content">
											<h3><?php echo get_the_title(); ?></h3>
											<a href="<?php echo get_the_permalink(); ?>">Read More</a>
										</div>
									</div>
								</div>
								<div class="image-holder">
									<?php the_post_thumbnail(); ?>
								</div>
							</div>
						<?php wp_reset_postdata(); } ?>
					</div>
				</div>
			</section>

		</div>
	<?php
}

echo get_field('custom_code');

get_footer(); ?>