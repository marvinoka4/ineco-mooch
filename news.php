<?
// Arguments

?>

<style>
  .news {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    margin-bottom: 50px;
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
    .content {
      order: 1;
      padding-left: 30px !important;
    }

  }
</style>

<div class="container">
	<?php
		$args = array(
			'post_type' => 'post',
			'orderby' => 'date',
			'post_Status' => 'publish',
			'order' => 'DESC',
			'posts_per_page' => 6
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
	<a id="load-more-news" class="button hover-effect">Load More
		<div class="hover"></div>
	</a>
</div>

<script>
	$( document ).ready(function() {
		$("#load-more-news").on("click", function() {
			$("#load-more-news").attr("loading", true);
			loadMoreNews();
		});
		
		
		gsap.set('#<?php echo $idz; ?> .container .news-holder .news', {
			x: 150,
			opacity: 0,
		});
		
		gsap.to('#<?php echo $idz; ?> .container .news-holder .news', {
			x: 0,
			opacity: 1,
			duration: 1.5,
			
			stagger: {
				each: 0.2,
			},
			
			scrollTrigger: {
				trigger: "#<?php echo $idz; ?> .container",
				start: "+=60% bottom",
			}
		});
	});
</script>