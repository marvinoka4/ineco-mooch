
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
