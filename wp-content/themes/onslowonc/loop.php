<?php get_header('subhead');?>
<?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post(); ?>

		<?php the_content();?>

	<?php endwhile; ?>
<?php else: ?>
	<h2>No posts found</h2>
<?php endif; ?>