<?php /* Template Name: Staff */ ?>
<?php get_header(); ?>
<div class="bio-container container">
    <div class="row">
        <?php if ( have_posts() ) while ( have_posts() ) : the_post(); $image=get_field( 'image'); ?>
        <div class="col-md-3 col-sm-3 side">
            <p>
                <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>">
            </p>
            <h3><?php the_title(); ?></h3>
            <a href="mailto:<?php the_field('email'); ?>">Contact me</a>
        </div>
        <div class="bio col-md-8 col-sm-8">
            <?php the_content(); ?>
        </div>
        <?php endwhile; ?>
    </div>
    <?php if( have_rows( 'content') ): $subCounter=0 ; $counter=0 ;?>
    <div class="book-container">
        <h2>Books</h2>
        <?php while ( have_rows( 'content') ) : $counter++; $subCounter++; ?>
        <?php the_row(); ?>
        <?php if ($subCounter==1 ){ ?>
        <div class="row">
            <?php } ?>
            <div class="single-book col-md-3 col-sm-6">
                <?php $image=get_sub_field( 'image'); ?>
                <?php if(get_sub_field( 'amazon_link')){ ?>
                <a target="_blank" href="<?php the_sub_field('amazon_link'); ?>">
                    <?php } ?>
                    <p>
                        <img class="img-responsive" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>">
                    </p>
                    <?php if(get_sub_field( 'amazon_link')){ ?>
                    <span>Available At Amazon</span>
                </a>
                <?php } ?>
            </div>
            <?php if ($subCounter==4 || $counter==count( get_field( 'content') ) ) { $subCounter=0 ?>
        </div>
        <?php } endwhile; endif; ?>
    </div>
</div>
<?php get_footer(); ?>