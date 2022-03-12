  <?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Plus_Point
 */

get_header();
while(have_posts()): the_post();

?>

  <!-- Our Sermons section start  -->
   <section class="gesus-sermons-section gesus-section">
       <div class="container">
           <div class="gesus-sermons-details-wrapper">
                <div class="gesus-sermons-items gesus-sermons-big">
                    <div class="gesus-sermons-thumb">
                        
                         <?php if ( has_post_thumbnail() ) : ?> 
                          <?php the_post_thumbnail(); ?>
                          <?php endif; ?>
                        <!-- Audio player -->
                        <?php $metadata = get_post_meta(get_the_ID(), '_agentmeta', true); ?>

                        <div class="gesus-audio">
                            <audio class="js-player" crossorigin playsinline>
                                <source src="<?php echo esc_url($metadata['a_link']); ?>">
                            </audio>
                        </div>
                        <div class="gesus-action">
                            <a href=""><i class="fas fa-music"></i></a>
                        </div>
                    </div>
                </div>
                <div class="gesus-sermons-details-content">
                    <div class="gesus-top-title">
                        <p><?php esc_html_e('Sermon By:','gesus'); ?> <span><?php echo esc_html ($metadata['sr_speaker']); ?></span>  <?php esc_html_e('Date:','gesus'); ?> <span><i class="far fa-calendar-alt"></i></span>  <?php the_time('M j, Y');?></p>
                        <h3 class="title"><?php the_title(); ?></h3>
                    </div>
                    <div class="gesus-sermons-details">
                        <?php the_content(); ?>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="gesus-sermons-details-video"> 
                                   
                                    <?php  echo get_that_image2($metadata['video_l_img'], ''); ?>

                                    <a href="<?php echo esc_attr($metadata['video_2']); ?>" data-lity><i class="fas fa-play"></i></a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="gesus-sermons-details-video">     
                                     <?php  echo get_that_image2($metadata['video_2_img'], ''); ?>
                                    <a href="<?php echo esc_attr($metadata['video_l']); ?>" data-lity><i class="fas fa-play"></i></a>
                                </div>
                            </div>
                        </div>
                      
                    </div>
                </div>
           </div>
       </div>
   </section>
   <?php endwhile; ?>
   <?php get_footer();
 ?>
    <!-- Our Sermons section end  -->