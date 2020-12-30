<?php 
/*
	Template Name: Blog
*/
?>

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
	
	
	<?php // Display blog posts
	$temp = $wp_query; $wp_query= null;
		
	$wp_query = new WP_Query(); $wp_query->query('posts_per_page=10' . '&paged='.$paged); ?>
	
	
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
		
		<article us-post-id="<?php echo $id; ?>">
			<div class="article-item-header">
				<h2><a href="<?php the_permalink(); ?>" title="Read more"><?php the_title(); ?></a></h2>
			</div>
			<div class="article-item-body">
				<?php the_excerpt(); ?>
			</div>
			<div class="article-item-footer">
				posted in: <?php wp_list_categories(); ?>
			</div>
		</article>	

		<?php endwhile; ?>
	
	</div>
	
	
	<?php if ($paged): ?>

	<div class="article-list-navigation">
		<div class="prev"><?php next_posts_link('&laquo; Previous Posts'); ?></div>
	</div>

	<?php endif; ?>
	
	

	<?php wp_reset_postdata(); ?>
	
	
</div>

<?php get_footer()?>