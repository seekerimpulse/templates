<?php get_header(); ?>
<?php $options = get_option('ribbon'); ?>
<div id="page" class="single">
	<div class="content">
		<article class="article">
			<div id="content_box" >
				<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
					<div id="post-<?php the_ID(); ?>" <?php post_class('g post'); ?>>
						<div class="single_post">
							<div class="post-date-ribbon"><div class="corner"></div><?php the_time('d M Y'); ?></div>
							<?php if ($options['mts_breadcrumb'] == '1') { ?>
								<div class="breadcrumb"><?php the_breadcrumb(); ?></div>
							<?php } ?>
							<header>
								<h1 class="title single-title"><?php the_title(); ?></h1>
								<span class="theauthor single-postmeta"><?php _e('Posted in ','mythemeshop'); the_category(', '); ?><?php _e(' By ','mythemeshop'); the_author_posts_link(); ?><?php _e(' On ','mythemeshop'); the_time('F j, Y'); ?></span>
							</header><!--.headline_area-->
							<div class="post-single-content box mark-links">
								<?php the_content(); ?>
								<?php wp_link_pages('before=<div class="pagination2">&after=</div>'); ?>
								<?php if($options['mts_tags'] == '1') { ?>
									<div class="tags"><?php the_tags('<span class="tagtext">Tags:</span>',', ') ?></div>
								<?php } ?>
							</div>
						</div><!--.post-content box mark-links-->
						<?php if($options['mts_author_box'] == '1') { ?>
							<div class="postauthor">
								<h4><?php _e('About Author', 'mythemeshop'); ?></h4>
								<?php if(function_exists('get_avatar')) { echo get_avatar( get_the_author_meta('email'), '85' );  } ?>
								<h5><?php the_author_meta( 'nickname' ); ?></h5>
								<p><?php the_author_meta('description') ?></p>
							</div>
						<?php }?>  
						<?php if($options['mts_related_posts'] == '1') { ?>	
							<?php $categories = get_the_category($post->ID); if ($categories) { $category_ids = array(); foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id; $args=array( 'category__in' => $category_ids, 'post__not_in' => array($post->ID), 'showposts'=>3, 'orderby' => rand, 'caller_get_posts'=>1 );
								$my_query = new wp_query( $args );
								if( $my_query->have_posts() ) {
									echo '<div class="related-posts"><div class="postauthor-top"><h3>'.__('Related Posts','mythemeshop').'</h3></div><ul>';
									while( $my_query->have_posts() ) { ++$counter; if($counter == 3) { $postclass = 'last'; $counter = 0; } else { $postclass = ''; } $my_query->the_post();?>
								<li class="<?php echo $postclass; ?>">
									<a rel="nofollow" class="relatedthumb" href="<?php the_permalink()?>" rel="bookmark" title="<?php the_title(); ?>">
										<span class="rthumb">
											<?php if(has_post_thumbnail()): ?> <?php the_post_thumbnail('related', 'title='); ?>
											<?php else: ?> <img src="<?php echo get_template_directory_uri(); ?>/images/relthumb.png" alt="<?php the_title(); ?>"  width='200' height='125' class="wp-post-image" /> <?php endif; ?>
										</span>
										<span class="rp_title"><?php the_title(); ?></span>
									</a> 
								</li>
								<?php } echo '</ul></div>'; } } wp_reset_query(); ?><!-- .related-posts -->
						<?php }?>  
					</div><!--.g post-->
					<?php comments_template( '', true ); ?>
				<?php endwhile; /* end loop */ ?>
			</div>
		</article>
		<?php get_sidebar(); ?>
<?php get_footer(); ?>