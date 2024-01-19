<?php /*
 * Template Name: Yoga Classes
 * Template Post Type: yoga-classes
 */ ?>
<?php get_header();?>


                <div class="container">

                    <div class="row">

                        <div class="col-md-12">
                            
                                <?php $loop = new WP_Query( array( 'post_type' => 'yoga-classes' ) ); ?>                        

                                        <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
                                            <?php the_title();?>
                                            <?php if(has_post_thumbnail() ) { the_post_thumbnail(); } ?>
                                            <?php the_content();?>
                                            <?php 
                                            $duration = get_post_meta(get_the_ID(), '_duration', true);
                                            if ($duration) {
                                                echo '<p>Duration: ' . esc_html($duration) . '</p>';
                                            }
                                            $fees = get_post_meta(get_the_ID(), '_fees', true);
                                            if ($fees) {
                                                echo '<p>Fees: ' . esc_html($fees) . '</p>';
                                            }
                                            $timings = get_post_meta(get_the_ID(), '_timings', true);
                                            if ($timings) {
                                                echo '<p>Timings: ' . esc_html($timings) . '</p>';
                                            }
                                            ?>
                                                            
                        </div>
                        <?php endwhile; ?>

                        <?php wp_reset_query(); ?>  

                    </div>

                </div>

<?php get_footer();?>