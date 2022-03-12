<div id="post-<?php the_ID(); ?>" <?php post_class('gesus-blog-details'); ?>>
<div class="post-details-title wow fadeInUp" >
    <h3><?php the_title(); ?></h3>
    <div class="author-area">
        <?php gesus_category(); ?>
        <div class="author">
            <div class="author-thumb">
               <?php echo get_avatar(get_the_author_meta('ID'), '37'); ?>
            </div>
            <div class="content">
               <?php gesus_post_author(); ?>
                <a href="<?php echo get_day_link(get_the_time('Y'), get_the_time('M'), get_the_time('j')) ?>"
                       class="date"><?php echo get_the_time('M, 7') ?></a>
            </div>
        </div>
    </div>
</div>

<div class="market-industry-thumb wow fadeInUp"  data-wow-delay="0.6s">
      <?php if (has_post_thumbnail()) : ?>
    <div class="images-thumb">
         <?php the_post_thumbnail('full'); ?>
    </div>
    <?php endif; ?>
    <div class="content">
        <p><?php echo esc_html('by');?> <?php the_author();?></p>
         <h4><?php echo wp_trim_words(get_the_excerpt(), 12)?></h4>
    </div>
</div>
<div class="toproviding-customers wow fadeInUp"  data-wow-delay="0.9s">
     <?php the_content(); ?>
</div>
<div class="gesus-details-tags-area wow fadeInUp"  data-wow-delay="1.2s">
    <div class="tags">
        <?php gesus_post_tag();?>
    </div>
    <div class="gesus-socialshare">
        <?php gesus_post_share(); ?>
    </div>
</div>
<div class="gesus-button-araa wow fadeInUp"  data-wow-delay="1.5s">
    <?php gesus_navigation(); ?>
</div>
</div>
