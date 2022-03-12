<?php

add_filter( 'body_class', 'gesus_bodyclass_checker' );
function gesus_bodyclass_checker( $classes ) {
    $classes[] = 'checkerbody';
    return $classes;   
}



function gesus_logo(){
    $custom_logo_id = get_theme_mod( 'custom_logo' );

    if ( $custom_logo_id ) {
        echo '<a class="logo" href='.esc_url( home_url( '/' ) ).' rel="home">'.wp_get_attachment_image( $custom_logo_id, 'full' ).'</a>';
    } else {
        echo '<a class="logo" href='.esc_url( home_url( '/' ) ).' rel="home">'.get_bloginfo( 'name' ).'</a>';
    }
}



function gesus_post_share() {
		?>
    <ul>
          
          <li><a  href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink();?>" title="Share on Facebook" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
          <li>

        <li><a  href="https://twitter.com/intent/tweet?url=<?php the_permalink();?>&text=<?php echo the_title(); ?>" title="Tweet this" target="_blank"><i class="fab fa-twitter"></i></a></li>
         
              <li><a  href="http://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>&title=<?php the_title(); ?>&source=Jonaky_Blog" title="Share on Linkedin" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>
        <li><a  href="https://api.whatsapp.com/send?text=<?php the_title(); ?>: <?php the_permalink(); ?>" data-action="share/whatsapp/share" title="Share on Whatsapp" target="_blank"><i class="fab fa-whatsapp"></i></a></li>
        </ul>
    <?php
}


function sermon_post_share() {
       ?><a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink();?>"><i class="fab fa-facebook-f"></i></a>
              <a href="https://twitter.com/intent/tweet?url=<?php the_permalink();?>&text=<?php echo the_title(); ?>"><i class="fab fa-twitter"></i></a>
            <a  href="https://api.whatsapp.com/send?text=<?php the_title(); ?>: <?php the_permalink(); ?>" data-action="share/whatsapp/share" title="Share on Whatsapp" target="_blank"><i class="fab fa-whatsapp"></i></a>
            <a  href="http://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>&title=<?php the_title(); ?>&source=Jonaky_Blog" title="Share on Linkedin" target="_blank"><i class="fab fa-linkedin-in"></i></a>
    <?php
}






function gesus_single_category($default = true) {
					
	if ( 'post' == get_post_type() ) {
		$categories = get_the_category();
		$separator = ', ';
		$output = '';
		if($categories){
			foreach($categories as $category) {
	
				$output .= '<a class="cat-links" href="'.get_category_link( $category->term_id ).'">'.$category->cat_name.'</a>'.$separator;

			}
		$cat= trim($output, $separator);
		echo '<span class="post-cat leffect-1"><i class="dashicons dashicons-category"></i> '.$cat.'</span>';
		}
	}

}

/*Filter searchform button markup*/
add_filter( 'get_search_form','gesus_modify_search_form');

function gesus_modify_search_form( $form ) {
    $form = '<form class="password-form" role="search" method="get" id="search-form" action="' .esc_url(home_url( '/' )) . '" >
    <div><label class="screen-reader-text" for="s">' . esc_attr__( 'Search for:','gesus' ) . '</label>
    <input type="text" placeholder="' . esc_attr__( 'Type and hit enter','gesus' ) . '" class="form-control" value="' . get_search_query() . '" name="s" id="s" />
    <button type="submit"><i class="dashicons dashicons-search"></i></button>
    </div>
    </form>';
 
    return $form;
}
 

/*Filter password form markup*/
add_filter( 'the_password_form', 'gesus_password_form' );
function gesus_password_form() {
	 global $post;
	 $label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
	 $o = '<form class="postpass-form" action="' .
    esc_url( site_url( 'wp-login.php?action=postpass',
                      'login_post' ) ) .
    '" method="post">
	 ' . esc_attr__( 'This post is password protected and this is what I want to say about that. To view it please enter your password below:','gesus') . '
	 <input class="post-pass" name="post_password" placeholder="' . esc_attr__( 'Type and hit enter','gesus' ) . '" id="' . $label . '" type="password" />
	 </form>
	 ';
	 return $o;
}

/*No main nav fallback*/
function gesus_no_main_nav( $args ) {
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }
    extract( $args );

    $link = $link_before.'<a href="' .esc_url(admin_url( 'nav-menus.php' )). '">' . $before . esc_attr__('Please assign PRIMARY menu location','gesus') . $after . '</a>'. $link_after;

    if ( FALSE !== stripos( $items_wrap, '<ul' ) or FALSE !== stripos( $items_wrap, '<ol' ) ){
        $link = "<li>$link</li>";
    }

    $output = sprintf( $items_wrap, $menu_id, $menu_class, $link );
    if ( ! empty ( $container ) ){
        $output  = "<$container class='$container_class' id='$container_id'>$output</$container>";
    }

    if ( $echo ){
        echo gesus_html($output);
    }

    return $output;
}

