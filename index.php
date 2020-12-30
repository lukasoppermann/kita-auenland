<?php get_header(); ?>

<div id="contents">
	
	<section class="one-column centered" id="stage"><div class="inset">
		<div class="column">
			<div class="column-section"><div class="inset">
				<div class="stage-contents-wrapper">
					<h1>Blog</h1>
				</div>
			</div></div>
		</div></div>
	</section>
	
	
	
	<?php if ($paged > 1): ?>

	<div class="article-list-navigation">
		<div class="prev"><?php next_posts_link('&laquo; Previous Posts'); ?></div>
	</div>

	<?php endif; ?>
	
	
	<div class="article-list">
	
		<?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
		
		<?php
		
		$id = get_the_ID();
		
		?>
		
		<article us-post-id="<?php echo $id; ?>"><div class="inset">
			<div class="article-item-header">
				<div class="article-date"><span class="article-date-date"><?php the_date(); ?></span><span class="article-date-time"><?php the_time(); ?></span></div>
				<div class="article-title"><h2><a href="<?php the_permalink(); ?>" title="Read more"><?php the_title(); ?></a></h2></div>				
			</div>
			<div class="article-item-body">
				<?php the_excerpt(); ?>
			</div>
			<div class="article-item-discussion">
				<div class="article-comments-number"><a href="<?php comments_link(); ?>"><?php comments_number( 'no responses', 'one response', '% responses' ); ?></a></div>
			</div>
			<div class="article-item-footer">
				<div class="article-categories">posted in: <ul class="article-category-list">
				<?php
				$categories = get_the_category();
				$output = '';
				if ( ! empty( $categories ) ) {
					foreach( $categories as $category ) {
						$output .= '<li><a href="' . esc_url( get_category_link( $category->term_id ) ) . '" alt="' . esc_attr( sprintf( __( 'View all posts in %s', 'textdomain' ), $category->name ) ) . '">' . esc_html( $category->name ) . '</a></li>';
					}
					echo $output;
				}					
				?>
				</ul></div>
				<div class="article-author">
					posted by: <span><?php the_author(); ?></span>
				</div>
			</div>
		</div></article>	

		<?php endwhile; ?>
	
	</div>
	
	
	<?php if ($paged): ?>

	<div class="article-list-navigation">
		<div class="prev"><?php next_posts_link('&laquo; Previous Posts'); ?></div>
	</div>

	<?php endif; ?>
	
	
	
	
</div>

<?php get_footer()?>