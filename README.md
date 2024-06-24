<div align="center">

  <h3 align="center">InEco Energy</h3>

   <div align="center">
     Page Restructure and Social Sharing.
    </div>
</div>

## <a name="table">Contents</a>

1. [Brief](#brief)
2. [Points to Note](#to-note)
3. [Code Snippets](#snippets)


## <a name="brief">Task Brief</a>

- The original design had the author info box on the right hand side. Now they want it put the author info box at the bottom so that the main content takes up the entire width of the page. The author box is to be moved to the bottom and widened a bit to make up for it being at the bottom rather than the side now.
- Above the author box, social icons are to be added which will automatically open the associated social media with prepopulated fields: (for example: Clicking Facebook icon should open FaceBook in a new tab posting something like "I just read this article on InEco: <link to article>").
- Under the main post title, just show the date in long format, no more extra info.
- Remove the bottom Follow Us section, the one with the image of the pig the client doesn't want it anymore.
- Also at the bottom of the page there is a related news area, the news image will need swapping around similar to the previous task. (This part doesn't need to be worked on now).

## <a name="to-note">Points to Note</a>

- I have worked on all aspects of the task (even the one you asked me to leave for later, pardon me, styling the singular template translated the styles to the related news section as well and I just left them instead of isolating).
- The social sharing needs to be tested, I have added the links to the social media platforms, but it would have to be on to the staging server to test it. LinkedIn and Facebook sharing do not work well with local host.
- Sharing to Instagram will not work as it does not have a direct sharing link system like LinkedIn and Facebook. I spent some time researching it and couldn't find an efficient way to execute it. Mainly because Instagram does not allow sharing from external sources.
- While researching, I found that Instagram does not allow sharing from external sources.

**According to [Instagram](https://developers.facebook.com/docs/instagram)**:

- At this time, uploading via the API is not possible. We made a conscious choice not to add this for the following reasons:
  - Instagram is about your life on the go – we hope to encourage photos from within the app. However, in the future we may give whitelist access to individual apps on a case by case basis.
  - We want to fight spam & low quality photos. Once we allow uploading from other sources, it's harder to control what comes into the Instagram ecosystem. All this being said, we're working on ways to ensure users have a consistent and high-quality experience on our platform.
  Therefore, currently you cannot upload photos from your WordPress site into your instagram account.

## <a name="snippets">Code Snippets</a>

If you'd prefer not to replace any of the existing files with the updated ones, here are core aspects of the code that I edited and that can be lifted and included in the codebase.

If issues arise from including these files/ code snippets, I could review them when no one is working on the staging server, pull down the most recent version, update it, test it, and push it back to the server during inactive hours.

<details>
<summary><code>singular.php</code></summary>

```php
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
      width: 60%;
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
          <a href="#" target="_blank" rel="noopener"><i class="fa-classic fa-brands fa-instagram share-media" aria-hidden="true"></i></a>
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
```

</details>


<details>
<summary><code>layouts/news.php</code></summary>

```php

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
```
</details>


#
