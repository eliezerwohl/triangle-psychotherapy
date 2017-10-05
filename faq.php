<?php /* Template Name: FAQ */ ?>

<?php get_header(); ?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-center">Frequently Asked Questions - FAQs
			</h1>
            <?php if( have_rows( 'content') ): while ( have_rows( 'content') ) : the_row(); ?>
            <div class="faq-container">
                <div class="showHide">
                    <div class="icon-container">
                        <i class="fa fa-question-circle-o" aria-hidden="true"></i>
                    </div>

                    <p>
                        <?php the_sub_field( 'question'); ?>
                        <i class="toggleIcon fa fa-caret-right" aria-hidden="true"></i>
                    </p>
                </div>
                <div class="answer">
                    <div class="answer-icon-container">
                        <i class="fa fa-commenting-o" aria-hidden="true"></i>
                    </div>
                    <p>
                        <?php the_sub_field( 'answer'); ?>
                    </p>
                </div>
            </div>
            <?php endwhile; else : endif; ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>