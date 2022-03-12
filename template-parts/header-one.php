<?php 
    $arg = [
        'cat' => '<span class="niotitle">'.esc_html__('Category','gesus').'</span>',
        'tag' => '<span  class="niotitle">'.esc_html__('Tag','gesus').'</span>',
        'author' => '<span  class="niotitle">'.esc_html__('Author','gesus').'</span>',
        'year' => '<span  class="niotitle">'.esc_html__('Year','gesus').'</span>',
        'notfound' => '<span  class="niotitle">'.esc_html__('Not found','gesus').'</span>',
        'search' => '<span  class="niotitle">'.esc_html__('Search for','gesus').'</span>',
        'marchive' => '<span  class="niotitle">'.esc_html__('Monthly archive','gesus').'</span>',
        'yarchive' => '<span  class="niotitle">'.esc_html__('Yearly archive','gesus').'</span>',
    ];

if (is_home() && get_option('page_for_posts')  ) {
    $title = 'Blog';
} elseif (is_front_page()){
    $title = 'Front Page';
}else {
    $title = get_the_title();
}
?>
  <!-- header start  -->
    <header class="gesus-header-section">
        <div class="gesus-main-menu-header">
            <div class="container">
                <div class="gesus-main-menu-header-wraper">
                       <?php gesus_logo(); ?>
                    <div class="main-menu-wrapper">
                        <div class="gesus-main-menu">
                        <?php
                        echo str_replace(['menu-item-has-children', 'sub-menu'], ['dropdown', 'dropdown-menu'],
                            wp_nav_menu( array(
                                    'container' => false,
                                    'echo' => false,
                                    'menu_id' => 'main-menu',
                                    'fallback_cb'=> 'gesus_no_main_nav',
                                    'items_wrap' => '<ul>%3$s</ul>',
                                )
                            ));
                        ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- mobile menu start  -->
    <div class="gesus-overlay"></div>
    <div class="gesus-mobile-menu">
        <div class="nav-close"><i class="fal fa-times"></i></div>
    <?php
        echo str_replace(['menu-item-has-children', 'sub-menu'], ['dropdown', 'dropdown-menu'],
            wp_nav_menu( array(
                    'container' => false,
                    'echo' => false,
                    'menu_id' => 'm-main-menu',
                    'fallback_cb'=> 'gesus_no_main_nav',
                    'items_wrap' => '<ul>%3$s</ul>',
                )
            ));
        ?>
    </div>
    <!-- mobile menu end  -->
    <!-- header end  -->
  
    <!-- breadcrumb start   -->
    <section class="breadcrumb-section gesus-section gesus-data-background" data-background="<?php the_post_thumbnail_url(); ?>">
        <div class="container">
                <h2><?php echo wp_kses_post($title); ?></h2>
            <nav  aria-label="breadcrumb">
                <?php gesus_unit_breadcumb(); ?>
            </nav>
        </div>
    </section>
    <!-- breadcrumb end   -->