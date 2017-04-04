<?php get_header(); ?>
   	<div class="container-fluid la-category">
      <div class="container">
        <div class="row">
        <?php woocommerce_breadcrumb(); ?>
        <div class="col-md-3">
        <div class="panel-sidebar">Категории</div>
            <?php echo do_shortcode('[accordionmenu id="unique67c6a99" accordionmenu="47"]'); ?>
        </div>
          <div class="col-md-9">
              <?php if (have_posts()) :  while (have_posts()) : the_post(); ?>
              <div class="col-md-3 col-sm-4 category-product">
              <h3 class="category-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
              <?php the_post_thumbnail(); ?>
              <?php the_excerpt(); ?>
              </div>
          <?php endwhile; ?>
          <?php endif; ?>
          </div>
    	  </div>
      </div>
  </div> <!-- erow-category --> 
<?php get_footer(); ?>