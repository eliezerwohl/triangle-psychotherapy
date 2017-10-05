</div>
<footer id="footer_content" class='container-fluid'>
	<div id="footer-box">
		<div id="footer-line"></div>
	</div>
		<div>&copy; <?php echo date("Y"); ?> Triangle Psychotherapies and Consultation LLC</div>
		<?php $phone = preg_replace('[\D]', '', get_field('phone', 'option'));
		?>
		<div><a target="_blank" href="<?php the_field('google_maps_address_link', 'option'); ?>"><i class="fa fa-map-marker" aria-hidden="true"></i><?php the_field('address', 'option'); ?></a></div>
		<div><a href="tel:<?php echo $phone; ?>"><i class="fa fa-phone" aria-hidden="true"></i><?php the_field('phone', 'option'); ?></a><a target="_blank" href="mailto:<?php the_field('email', 'option'); ?>"><i class="fa fa-envelope" aria-hidden="true"></i><?php the_field('email', 'option'); ?></a></div>
		<div><a target="_blank" href="mailto:eandvdesign@gmail.com"><i class="fa fa-globe" aria-hidden="true"></i>Website by E and V Design</a></div>

</footer>
	<?php wp_footer(); ?>

<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/bootstrap.js"></script>
	<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/main.js"></script>

</body>
</html>