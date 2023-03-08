<?php get_header(); ?>
	<div class="container">
        <div class="sections">
            <div class="section">
                <div class="title-section">
                    <?php echo __( 'Desarrollador', 'appyn' ); ?>: <?php echo single_tag_title("", false); ?>
                </div>
                <div class="ct_description"><?php echo @tag_description(); ?></div>
                <?php
                $i = 1;
                if( have_posts() ):
                ?> 
                <div class="bloque-apps">
                    <?php
                    while( have_posts() ) : the_post();
                        get_template_part( 'template-parts/loop/app' );
                        $aprpc = appyn_options( 'apps_per_row_pc' );
                        if( $i == $aprpc ) {
                            if( !wp_is_mobile( ) )
                                echo '</div>'.ads("ads_home").'<div class="bloque-apps">';
                        }
                        $i++; 
                    endwhile;
                    ?>
                </div>
                <?php
                paginador();
                else: 
                    echo '<div class="no-entries"><p>'.__( 'No hay entradas', 'appyn' ).'</p></div>';
                endif; ?>
            </div>
        </div>
        <?php 
        if( appyn_options( 'og_sidebar' ) ) {
            get_sidebar( 'general' ); 
        } ?>
   </div>
<?php get_footer(); ?>