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
                        <?php the_post_thumbnail('full'); ?>
                         <?php endif; ?>
                        <!-- Audio player -->
                        <div class="gesus-audio">
                             <?php 
                            $meta_sermon = get_post_meta(get_the_ID(), '_sermonmeta', true);
                             ?>
                            <audio class="js-player" crossorigin playsinline>
                                    <source src="<?php echo esc_attr($meta_sermon['auddi_lnk']); ?>">
                            </audio>
                        </div>
                        <div class="gesus-action">
                           
                            <a href=""><i class="fas fa-music"></i></a>
                        </div>
                    </div>
                </div>
                <div class="gesus-sermons-details-content">
                    <div class="gesus-top-title">
                        <p><?php esc_html_e('Sermon By:','gesus'); ?> <?php if(!empty($meta_sermon['sermo_speaker'])): ?><span><?php echo esc_html ($meta_sermon['sermo_speaker']); ?></span> <?php endif; ?> <span><i class="far fa-calendar-alt"></i></span>  <?php the_time('M j, Y');?></p>
                        <h3 class="title"><?php the_title(); ?></h3>
                    </div>
                    <div class="gesus-sermons-details">
                        <p><?php the_content(); ?></p>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="gesus-sermons-details-video">
                                      <?php if(!empty($meta_sermon['ser_l_img'])): ?>
                                     <?php  echo get_that_image2 ($meta_sermon['ser_l_img'], ''); ?>
                                      <?php endif; ?>
                                      <?php if(!empty($meta_sermon['ser_l'])): ?>
                                    <a href="<?php echo esc_attr ($meta_sermon['ser_l']); ?>" data-lity><i class="fas fa-play"></i></a><?php endif; ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="gesus-sermons-details-video">
                                     <?php if(!empty($meta_sermon['ser_2_img'])): ?>
                                     <?php  echo get_that_image2 ($meta_sermon['ser_2_img'], ''); ?>
                                      <?php endif; ?>
                                       <?php if(!empty($meta_sermon['ser_2'])): ?>
                                    <a href="<?php echo esc_attr ($meta_sermon['ser_2']); ?>" data-lity><i class="fas fa-play"></i></a><?php endif; ?>
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