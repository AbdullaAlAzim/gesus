<div class="gesus-sermons-items">
               <div class="gesus-sermons-thumb">
                  <?php the_post_thumbnail('plus-point-310-300'); ?>
                    <!-- Audio player -->
                      <div class="gesus-audio">

                        <?php 
                            $meta_sermon = get_post_meta(get_the_ID(), '_sermonmeta', true);
                             ?>
                        <audio class="js-player" crossorigin playsinline>
                            <source src="<?php echo esc_url($meta_sermon['auddi_lnk']); ?>">
                        </audio>
                      </div>
               </div>
               <div class="gesus-sermons-content">
                   <div class="gesus-title">
                        <?php  $categories = get_the_terms( $id, 'sermons_category' );?>
                        <?php foreach($categories as $categorie):?>
                       <p><?php echo esc_attr($categorie->name);?></p>
                       <?php endforeach;?>
                       <a href="<?php the_permalink(); ?>" class="title"><?php the_title();?></a>
                   </div>
                        <?php if(has_excerpt()):?>
              <?php echo wp_trim_words(get_the_excerpt(), 12)?>
               <?php endif;?> 
                    <div class="gesus-author">
                        <div class="author">
                            <a href="" class="author-title">
                                <?php echo get_avatar(get_the_author_meta('ID'), '37'); ?>
                                <span>By <?php echo get_the_author()?></span>
                            </a>
                            <a href="" class="author-date"><i class="far fa-calendar-alt"></i> <?php the_time('M j, Y');?></a>
                        </div>
                        <div class="gesus-action">
                            <?php echo sermon_post_share(); ?>
                        </div>
                    </div>
               </div>
           </div>