<?
// Arguments
$filter = get_sub_field('filter');
?>

<style>
  .cat-container {
    display: flex;
    margin-bottom: 30px;
  }
  .cat-list{
    padding: 0 10px 0 0;
    width: 80%;
    margin: 0;
    display: flex;
    flex-wrap: wrap;
    flex-direction: row;
    list-style: none;
    justify-content: flex-start;
  }
  .cat-list-item{
    display: inline-block;
    margin-right: 10px;
    margin-bottom: 10px;
    padding: 10px 30px;
    border: 1px solid #000;
    border-radius: 50px;
    text-decoration: none;
    color: #000;
    background: #fff;
    font-size: 14px;
  }
  .cat-list-item.active{
    background: #000;
    color: #fff;
  }
  select {
    -webkit-appearance:none;
    -moz-appearance:none;
    -ms-appearance:none;
    appearance:none;
    outline:0;
    box-shadow:none;
    border:0!important;
    background: transparent none;
    flex: 1;
    padding: 0;
    color:#000;
    cursor:pointer;
  }
  select::-ms-expand {
    display: none;
  }
  .sort-container{
    width: 20%;
    display: flex;
    font-size: 14px;
    height: fit-content;
    justify-content: flex-end;
  }
  .sort-div {
    display: flex;
    padding: 10px 30px;
    border: 1px solid #000;
    border-radius: 50px;
    display: flex;
    overflow: hidden;
    position: relative;
    background: transparent;
  }
  .sort-text {
    align-self: center;
    margin: 0 10px 0 0;
  }

  /*responsive*/
  @media(max-width: 767px){
    .cat-list{
      width: 100%;
    }
    .cat-list-item{
      font-size: 12px;
    }
    .sort-container{
      width: 100%;
      font-size: 12px;
    }
    select {
      font-size: 11px;
    }
  }
  @media(max-width: 574px){
    .cat-list{
      width: 100%;
    }
    .cat-list-item{
      font-size: 12px;
    }
    .sort-container{
      width: 100%;
      font-size: 12px;
    }
    select {
      font-size: 11px;
    }
  }

</style>

<div class="container">

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
        <div class="sort-div">
          <select name="sort" id="sort" class="sort">
            <option selected value="all">Project Size</option>
            <option value="date">Newest Added</option>
            <option value="title">Name</option>
          </select>
        </div>
      </div>
    </div>


  <div id="projects" class="project-container">

      <?php
      $projects = new WP_Query([
          'post_type' => 'project',
          'posts_per_page' => 6,
          'paged'				=>	1,
      ]);
      ?>

      <?php if($projects->have_posts()): ?>

          <?php
          while($projects->have_posts()) : $projects->the_post();

          get_template_part('layouts/project_list_item');

          endwhile;
          ?>

          <?php wp_reset_postdata(); ?>

      <?php endif; ?>

  </div>

  <a id="load-more-projects" class="button hover-effect">Load More
    <div class="hover"></div>
  </a>



  <script>
    $("#load-more-projects").on("click", function() {
      $("#load-more-projects").attr("loading", true);
      loadMoreProjects();
    });

    $( document ).ready(function() {
      gsap.set('#projects .project', {
        y: 50,
        opacity: 0,
      });

      gsap.to('#projects .project', {
        y: 0,
        opacity: 1,
        duration: 0.5,
        stagger: 0.05,

        scrollTrigger: {
          trigger: "#projects",
          start: "+=60% bottom",
        }
      });
    });
  </script>

</div>