function gesus_navigation(){

	if ( gesus_theme_option('enb_single_nav') ) {

		do_action('gesus_single_navigation');

	} else { ?>
        <?php
        $prev = get_previous_post(true);
        $next = get_next_post(true);

        if ($prev) {?>
        
           
                <a href="<?php echo get_permalink($prev->ID); ?>" class="gesus-btn prev-post-btn"><span><i class="fal fa-long-arrow-left"></i></span> Prev post</a>
           
        <?php } if ($next) {?>
        
               <a href="<?php echo get_permalink($next->ID); ?>" class="gesus-btn next-post-btn">Next post <span><i class="fal fa-long-arrow-right"></i></span></a>
            
        <?php }?>

    <?php }
}
function gesus_numeric_posts_nav() {

    if( is_singular() )
        return;

    global $wp_query;

    /** Stop execution if there's only 1 page */
    if( $wp_query->max_num_pages <= 1 )
        return;

    $paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
    $max   = intval( $wp_query->max_num_pages );

    /** Add current page to the array */
    if ( $paged >= 1 )
        $links[] = $paged;

    /** Add the pages around the current page to the array */
    if ( $paged >= 3 ) {
        $links[] = $paged - 1;
        $links[] = $paged - 2;
    }

    if ( ( $paged + 2 ) <= $max ) {
        $links[] = $paged + 2;
        $links[] = $paged + 1;
    }

    echo '<nav class="gesus-pagination wow fadeInUp">
								<ul>' . "\n";

    /** Previous Post Link */
    if ( get_previous_posts_link() )
        printf( '<li>%s</li>' . "\n", get_previous_posts_link('<i class="fas fa-angle-double-left"></i>') );

    /** Link to first page, plus ellipses if necessary */
    if ( ! in_array( 1, $links ) ) {
        $class = 1 == $paged ? ' class="active"' : '';

        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );

        if ( ! in_array( 2, $links ) )
            echo '<li>…</li>';
    }

    /** Link to current page, plus 2 pages in either direction if necessary */
    sort( $links );
    foreach ( (array) $links as $link ) {
        $class = $paged == $link ? ' class="active"' : '';
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
    }

    /** Link to last page, plus ellipses if necessary */
    if ( ! in_array( $max, $links ) ) {
        if ( ! in_array( $max - 1, $links ) )
            echo '<li>…</li>' . "\n";

        $class = $paged == $max ? ' class="active"' : '';
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
    }

    /** Next Post Link */
    if ( get_next_posts_link() )
        printf( '<li>%s</li>' . "\n", get_next_posts_link('<i class="fas fa-angle-double-right"></i>') );

    echo '</ul></nav>' . "\n";

}
function gesus_pagination(){

	if ( gesus_theme_option('enb_pagination') ) {

		do_action('gesus_pagination');

	} else {

        gesus_numeric_posts_nav();

	}
}

function gesus_share_tags(){

	if ( gesus_theme_option('enb_share_tag') ) {

		do_action('gesus_share_tags');

	} else {
		
		gesus_post_tag();
	}
}

function gesus_related_post(){

	if ( gesus_theme_option('enb_rpost') ) {

		do_action('gesus_related_post');

	}
 
}

function gesus_authorbox(){

	if ( gesus_theme_option('enb_authbox') ) {

		do_action('gesus_authorbox');
	}
 
}

function gesus_dynamic_header(){
    $header_switch = get_meta_custom_thm('header_switch');
    $opt_header = gesus_theme_option('opt_header');
    $opt_page_header = gesus_theme_option('opt_page_header');

    if ($header_switch == '1'){
          do_action('gesus_header');
    }
    else{
        if (!is_page_template('theme-builder.php') && !empty($opt_page_header)) {
            echo do_shortcode('[INSERT_ELEMENTOR id="'.$opt_page_header.'"]');
        }
        elseif (is_page_template('theme-builder.php') && !empty($opt_header)) {
            echo do_shortcode('[INSERT_ELEMENTOR id="' . $opt_header . '"]');
        }else{
            get_template_part('template-parts/header','one');
        }
    }
}
function gesus_dynamic_footer(){
    $footer_switch = get_meta_custom_thm('footer_switch');
    $opt_footer = gesus_theme_option('opt_footer');

    if ($footer_switch == '1'){
       do_action('gesus_footer');
    }
    else{
       if (!empty($opt_footer)) {
           echo do_shortcode('[INSERT_ELEMENTOR id="' . $opt_footer . '"]');
       }else{
           get_template_part('template-parts/footer','one');
       }
    }
}