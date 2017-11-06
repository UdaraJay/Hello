<?php /* Template Name: Work */ ?>
<?php get_header(); ?>


  <div id="work">

    <div id="wrapper">
      <h1 class="title-page"><?php the_title(); ?></h1>

      <?php while ( have_posts() ) : the_post(); ?>
        <div class="entry-content-page">
          <?php the_content(); ?> <!-- Page Content -->
          <div class="buttons">
            <?php if(!empty(get_post_meta( get_the_ID(), 'dribbble', true ))){ ?>
              <a href="<?php echo get_post_meta( get_the_ID(), 'dribbble', true ); ?>" class="dribbble" target="_blank"><div class="icon"></div> Dribbble portfolio</a>
            <?php  } ?>
            <?php if(!empty(get_post_meta( get_the_ID(), 'github', true ))){ ?>
              <a href="<?php echo get_post_meta( get_the_ID(), 'github', true ); ?>" class="github" target="_blank"><div class="icon"></div> Github profile</a>
            <?php  } ?>
          </div>
        </div><!-- .entry-content-page -->
      <?php endwhile; wp_reset_query(); ?>

      <div class="posts">
        <?php $query = new WP_Query( array('post_type' => 'work', 'posts_per_page' => 5 ) );
        while ( $query->have_posts() ) : $query->the_post(); ?>

        <a href="<?php the_permalink() ?>">
          <div class="work" style="background: <?php echo get_post_meta( get_the_ID(), 'color', true ); ?>">
            <div class="overlay"></div>
            <div class="image" style="background:url('<?php echo get_the_post_thumbnail_url(get_the_ID(),'full') ?>') no-repeat;"></div>
            <div class="content">
                <a href="<?php the_permalink() ?>"><div class="title"><?php the_title(); ?></div>
                </a>
                <a href="<?php the_permalink() ?>"><div class="tagline"><?php echo get_post_meta( get_the_ID(), 'tagline', true ); ?></div></a>
                <a href="<?php the_permalink() ?>">
                <div class="meta">
                  <div class="field"><?php echo get_post_meta( get_the_ID(), 'field', true ); ?></div>
                  <div class="year"><?php echo get_post_meta( get_the_ID(), 'year', true ); ?></div>
                </div></a>

            </div>
          </div>
        </a>

        <?php wp_reset_postdata(); ?>
        <?php endwhile; ?>
      </div>
    </div>
  </div>


<?php get_footer(); ?>
