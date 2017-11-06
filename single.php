<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package hello
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<div id="wrapper">

		<?php
		while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/content', get_post_type() );


			// // If comments are open or we have at least one comment, load up the comment template.
			// if ( comments_open() || get_comments_number() ) :
			// 	comments_template();
			// endif;

		endwhile; // End of the loop.
		?>
		<div class="cta">
			<div class="enjoy">Did you find this article useful?</div>
			I write regularly about design, science, tech and all things I find interesting. Get my essays delivered right to your inbox by subscribing.
			<form class="formthis" action="https://tinyletter.com/udara" method="post" target="popupwindow" onsubmit="window.open('https://tinyletter.com/udara', 'popupwindow', 'scrollbars=yes,width=800,height=600');return true" _lpchecked="1"><input type="text" style="width:140px" name="email" id="tlemail" placeholder="Email address"><input type="hidden" value="1" name="embed"><input id="go" type="submit" value="Subscribe"></form>
		</div>

		<?php $next_post = get_next_post(); ?>
		<?php if (!empty( $next_post )): ?>
		<a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>">
		<div class="nextup">
			<div class="overlay"></div>


			<!-- <?php echo get_the_post_thumbnail($next_post->ID) ?> -->
			<div class="content">
				<div class="upnext">up next</div>
				<?php echo esc_attr( $next_post->post_title ); ?>
				<div class="summary">
					<?php echo esc_attr( get_the_excerpt($next_post->ID) ); ?>
				</div>

			</div>
		</div>
		</a>
		<?php endif; ?>
		
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php

get_footer();
