<?php  
/**
 * Latest Posts Section
 * 
 *  @package Influencer
*/

$latest_news_title = get_theme_mod( 'latest_news_title', __( 'Latest Articles','influencer' ) );
$latest_news_subtitle = get_theme_mod( 'latest_news_subtitle', __( 'Tips for getting things done','influencer' ) );
$more_from_blog_title = get_theme_mod( 'more_from_blog_title', __( 'More From The Blog','influencer' ) );
?>
<section id="news" class="news-section">
	<div class="cm-wrapper">
		<?php 
		if ( ! empty( $latest_news_subtitle ) ) :
            echo '<p class="section-subtitle">' . esc_html( $latest_news_subtitle ) . '</p>';
        endif;
        if ( ! empty( $latest_news_title ) ) :
            echo '<h1 class="section-title">' . esc_html( $latest_news_title) . '</h1>';
        endif;

	$latest_posts_args = array(
        'post_status'    		=> 'publish', 
        'ignore_sticky_posts' 	=> true,  
        'posts_per_page' 		=> 3,
    );
    
    $latest_posts_qry = new WP_Query( $latest_posts_args );
	
	if( $latest_posts_qry->have_posts() ) { ?>
		<div class="news-block-wrap clearfix">
			<?php while( $latest_posts_qry->have_posts() ) {
				$latest_posts_qry->the_post(); ?>
				<div class="news-block">
					<figure class="news-block-img">
						<?php 
						if ( has_post_thumbnail() ) { ?>
							<a href="<?php the_permalink(); ?>" itemprop="url"><?php the_post_thumbnail( 'influencer-latest-posts', array( 'itemprop' => 'image' ) ); ?></a>
						<?php } else {
							$latest_posts_image = get_template_directory_uri() .'/images/fallback-370x220.jpg';	?>
							<a href="<?php the_permalink(); ?>" itemprop="url"><img itemprop="image" src="<?php echo esc_url( $latest_posts_image ); ?>" alt="<?php the_title_attribute(); ?>"></a>
						<?php } ?>
					</figure>
					<div class="news-content-wrap">
						<h3 class="news-block-title" itemprop="headline">
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						</h3>
						<div class="entry-meta">
							<span class="byline" itemprop="author"><?php esc_html_e( 'by ','influencer' ); ?><a itemprop="name" class="author vcard" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php echo esc_html( get_the_author_meta( 'display_name' ) ); ?></a>
							</span>
							<span class="comments"><?php comments_number( 'No Comment', 'One Comment', '% Comments' ); ?></span>
						</div>
						<div class="news-block-desc" itemprop="text"><?php the_excerpt(); ?></div>
						<a href="<?php the_permalink(); ?>" class="readmore" itemprop="mainEntityOfPage"><?php esc_html_e( 'Continue Reading','influencer' ); ?></a>
					</div>
				</div>
			<?php } ?>
		</div>
	<?php wp_reset_postdata(); 
	} 
	if( !empty( $more_from_blog_title ) ) { ?>
		<a class="bttn" href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ); ?>"><span class="more-from-blog"><?php echo esc_html( $more_from_blog_title ); ?></span></a>
	<?php } ?>
	</div>
</section><!-- .news-section -->
