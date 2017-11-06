<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package hello
 */

get_header(); ?>

	<div id="blog">
		<main id="main" class="site-main">
			<div id="wrapper">
					<h1 class="entry-title">Writing</h1>
					<div class="entry-content-page">I write regularly about design, science, tech and all things I find interesting.</div>

					<div class="loop-posts">
						<?php while ( have_posts() ) : the_post(); ?>
								<div class="single-post">
									<div class="overlay"></div>
									<div class="cat">
										<?php $parentscategory ="";
											foreach((get_the_category()) as $category) {
											if ($category->category_parent == 0) {
											$parentscategory .= ' <a href="' . get_category_link($category->cat_ID) . '" title="' . $category->name . '">' . $category->name . '</a>, ';
											}
											}
											echo substr($parentscategory,0,-2); ?>
									</div>
									<a href="<?php the_permalink() ?>">
										<div class="title"><?php the_title(); ?></div>
										<div class="excerpt"><?php the_excerpt(); ?></div>
									</a>
								</div>
						<?php endwhile; ?>
					</div>
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php

get_footer();
