<footer><div class="inset">
	
	<div id="footer-header">
		<a id="footer-logo" href="<?php echo get_home_url(); ?>">Kindertagesstätte Auenland e.V. – Berlin Pankow</a>
	</div>
	<div id="footer-body">
		<div id="footer-menu">
			<?php wp_nav_menu( array( 'theme_location' => 'footer-nav' ) ); ?>
		</div>
	</div>
	<div id="footer-footer">
		<div id="footer-notes">
			<?php wp_nav_menu( array( 'theme_location' => 'footer-notes-nav' ) ); ?>
			<div id="copyright-infos">&copy; Kita Auenland e.V. <?php echo date('Y'); ?></div>
		</div>
	</div>	
	
</div></footer>


</body>
<?php wp_footer(); ?>
</html>