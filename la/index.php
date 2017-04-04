<?php get_header(); ?>
	<div class="container-fluid la">
      <div class="container">
        <div class="row">
	         <div class="col-md-12">
             <?php if (have_posts()) :  while (have_posts()) : the_post(); ?>
          
                <h1><?php the_title(); ?></h1>
                <?php the_post_thumbnail(); ?>
                <?php the_content(); ?>
                </div>
            <?php endwhile; ?>
            <?php endif; ?>
          </div>
    	  </div>
      </div>
  </div> <!-- erow-main --> 
<?php get_footer(); ?>