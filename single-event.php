<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 */
get_header();
while(have_posts()): the_post();
   $metadata = get_post_meta(get_the_ID(), '_eventmeta', true);
?>
   <!-- Our Events section start  -->
   <section class="gesus-events-details-section gesus-section">
        <div class="container">
            <div class="gesus-events-organizer">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="gesus-events-organizer-items">
                            <div class="icon"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/icons/location.svg" alt=""></div>
                                <?php if(!empty($metadata['evt_loc'])): ?>
                            <div class="content">
                                <h4><?php esc_html_e('Location','gesus'); ?></h4>
                             
                                <p><?php echo esc_html(risset($metadata['evt_loc'])); ?></p> 
                            
                            </div>
                             <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="gesus-events-organizer-items">
                            <div class="icon"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/icons/calender.svg" alt=""></div>
                             <?php if(!empty($metadata['event_time'])): ?>
                            <div class="content">
                                <h4><?php esc_html_e('Time Event','gesus'); ?></h4>
                               
                                <p><?php echo esc_html(risset($metadata['event_time'])); ?></p>
                            
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="gesus-events-organizer-items">
                            <div class="icon"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/icons/calender.svg" alt=""></div>
                               <?php if(!empty($metadata['evt_org'])): ?>
                            <div class="content">
                                <h4><?php esc_html_e('Event Organizer','gesus'); ?></h4>
                                <p><?php echo esc_html(risset($metadata['evt_org'])); ?></p> 
                                
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="gesus-events-details-wrapper">
                <div class="gesus-events-contemporary">
                    <div class="events-video-thumb">
                        <?php echo get_that_image2($metadata['vd_img'], ''); ?>
                        <a href="<?php echo esc_attr($metadata['yuo_linkk']); ?>" class="gesus-play-btn white-btn" data-lity=""><i class="fas fa-play"></i></a>
                    </div>
                    <h3><?php the_title(); ?></h3>
                    <p><?php the_content(); ?></p>
                </div>
                <div class="gesus-events-share">
                    <h3><?php esc_html_e('Share This Events','gesus'); ?></h3>
                    <div class="gesus-social-share">
                        <?php if(!empty($metadata['fb_lnks'])): ?>    
                        <a href="<?php echo esc_url($metadata['fb_lnks']);?>" class="social-share fb" data-background="<?php echo get_template_directory_uri(); ?>/assets/images/events/bg.png">
                            <span><i class="fab fa-facebook-f"></i></span>
                            <?php  esc_html_e('Facebook','gesus'); ?>
                        </a>
                    <?php endif; ?>
                        <?php if(!empty($metadata['tw_lnks'])): ?> 
                        <a href="<?php echo esc_url($metadata['tw_lnks']);?>" class="social-share twitter" data-background="<?php echo get_template_directory_uri(); ?>/assets/images/events/bg.png">
                            <span><i class="fab fa-twitter"></i></span>
                            <?php esc_html_e('Twitter','gesus'); ?>
                        </a>
                        <?php endif; ?>
                        <?php if(!empty($metadata['pn_lnks'])): ?> 
                        <a href="<?php echo esc_url($metadata['pn_lnks']);?>" class="social-share pinterest" data-background="<?php echo get_template_directory_uri(); ?>/assets/images/events/bg.png">
                            <span><i class="fab fa-pinterest-p"></i></span>
                             <?php  esc_html_e('Pinterest','gesus'); ?>
                        </a>
                        <?php endif; ?>
                         <?php if(!empty($metadata['ln_lnks'])): ?> 
                        <a href="<?php echo esc_url($metadata['ln_lnks']);?>" class="social-share linkedin" data-background="<?php echo get_template_directory_uri(); ?>/assets/images/events/bg.png">
                            <span><i class="fab fa-linkedin-in"></i></span>
                             <?php  esc_html_e('linkedin','gesus'); ?>
                        </a>
                        <?php endif; ?>

                        <?php if(!empty($metadata['tbm_lnks'])): ?> 
                        <a href="<?php echo esc_url($metadata['tbm_lnks']);?>" class="social-share stumbleupon" data-background="<?php echo get_template_directory_uri(); ?>/assets/images/events/bg.png">
                            <span><i class="fab fa-stumbleupon"></i></span>
                             <?php  esc_html_e('Tumblr','gesus'); ?>
                        </a>
                          <?php endif; ?>
                    </div>
                </div>
                <div class="gesus-events-map-wrapper">
                    <div class="gesus-map">

                        <iframe src="<?php echo esc_url($metadata['opt-wp-editor-3']); ?>" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                   
                </div>
                <div class="gesus-leaned-speaker">
                    <h3><?php esc_html_e('The leaned Speaker','gesus'); ?></h3>
                    <div class="row m-0">
                        <?php 
                        if(isset($metadata['opt-group-1']) && is_array($metadata['opt-group-1']))
                            foreach($metadata['opt-group-1'] as $item): 
                            ?>
                        <div class="col-lg-3 col-sm-6 p-0">
                            <div class="card gesus-team-card gesus-team-big-card">
                                <div class="card-thumb">
                                     <?php  echo get_that_image2($item['opt-upload-1'], ''); ?>
                                    <div class="gesus-action">

                                        <a href="<?php echo esc_attr($item['sp_fb']);?>"><i class="fab fa-facebook-f"></i></a>
                                        <a href="<?php echo esc_attr($item['sp_tw']);?>"><i class="fab fa-twitter"></i></a>
                                        <a href="<?php echo esc_attr($item['sp_you']);?>"><i class="fab fa-youtube"></i></a>
                                    </div>
                                </div>
                                <?php if(!empty($item['spe_desi'])): ?>
                                <div class="card-body">
                                    <p><?php echo esc_html($item['spe_name']); ?></p>
                                    <a href="team.html" class="card-title"><?php echo esc_attr($item['spe_desi']); ?></a>
                                </div>
                            <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach ?>
                    </div>
                </div>
                <div class="gesus-event-memories">
                    <h3><?php esc_html_e('Event Memories','gesus'); ?></h3>
                    <div class="row">
                             <?php 
                                  $query_args = array( 
                                    'post_type' => 'event',
                                    'orderby'   => 'post_date',
                                    'order'     => 'DESC',
                                    'posts_per_page'=> '5' 
                                );
                                  $i = 0;
                              $the_query = new WP_Query( $query_args );?>
                                  <?php  if( $the_query->have_posts() ): while( $the_query->have_posts() ): $the_query->the_post() ; $i++;
                                  if($i == 1): ?>
                       <div class="col-lg-4">
                                    <div class="gesus-event-memories-items memories-big-items">
                                        <div class="thumb">
                                           <?php the_post_thumbnail(); ?>
                                        </div>
                                          <?php
                                             $categories = get_terms('event_category', array(
                                                    'orderby'   => 'name',
                                                    'hide_empty'    => true,
                                                    'posts_per_page' => 1,
                                                ));
                                                
                                             ?>
                                        <div class="gesus-content">
                                            <div class="gesus-social-link">
                                                <a href=""><i class="far fa-heart"></i></a>
                                                <a href=""><i class="fal fa-share-alt"></i></a>
                                            </div>
                                            <div class="gesus-memories-title">
                                                <a href="<?php the_permalink(); ?>"><?php the_title();?></a>
                                               <?php  foreach($categories as $category) :
                                                    $category_link = get_term_link( $category, $category->slug ); ?>
                                                <span><?php echo esc_html($category->name ); ?></span>
                                              <?php endforeach; ?>
                                             </div>
                                        </div>
                                    </div>
                               </div>
                    <?php endif;endwhile;endif; ?>
                        <div class="col-lg-8">
                            <div class="row">
                                <?php $j = 0; if( $the_query->have_posts() ): while( $the_query->have_posts() ): $the_query->the_post() ; $j++; if($j > 1): ?>
                                <div class="col-md-6">
                                    <div class="gesus-event-memories-items">
                                        <div class="thumb">
                                           <?php the_post_thumbnail(); ?>
                                        </div>
                                          <?php
                                                 $categories = get_terms('event_category', array(
                                                        'orderby'   => 'name',
                                                        'hide_empty'    => true,
                                                        'posts_per_page' => 1,
                                                    ));
                                                
                                             ?>
                                        <div class="gesus-content">
                                            <div class="gesus-social-link">
                                                <a href=""><i class="far fa-heart"></i></a>
                                                <a href=""><i class="fal fa-share-alt"></i></a>
                                            </div>
                                            <div class="gesus-memories-title">
                                               
                                                <a href="<?php the_permalink(); ?>"><?php the_title();?></a>
                                               <?php  foreach($categories as $category) :
                                                    $category_link = get_term_link( $category, $category->slug ); ?>
                                                <span><?php echo esc_html($category->name ); ?></span>
                                         <?php endforeach; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endif; endwhile; endif;  ?>                     
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
   </section>
    <!-- Our Events section end  -->
<?php endwhile; ?>
<?php get_footer(); ?>