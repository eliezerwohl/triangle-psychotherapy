<?php /* Template Name: Resources */ ?>
<?php get_header(); ?>
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <?php if( have_rows( 'content') ): ?>
        <?php while ( have_rows( 'content') ) : the_row(); ?>
          <?php if (get_sub_field("section_headline")){ ?>
            <h1><?php the_sub_field("section_headline"); ?></h1>
          <?php } ?>
          <?php if( have_rows( 'sub_section') ): ?>
            <?php while ( have_rows( 'sub_section') ) : the_row(); ?>
              <div class="resource-section">
               <?php if (get_sub_field("headline")){ ?>
            <h2><?php the_sub_field("headline"); ?>
          <?php } ?>
           <?php if (get_sub_field("icon")){ ?>
            <i class="fa fa-<?php the_sub_field("icon"); ?>" aria-hidden="true">
                  </i>
          <?php } ?>
          <?php if (get_sub_field("headline")){ ?>
            </h2>
          <?php } ?>
          <?php if (get_sub_field("description")){ ?>
            <p><?php the_sub_field("description"); ?></p>
          <?php } ?>
               
                <?php if( have_rows( 'link_section') ): ?>
                  <?php while ( have_rows( 'link_section') ) : the_row(); ?>
                              <?php if (get_sub_field("headline")){ ?>
            <h4>
                      <?php the_sub_field("headline"); ?>
                    </h4>
          <?php } ?>
                    <ul class="link-section">
                      <?php while ( have_rows( 'links') ) : the_row(); ?>
                          <li>
                          <?php if (get_sub_field( "url")) { ?>
                            <a target="blank" href="<?php the_sub_field('url'); ?>">
                          <?php } ?>
                          <?php the_sub_field( "text"); ?>
                          <?php if (get_sub_field( "url")) { echo "</a>"; } ?>
                        </li>
                      <?php endwhile; ?>
                    </ul>
                  <?php endwhile; ?>
                <?php endif; ?>
              </div>
            <?php endwhile; ?>
          <?php endif; ?>
        <?php endwhile; ?>
      <?php ; else: echo "<h1>Content coming soon</h1>"; endif; ?>

           

            <div class="resource-section bold">
                <p class="bold"><?php the_field("disclaimer", "option"); ?></p>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>