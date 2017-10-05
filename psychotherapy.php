<?php /* Template Name: Psychotherapy */ ?>
<?php get_header(); ?>
<div class="container">
	<div class="row">
	<div class="col-md-12">
	 <h1>Psychotherapy</h1>
	</div>
	<?php if( have_rows('content') ):
		$counter = 0;
		while ( have_rows('content') ) :  $counter++; the_row(); ?>
			<div class="col-md-12 psy-container">
				<?php if ($counter % 2 != 0){ ?>
					<div class="col-md-4 img-holder">
						<p>
						<?php $image = get_sub_field('image'); ?>
							<img class="img-responsive" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>">
						</p>
					</div>
					<div class="col-md-8">
						<h3><?php the_sub_field('headline'); ?></h3>
						<p><?php the_sub_field('text'); ?></p>
					</div>
				<?php } else { ?>
	
					<div class="col-md-4 col-md-push-8 img-holder">
						<p>
						<?php $image = get_sub_field('image'); ?>
							<img class="img-responsive" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>">
						</p>
					</div>
					<div class="col-md-8 col-md-pull-4">
						<h3><?php the_sub_field('headline'); ?></h3>
						<p><?php the_sub_field('text'); ?></p>
					</div>
				<?php } ?>
			</div>
			<?php endwhile; else : endif; ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>