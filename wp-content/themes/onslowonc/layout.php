<?php get_header(); ?>
<?php get_template_part('open','content');?>
<?php get_template_part('open','section');?>
<?php get_template_part('loop');?>

<?php wp_reset_query();//required for is_page_template to work?>
<?php if(is_page_template('page_team.php')):?>
	<hr />
	<?php include(TEMPLATEPATH . '/inc/team_query.php');?>
	<br />
	<?php include(TEMPLATEPATH . '/inc/backtotop.php');?>
<?php endif;?>
<?php get_template_part('close','section');?>
<?php get_sidebar('default');?>
<?php get_template_part('close','content');?>
<?php get_footer(); ?>

	