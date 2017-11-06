<?php /* Template Name: Resume */ ?>
<?php get_header(); ?>

<div id="resume">
  <div id="wrapper">
    <h1 class="entry-title"><?php the_title(); ?></h1>
    <?php while ( have_posts() ) : the_post(); ?>
      <div class="entry-content-page">
        <?php the_content(); ?> <!-- Page Content -->
        <div class="resumes">
          <?php if(!empty(get_post_meta( get_the_ID(), 'linkedin', true ))){ ?>
            <a href="<?php echo get_post_meta( get_the_ID(), 'linkedin', true ); ?>" class="linkedin" target="_blank"><div class="icon"></div> LinkedIn profile</a>
          <?php  } ?>
          <?php if(!empty(get_post_meta( get_the_ID(), 'resumePDF', true ))){ ?>
            <a href="<?php echo get_post_meta( get_the_ID(), 'resumePDF', true ); ?>" class="download" target="_blank"><div class="icon"></div> Download resume</a>
          <?php  } ?>
        </div>
        <div class="currently_working">
          <div class="title_w">Currently doing:</div>

          <!-- Tidl Inc. -->
          <div class="item">
            <div class="header">
              <div class="left">
                <div class="comp">Tidl Inc.</div>
                <div class="position">Founder & Partner</div>
              </div>
              <div class="right">2016 – Current</div>
            </div>
            <div class="des">
               Leading a team of university students developing products aimed at helping millennials learn new skills and getting hired.
            </div>
          </div>

          <!-- Tidl Inc. -->
          <div class="item">
            <div class="header">
              <div class="left">
                <div class="comp">Alcamy</div>
                <div class="position">Founder & Creator</div>
              </div>
              <div class="right">2017 – Current</div>
            </div>
            <div class="des">
               Designed and implemented the entire UI/UX, backend and product strategy for Alcamy (alcamy.org); a self-learning platform with over 5000 active users across 81 countries.
            </div>
          </div>

          <!-- UWO -->
          <div class="item">
            <div class="header">
              <div class="left">
                <div class="comp">University of Western Ontario</div>
                <div class="position">Honors Specialization BSc Bioinformatics</div>
              </div>
              <div class="right">2015 – 2019</div>
            </div>
          </div>

        </div>
      </div><!-- .entry-content-page -->
    <?php endwhile; wp_reset_query(); ?>
  </div>
</div>



<?php get_footer(); ?>
