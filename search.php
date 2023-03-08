<?php get_header(); ?>
	<div class="container">
		<div class="sections">
			<?php 
			$paged = 0 == get_query_var('paged') ? 1 : get_query_var('paged');
			$query_post = new WP_Query( array('post_type' => 'post', 'paged' => $paged, 's' => get_search_query(), 'posts_per_page' => appyn_options( 'home_limite' ) ) );
			if( $query_post->have_posts() ): ?>
			<div class="section">
				<div class="title-section">
					<?php echo __( 'Buscar', 'appyn' ); ?>: <?php the_search_query(); ?>
				</div>
				<div class="bloque-apps"> 
					<?php 
					while( $query_post->have_posts() ): $query_post->the_post();
						get_template_part( 'template-parts/loop/app' );
					endwhile; 
					?>
				</div>
			</div>
			<?php 
			wp_reset_query($query_post);
			endif;

			$query_blog = new WP_Query( array('post_type' => 'blog', 'paged' => $paged, 's' => get_search_query(), 'posts_per_page' => appyn_options( 'home_limite' ) ) );
			if( $query_blog->have_posts() ): ?>
			<div class="section">
				<div class="title-section">
					<?php echo __( 'Blog', 'appyn' ); ?>
				</div>
				<div class="bloque-blogs px-columns">
					<?php 
					while( $query_blog->have_posts() ): $query_blog->the_post();
						get_template_part( 'template-parts/loop/blog-home' );
					endwhile; 
					?>
				</div>
			</div>
			<?php endif;
			wp_reset_query($query_blog);

			if( $query_post->found_posts + $query_blog->found_posts >= appyn_options( 'home_limite' ) * 2 )
				paginador();
			if( $query_post->found_posts + $query_blog->found_posts == 0 )
				echo '<div class="no-entries"><p>'.__( 'No hay entradas', 'appyn' ).'</p></div>';
			?>
        </div>
        <?php 
        if( appyn_options( 'og_sidebar' ) ) {
            get_sidebar( 'general' ); 
        } ?>
   </div>
<?php get_footer(); ?>