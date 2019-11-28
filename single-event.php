<?php
/**
 * The template for displaying single portfilio
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @package sunix
 * @subpackage sunix
 * @since 1.0.0
 * @author EF5 Team
 *
 */
get_header();
?>
    <div class="container">
        <div class="row">
            <div id="red-content-area" class="red-content-area col-lg-12">
                <div class="red-blogs">
                <?php
                    while ( have_posts() ) :
                        the_post();
                ?>
                <div class="event-content-wrap">
                    <div class="single-event-top-wrap row">
                        <div class="col-left col-md-7 col-xl-8">
                            <h2 class="single-title"><?php the_title(); ?></h2>
                            <div class="single-event-desc">
                                <?php the_content(); ?>
                            </div>
                        </div>
                        <div class="col-right col-md-5 col-xl-4">
                            <div class="col-right-inner">
                                <h4><?php echo esc_html__('MORE INFO','sunix');?></h4>
                                <div class="org-name"><span><?php echo esc_html__('Time:','sunix');?></span> <?php echo sunix_get_post_format_value('event_time',''); ?></div>
                                <div class="events-schedule">
                                    <div class="event-date">
                                        <span><?php echo esc_html__('Date:','sunix');?></span> <?php echo sunix_get_post_format_value('event_date',''); ?>
                                    </div>
                                    <div class="event-duration">
                                        <span><?php echo esc_html__('Duration:','sunix');?></span> <?php echo sunix_get_post_format_value('event_duration',''); ?>
                                    </div>
                                    <div class="event-type">
                                        <?php $event_type = sunix_get_post_format_value('event_type',''); ?>
                                        <span><?php echo esc_html__('Type:','sunix');?></span> <?php if ($event_type==1){ echo esc_html('Open','sunix');}else{ echo esc_html('Close','sunix');}?>

                                    </div>
                                    <div class="event-entrants">
                                        <span><?php echo esc_html__('Entrants:','sunix');?></span> <?php echo esc_html__('Up to ','sunix').sunix_get_post_format_value('event_entrants','').esc_html__(' Peoples ','sunix') ;?>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <?php sunix_single_events_footer(); ?>
                    <div class="event-action event-book-event">
                        <?php echo do_shortcode('[reservation]'); ?>
                    </div>
                    <div class="single-event-gallery">
                        <?php sunix_single_events_gallery(); ?>
                    </div>


                </div>
                <?php endwhile; ?>
                </div>

            </div>
        </div>
    </div>
<?php
get_footer();