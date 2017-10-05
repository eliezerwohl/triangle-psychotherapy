<?php /* Template Name: Contact */ ?>
<?php get_header(); ?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Contact Us</h1>
        </div>
    </div>
    <div class="row text-container">
        <div class=" col-md-12">
            <p><?php the_field("upper_text"); ?></p>
        </div>
    </div>
    <div class="row">
        <?php echo do_shortcode( '[contact-form-7 id="59" title="Contact form 1"]' ); ?>
    </div>
    <div class="row bottom-container">
        <div class="col-md-8">
            <p>
                <?php the_field( "text"); ?>
            </p>
        </div>
        <div class="col-md-4 text-center">
        	<?php $image = get_field('image'); ?>
						<p><img class="img-responsive" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>"></p>
        </div>
    </div>
</div>
<?php get_footer(); ?>