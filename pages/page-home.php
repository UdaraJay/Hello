<?php /* Template Name: Home */ ?>

<?php get_header(); ?>

<div id="homepage">
  <div class="landing">
    <div id="wrapper">
      <h1><?php echo get_theme_mod( 'homepage_title' ); ?></h1>
      <h2><?php echo get_theme_mod( 'homepage_des' ); ?></h2>
        <a href="<?php echo get_theme_mod( 'say_hello_link' ); ?>"><div class="say-hello animated fadeInUp"><div class="icon" data-icon="&#xe021;"></div> Say Hello</div></a>
    </div>
  </div>

  <div class="writing">
    <div id="wrapper">
    <div class="title">Recent writing</div>
    <div class="two-articles">

        <?php
          $args = array(
            'numberposts' => 1,
            'post__in'  => get_option( 'sticky_posts' ),
  	        'ignore_sticky_posts' => 1
          );
          $catquery = new WP_Query($args);
        ?>
        <?php while($catquery->have_posts()) : $catquery->the_post(); ?>

          <div class="post">
            <div class="image" style="background:url('<?php echo get_the_post_thumbnail_url(get_the_ID(),'full') ?>')"></div>
            <div class="content">
              <a href="<?php the_permalink() ?>" rel="bookmark"><div class="title"><?php the_title(); ?></div>
              <div class="summary"><?php the_excerpt() ?></div>
              </a>
            </div>
          </div>

        <?php endwhile;
            wp_reset_postdata();
        ?>

        <?php
          $args = array(
            'numberposts' => 1,
            'posts_per_page' => 1,
  	        'ignore_sticky_posts' => 1
          );
          $catquery = new WP_Query($args);
        ?>
        <?php while($catquery->have_posts()) : $catquery->the_post(); ?>
          <div class="post post_1">
            <div class="overlay"></div>
            <div class="image" style="background:url('<?php echo get_the_post_thumbnail_url(get_the_ID(),'full') ?>')"></div>
            <div class="content">
              <a href="<?php the_permalink() ?>" rel="bookmark"><div class="title"><?php the_title(); ?></div>
              <div class="summary"><?php the_excerpt() ?></div>
              </a>
            </div>
          </div>
        <?php endwhile; wp_reset_postdata();
        ?>
    </div>
    </div>
  </div>

</div>

<?php get_footer(); ?>
