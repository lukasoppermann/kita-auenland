<?php get_header(); ?>

<?php the_post(); ?>
	
<?php
$id = get_the_ID();
?>

<div id="contents" us-post-id="<?php echo $id; ?>">
	
	<section class="one-column centered" id="stage"><div class="inset">
		<div class="column">
			<div class="column-section"><div class="inset">
				<div class="stage-contents-wrapper">
					<h1><?php the_title(); ?></h1>
					<h4><span class="article-date-date"><?php the_date(); ?></span><span class="article-date-time"><?php the_time(); ?></span></h4>
					<h6>Written by <?php the_author(); ?></h6>
				</div>
			</div></div>
		</div></div>
	</section>
	
	<section class="one-column centered"><div class="inset">
		<div class="column">
			<div class="column-section basic style-basic style-additional-basic"><div class="inset">
				
				<?php the_content(); ?>
				
			</div></div>
		</div></div>
	</section>
	
	<section class="one-column centered"><div class="inset">
		<div class="column">
			<div class="column-section basic style-basic style-additional-basic"><div class="inset">
				
				<div class="article-page-tags">
					<?php echo get_the_tag_list('Tags: <ul><li>','</li><li>','</li></ul>'); ?>
				</div>
				
			</div></div>
		</div></div>
	</section>
	
	
	
	
	
	
	
</div>

<?php get_footer()?>