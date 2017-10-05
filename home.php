<?php /* Template Name: Home */ ?>
<?php get_header(); ?>
<div class="container">
    <div class="row">
        <div class="col-md-12 content-container text-center">
            <p><?php the_field('content'); ?></p>
            <p>Questions? <a class="italic" href="<?php echo home_url(); ?>/contact">Contact us</a>.</p>
            <!-- <a href="#"><h2><button class="btn btn-md btn-tri">Contact Us</button></h2></a> -->
        </div>
    </div>
    <div class="row who-we-are text-center">
        <h2>Who We Are</h2>
        <?php if( have_rows( 'display') ): $rowCount=count( get_field( 'display' ) ); while ( have_rows( 'display') ) : the_row(); $image=get_sub_field( 'image'); ?>
        <div class="<?php if($rowCount > 2){ echo 'col-md-4';  } ?> col-sm-6 display-container">
            <a href="<?php the_sub_field('page_link'); ?>">
                <p><img class="" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>">
                </p>
                <h3><?php the_sub_field('name'); ?></h3>
            </a>
        </div>
        <?php endwhile; else : endif; ?>
    </div>
    <div class="row what-is">
        <div class="col-md-12">
            <?php if (get_field( 'content_2_headline')){?>
            <h2><?php the_field("content_2_headline")?></h2>
            <?php } ?>
            <?php if (get_field( 'content_2_text')){?>
            <?php the_field( "content_2_text")?>
            <?php } ?>
        </div>
    </div>
    <div class="row text-center learn-more">
        <div class="col-md-12">
            <?php if (get_field( 'learn_more_headline')){?>
            <h2><?php the_field("learn_more_headline")?></h2>
            <?php } ?>
            <?php if (get_field( 'learn_more_text')){?>
            <p>
                <?php the_field( "learn_more_text")?>
            </p>
            <?php } ?>
        </div>
    </div>
    <?php if( have_rows( 'learn_more') ): ?>
    <div class="row text-center">
        <?php while ( have_rows( 'learn_more') ) : the_row(); ?>
        <a href="<?php the_sub_field('link'); ?>">
            <div class="col-md-3 col-xs-12  col-sm-6">
            <div class="learn-more-container">
                <div class="upper">
                    <h3><?php the_sub_field('text'); ?></h3>
                </div>
                <?php $image=get_sub_field( 'image'); ?>
                <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" title="<?php echo $image['title']; ?>">
            </div>
            </div>
        </a>
        <?php endwhile; else : endif; ?>
    </div>
</div>
<?php get_footer(); ?>