<?php
/**
 * @package sunix
 * @subpackage sunix
 * @since 1.0.0
 * @author EF5 Team
*/

if ( ! function_exists( 'sunix_posted_by' ) ) :
    /**
     * Prints HTML with meta information for the current post author.
     */
    function sunix_posted_by($args=[]){
        global $post;
        $author_id   = $post->post_author;
        $args = wp_parse_args($args, [
            'class'              => '',
            'hint'               => esc_html__( 'Posted By', 'sunix' ),
            'icon'               => '',
            'author_avatar'      => true,
            'before_author_name' => esc_html__( 'Posted By', 'sunix' ).' ',
            'after_author_name'  => '',
            'show_author'        => '1',
            'echo'               => true   
        ]);
        if($args['show_author'] !== '1') return;
        $classes = ['red-posted-by', $args['class']];
        if($args['author_avatar']) $classes[] = 'align-items-center';
        if ( ! get_the_author() )
        {
            if ( ! $post instanceof WP_Post )
            {
                return;
            }
            $author_name = get_the_author_meta( 'display_name', $author_id );
            $author_url  = get_author_posts_url( $author_id );
        }
        else
        {
            $author_name = get_the_author();
            $author_url  = get_author_posts_url( get_the_author_meta( 'ID' ) );
        }
        $author_avatar = $args['author_avatar'] ? get_avatar($author_id, 21, '', $author_name, array('class' => 'circle')) : '';
        ob_start();
            printf(
                '<div class="%1$s" data-hint="%2$s">
                    %3$s %4$s <a class="author-url" href="%5$s">%6$s</a>%7$s
                </div>',
                trim(implode(' ', $classes)),
                esc_html($args['hint']),
                !empty($args['icon']) ? '<span class="'.$args['icon'].'"> </span>' : '',
                $args['before_author_name'],
                esc_url( $author_url ),
                esc_html( $author_name ),
                $args['after_author_name']
            );  
        if($args['echo']){
            echo ob_get_clean();
        } else {
            return ob_get_clean();
        }
    }
endif;

if ( ! function_exists( 'sunix_posted_on' ) ) :
    /**
     * Prints HTML with meta information for the current post-date/time.
     */
    function sunix_posted_on($args=[])
    {
        $args = wp_parse_args($args,[
            'class'       => '',
            'hint'        => esc_html__( 'Published on', 'sunix' ),
            'hint_update' => esc_html__( 'Updated on', 'sunix' ),
            'icon'        => '',
            'icon_update' => '',
            'before_date' => '',
            'after_date'  => '',
            'show_update' => false,
            'show_date'   => '1',
            'echo'        => true  
        ]);
        if($args['show_date'] !== '1') return;

        $time_string = '<span class="published" data-time="%1$s">%2$s</span>';
        $posted_time1= '<span class="day">'.get_the_date ('d').'</span><span class="month-year">'.get_the_date('M Y').'</span>';
        $posted_time = sprintf( $time_string,
            esc_attr( get_the_date( 'c' ) ),
            $posted_time1
        );

        $classes = ['red-date', 'red-posted-on', $args['class']];
        if($args['show_update']) $classes[] = 'red-updated-on';
        ob_start();
            printf(
                '<div class="%1$s" data-hint="%2$s">
                    %3$s%4$s<a href="%5$s" rel="bookmark">%6$s</a>%7$s
                </div>',
                trim(implode(' ', $classes)),
                esc_html($args['hint']),
                !empty($args['icon']) ? '<span class="'.$args['icon'].'">&nbsp;&nbsp;</span>' : '',
                $args['before_date'],
                !is_single() ? esc_url( get_permalink()) : '',
                $posted_time,
                $args['after_date']
            );
            if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) && $args['show_update'] )
            {
                $time_string = '<span class="updated" data-datetime="%1$s">%2$s</span>';
                $updated_time = sprintf( $time_string,
                    esc_attr( get_the_modified_date( 'c' ) ),
                    esc_html( get_the_modified_date() )
                );
                printf(
                    '<div class="%1$s" data-hint="%2$s">
                        %3$s%4$s<a href="%5$s" rel="bookmark">%6$s</a>%7$s
                    </div>',
                    trim(implode(' ', $classes)),
                    esc_html($args['hint_update']),
                    !empty($args['icon_update']) ? '<span class="'.$args['icon_update'].'">&nbsp;&nbsp;</span>' : '',
                    $args['before_date'],
                    !is_single() ? esc_url( get_permalink()) : '',
                    $updated_time,
                    $args['after_date']
                );
            }
        if($args['echo']){
            echo ob_get_clean();
        } else {
            return ob_get_clean();
        }
    }
endif;


if ( ! function_exists( 'sunix_posted_in' ) ) :
    /**
     * Prints HTML with meta information for the current post-date/time.
     */
    function sunix_posted_in($args = []){
        $args = wp_parse_args($args, [
            'class'           => '',
            'hint'            => esc_html__( 'Posted in', 'sunix' ),
            'icon'            => '',
            'before'          => '',
            'after'           => '',
            'before_category' => '',
            'after_category'  => '',
            'sep'             => ', ',
            'show_cat'        => '1',
            'echo'            => true,
            'post_type'       => 'post'  
        ]);
        if($args['show_cat'] !== '1') return;

        $classes = ['red-posted-in', $args['class']];
        $taxo = sunix_get_post_taxonomies();
        $terms = get_the_term_list( get_the_ID(), $taxo, '', $args['sep'], '' );
        ob_start();
            if ( !empty($terms))
            {
                printf(
                    '%1$s<div class="%2$s" data-hint="%3$s">
                        %4$s %5$s %6$s %7$s
                    </div>%8$s',
                    $args['before'],
                    trim(implode(' ', $classes)),
                    esc_html($args['hint']),
                    !empty($args['icon']) ? '<span class="'.esc_attr($args['icon']).'">&nbsp;&nbsp;</span>' : '',
                    $args['before_category'],
                    $terms,
                    $args['after_category'],
                    $args['after']
                );
            }
        if($args['echo']){
            echo ob_get_clean();
        } else {
            return ob_get_clean();
        }
    }
endif;


if ( ! function_exists( 'sunix_tagged_in' ) ) :
    /**
     * Prints HTML with meta information for the current post-date/time.
     */
    function sunix_tagged_in($args = []){
        $args = wp_parse_args($args, [
            'class'      => '',
            'hint'       => '',
            'icon'       => '',
            'before'     => '',
            'after'      => '',
            'before_tag' => '',
            'after_tag'  => '',
            'sep'        => ', ',
            'show_tag'   => is_single() ? sunix_get_theme_opt( 'post_tags_on', '1' ) : sunix_get_theme_opt( 'archive_tags_on', '1' ),
            'echo'       => true
        ]);
        if('1' !== $args['show_tag']) return;
        $classes = ['red-tagged-in hint--top', $args['class']];
        $tags_list = get_the_term_list( get_the_ID(), sunix_get_post_taxonomies('tag'), '', $args['sep'], '' );
        ob_start();
            if ( $tags_list)
            {
                printf(
                    '%1$s<div class="%2$s" data-hint="%3$s">
                        %4$s %5$s %6$s %7$s
                    </div>%8$s',
                    $args['before'],
                    trim(implode(' ', $classes)),
                    esc_html($args['hint']),
                    !empty($args['icon']) ? '<span class="'.$args['icon'].'"></span>' : '',
                    $args['before_tag'],
                    $tags_list,
                    $args['after_tag'],
                    $args['after']
                );
            }
        if($args['echo']){
            echo ob_get_clean();
        } else {
            return ob_get_clean();
        }
    }
endif;

/**
 * Prints comments count with link to single post comment form.
 */
if ( ! function_exists( 'sunix_comments_popup_link' ) ) {
    function sunix_comments_popup_link($args = [])
    {
        $args = wp_parse_args($args, [
            'class'     => '',
            'before'    => '',
            'after'     => '',
            'icon'      => '',
            'echo'      => true,
            'show_text' => true,
            'show_cmt'  => '1'
        ]);
        if($args['show_cmt'] !== '1') return;

        $classes = trim(implode(' ', ['red-comments-link', $args['class']] ));
        $args['icon'] = !empty($args['icon']) ? '<span class="'.$args['icon'].'"></span>' : '';
        ob_start();
        $number    = (int) get_comments_number( get_the_ID() );
        if ( ! post_password_required() && ( comments_open() || get_comments_number() ) )
        {
            echo '<div class="'.esc_attr($classes).'">';
            printf ('%s' , $args['before']);
            if(!$args['show_text']){
                comments_popup_link(
                    sprintf('<span data-hint="%s">%s %s</span>',esc_html__('Be the first to comment','sunix'), $args['icon'], $number),
                    sprintf('<span data-hint="%s">%s %s</span>',esc_html__('Post a comment','sunix'), $args['icon'], $number),
                    sprintf('<span data-hint="%s">%s %s</span>',esc_html__('Post a comment','sunix'), $args['icon'], $number)
                );
            } else {
                comments_popup_link(
                    sprintf('<span data-hint="%s">%s %s %s</span>',esc_html__('Be the first to comment','sunix'), $args['icon'], $number, esc_html__('Comments','sunix')),
                    sprintf('<span data-hint="%s">%s %s %s</span>',esc_html__('Post a comment','sunix'), $args['icon'], $number, esc_html__('Comment','sunix')),
                    sprintf('<span data-hint="%s">%s %s %s</span>',esc_html__('Post a comment','sunix'), $args['icon'], $number, esc_html__('Comments','sunix'))
                );
            }
            printf ('%s' , $args['after']);
            echo '</div>';
        }
        if($args['echo'] === true)
            echo ob_get_clean();
        else 
            return ob_get_clean();
    }
}

/**
 * Count views
 * Show count of viewed 
*/
function sunix_post_count_view($args=[]){
    $args = wp_parse_args($args, [
        'show_view' => '1',
        'class'     => '',
        'before'    => '',
        'after'     => '',
        'icon'      => '',
        'echo'      => true,
        'show_text' => true
    ]);
    if($args['show_view'] !== '1') return;

    $classes = trim(implode(' ', ['red-view', $args['class']] ));
    $args['icon'] = !empty($args['icon']) ? '<span class="meta-icon '.$args['icon'].'"></span>' : '';
    ob_start();
        $view_number    = 100;
        echo '<div class="'.esc_attr($classes).'">';
            printf ('%s' , $args['before']);
            printf ('%s' , $args['icon']);
                printf(
                    _nx(
                        '%1$s %2$s',
                        '%1$s %3$s',
                        $view_number,
                        'view title',
                        'sunix'
                    ),
                    number_format_i18n( $view_number ),
                    $args['show_text'] ? esc_html__(' View','sunix') : '',
                    $args['show_text'] ? esc_html__(' Views','sunix') : ''
                );
            printf ('%s' , $args['after']);
        echo '</div>';
    
    if($args['echo'] === true)
        echo ob_get_clean();
    else 
        return ob_get_clean();
}

class sunix_Like_Post {
    function __construct()   {
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
        add_action('wp_ajax_like-post', array($this, 'ajax'));
        add_action('wp_ajax_nopriv_like-post', array($this, 'ajax'));
    }

    function enqueue_scripts() {
        wp_register_script( 'sunix-likepost', get_template_directory_uri() . '/vc_extends/like-posts.js', 'jquery', '1.0', TRUE );
        global $post;
        wp_localize_script('sunix-likepost', 'sunix_Like_Post', array(
            'ajaxurl' => admin_url('admin-ajax.php'),
            'postID' => $post ? $post->ID : 0,
            'rooturl' => home_url('/')
        ));
        wp_enqueue_script('sunix-likepost');
    }

    function ajax($post_id) {
        //update
        if( isset($_POST['loves_id']) ) {
            $post_id = str_replace('like-post-', '', $_POST['loves_id']);
            echo ''.$this->love_post($post_id, 'update');
        }
        //get
        else {
            $post_id = str_replace('like-post-', '', $_POST['loves_id']);
            echo ''.$this->love_post($post_id, 'get');
        }
        exit;
    }

    function love_post($post_id, $action = 'get')
    {
        if(!is_numeric($post_id)) return;
        $love_count = (int)get_post_meta($post_id, '_like_post', true);
        switch($action) {

            case 'get':
                if( !$love_count ){
                    $love_count = 0;
                    add_post_meta($post_id, '_like_post', $love_count, true);
                }
                return $love_count;
                break;

            case 'update':

                if( isset($_COOKIE['like'. $post_id]) ) return $love_count;
                $love_count++;
                update_post_meta($post_id, '_like_post', $love_count);
                setcookie('like_post_'. $post_id, $post_id, time()*5, '/');

                return  $love_count ;
                break;

        }
    }

    function add_love($args = []) {

        $args = wp_parse_args($args, [
            'title'       => esc_html__('Like this?', 'sunix'),
            'title_liked' => esc_html__('You already liked this!', 'sunix'),
            'show_text'   => true,
            'show_icon'   => true,
            'text'        => esc_html__('Like','sunix'),
            'texts'       => esc_html__('Likes','sunix'),
            'text_liked'  => esc_html__('Liked!','sunix'),
            'icon'        => 'flaticon-heart',
            'icon_liked'  => 'flaticon-heart'
        ]);

        global $post;

        $output = $this->love_post($post->ID);

        $class = 'like-post';
        $icon_class = 'icon-like meta-icon '.$args['icon'];
        $title = $args['title'];

        $love_count = (int)get_post_meta($post->ID, '_like_post', true);
        if($love_count == 1){
            $text = $args['text'];
        } else {
            $text = $args['texts'];
        }
        if( isset($_COOKIE['like_post_'. $post->ID]) ){
            $class = 'like-post liked unselected';
            $icon_class = 'icon-like '.$args['icon_liked'];
            $title = $args['title_liked'];
        }
        $icon = '';
        if($args['show_icon']){
            $icon = '<span class="'.$icon_class.'"></span>';
        }
        return '<a href="#" class="'. $class .'" id="like-post-'. $post->ID .'" title="'. esc_attr($title) .'" data-title-liked="'.esc_attr($args['title_liked']).'" data-like-icon="'.esc_attr($args['icon']).'" data-liked-icon="'.esc_attr($args['icon_liked']).'"> '.$icon. '<span class="like-post-count">' . $output .'</span> '.$text.'</a>';
    }

}
global $sunix_like_post;
$sunix_like_post = new sunix_Like_Post();

function sunix_like_post($args = [],$return = false) {
    $args = wp_parse_args($args, [
        'before'      => '<div class="red-like">',
        'after'       => '</div>',
        'title'       => esc_html__('Like this?', 'sunix'),
        'title_liked' => esc_html__('You already liked this!', 'sunix'),
        'show_text'   => true,
        'show_icon'   => true,
        'text'        => esc_html__('Like','sunix'),
        'texts'       => esc_html__('Likes','sunix'),
        'text_liked'  => esc_html__('Liked!','sunix'),
        'icon'        => 'meta-icon  flaticon-heart',
        'icon_liked'  => 'meta-icon  flaticon-heart',
        'echo'      => true
    ]);
    global $sunix_like_post;
    ob_start();
    if($return) {
        return $args['before'].$sunix_like_post->add_love(['icon'=>$args['icon']]).$args['after'];
    } else {
        echo '' . $args['before'] . $sunix_like_post->add_love(['icon'=>$args['icon']]).$args['after'];
    }
    if($args['echo']){
        echo ob_get_clean();
    } else {
        return ob_get_clean();
    }
}

/**
 * Prints post edit link when applicable
 */
function sunix_edit_link($args = [])
{
    $args = wp_parse_args($args, [
        'class'     => '',
        'icon'      => 'meta-icon far fa-edit',
        'title'     => esc_html('Edit', 'sunix'),
        'hint'      => esc_html('Edit', 'sunix'),
        'before'    => '',
        'after'     => '',
        'show_edit' => false,
        'echo'      => true
    ]);
    $classes = ['red-edit-link', $args['class']];
    $args['icon'] = !empty($args['icon']) ? '<span class="'.esc_attr($args['icon']).'">&nbsp;&nbsp;</span>' : '';
    if(!$args['show_edit']) return;

    $before = $args['before'].'<div class="'.trim(implode(' ', $classes)).'" data-hint="'.esc_attr($args['hint']).'">'.$args['icon'];
    $after = '</div>'.$args['after'];
    ob_start();
        edit_post_link($args['title'], $before, $after );
    if($args['echo']){
        echo ob_get_clean();
    } else {
        return ob_get_clean();
    }
}

function sunix_link_pages()
{
    wp_link_pages( array(
        'before'      => sprintf( '<div class="page-links"><span class="red-heading">%s</span>', esc_html__( 'Pages:', 'sunix' ) ),
        'after'       => '</div>',
        'link_before' => '<span class="page-link-number">', 
        'link_after'  => '</span>'
    ) );
}

/**
 * Post Share
*/
if(!function_exists('sunix_post_share')){
    function sunix_post_share($args = array()){
        if(!class_exists('EF5Systems')) return;
        wp_enqueue_script('sharethis');
        global $post;
        $defaults = array(
            'show_share'  => is_single() ? sunix_get_theme_opt( 'post_share_on', '0' ) : sunix_get_theme_opt( 'archive_share_on', '0' ),
            'class'       => '',
            'show_title'  => true,
            'show_tooltip'  => true,
            'title'       => esc_html__('Share this article','sunix'),
            'social_args' => [],
            'echo'        => true
        );
        $args = wp_parse_args($args, $defaults);
        extract($args);
        if($show_share !== '1') return;

        $social_args    = wp_parse_args($social_args, ['class'=>'','size' => '28']);
        $social_classes = trim(implode(' ', ['red-social', $social_args['class'], 'size-'.$social_args['size']] ));

        $classes   = array('red-shares');
        $classes[] = $class;
        $classes[] = sunix_is_loop() ? 'loop': 'single';
        
        $url   = get_the_permalink();
        $image = get_the_post_thumbnail_url($post->ID);
        $title = get_the_title();

        if(is_singular()){
            $show_fb    = sunix_get_theme_opt( 'post_share_fb', '1' );
            $show_tw    = sunix_get_theme_opt( 'post_share_tw', '1' );
            $show_gplus = sunix_get_theme_opt( 'post_share_gplus', '1' );
            $show_pin   = sunix_get_theme_opt( 'post_share_pin', '1' );
            $show_all   = sunix_get_theme_opt( 'post_share_all', '1' );
        } else {
            $show_fb    = sunix_get_theme_opt( 'archive_share_fb', '1' );
            $show_tw    = sunix_get_theme_opt( 'archive_share_tw', '1' );
            $show_gplus = sunix_get_theme_opt( 'archive_share_gplus', '1' );
            $show_pin   = sunix_get_theme_opt( 'archive_share_pin', '1' );
            $show_all   = sunix_get_theme_opt( 'archive_share_all', '1' );
        }
        ob_start();
        if($show_fb == '1' || $show_tw == '1' || $show_gplus == '1' || $show_pin == '1' || $show_all == '1') {
        ?>
        <div class="<?php echo trim(implode(' ', $classes)); ?>">
            <?php if($show_title): ?>
                <div class="row justify-content-between align-items-center">
                    <div class="col-auto share-title">
                        <?php echo esc_html($args['title']); ?>
                    </div>
                    <div class="col-auto">
            <?php endif; ?>
                    <div class="<?php echo esc_attr($social_classes);?>">
                        <?php if($show_fb == '1'): ?>
                        <a <?php if ($show_tooltip){ ?>data-hint="<?php esc_attr_e('Share this post to Facebook','sunix'); ?>" data-toggle="tooltip" <?php } ?> href="javascript:void(0);" data-network="facebook" data-url="<?php echo esc_url($url);?>" data-short-url="<?php echo esc_url($url);?>" data-title="<?php echo esc_attr($title);?>" data-image="<?php echo esc_url($image); ?>" data-description="<?php echo get_the_excerpt(); ?>" data-username="" data-message="<?php echo bloginfo(); ?>" class="<?php if ($show_tooltip){ echo 'hint--top hint--bounce'; }?> facebook st-custom-button"><span class="fab fa-facebook-f"></span></a>
                        <?php endif;
                        if($show_tw == '1'): ?>
                        <a <?php if ($show_tooltip){ ?>data-hint="<?php esc_attr_e('Share this post to Twitter','sunix'); ?>" data-toggle="tooltip" <?php } ?> href="javascript:void(0);" data-network="twitter" data-url="<?php echo esc_url($url);?>" data-short-url="<?php echo esc_url($url);?>" data-title="<?php echo esc_attr($title);?>" data-image="<?php echo esc_url($image); ?>" data-description="<?php echo get_the_excerpt(); ?>" data-username="" data-message="<?php echo bloginfo(); ?>" class="<?php if ($show_tooltip){ echo 'hint--top hint--bounce'; }?> twitter st-custom-button"><span class="fab fa-twitter"></span></a>
                        <?php endif;
                        if($show_gplus == '1'): ?>
                        <a <?php if ($show_tooltip){ ?>data-hint="<?php esc_attr_e('Share this post to Google Plus','sunix'); ?>" data-toggle="tooltip" <?php } ?> href="javascript:void(0);" data-network="googleplus" data-url="<?php echo esc_url($url);?>" data-short-url="<?php echo esc_url($url);?>" data-title="<?php echo esc_attr($title);?>" data-image="<?php echo esc_url($image); ?>" data-description="<?php echo get_the_excerpt(); ?>" data-username="" data-message="<?php echo bloginfo(); ?>" class="<?php if ($show_tooltip){ echo 'hint--top hint--bounce'; }?> googleplus st-custom-button"><span class="fab fa-google-plus"></span></a>
                        <?php endif;
                        if($show_pin == '1'): ?>
                        <a <?php if ($show_tooltip){ ?>data-hint="<?php esc_attr_e('Share this post to Pinterest','sunix'); ?>" data-toggle="tooltip" <?php } ?> href="javascript:void(0);" data-network="pinterest" data-url="<?php echo esc_url($url);?>" data-short-url="<?php echo esc_url($url);?>" data-title="<?php echo esc_attr($title);?>" data-image="<?php echo esc_url($image); ?>" data-description="<?php echo get_the_excerpt(); ?>" data-username="" data-message="<?php echo bloginfo(); ?>" class="<?php if ($show_tooltip){ echo 'hint--top hint--bounce'; }?> pinterest st-custom-button"><span class="fab fa-pinterest"></span></a>
                        <?php endif;
                        if($show_all == '1'): ?>
                        <a <?php if ($show_tooltip){ ?>data-hint="<?php esc_attr_e('Share this post to','sunix'); ?>" data-toggle="tooltip" <?php } ?> href="javascript:void(0);" data-network="sharethis" data-url="<?php echo esc_url($url);?>" data-short-url="<?php echo esc_url($url);?>" data-title="<?php echo esc_attr($title);?>" data-image="<?php echo esc_url($image); ?>" data-description="<?php echo get_the_excerpt(); ?>" data-username="" data-message="<?php echo bloginfo(); ?>" class="<?php if ($show_tooltip){ echo 'hint--top hint--bounce'; }?> sharethis st-custom-button"><span class="fa fa-share-alt"></span></a>
                        <?php endif; ?>
                    </div>
            <?php if($show_title): ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <?php
        }
        if($echo)
            echo ob_get_clean();
        else 
            return ob_get_clean();
    }
}

/**
 * Post Read more Button 
*/
if ( ! function_exists( 'sunix_post_read_more' ) ) {
    /**
     * Prints post read more link
     */
    function sunix_post_read_more($args = [])
    {
        $args = wp_parse_args($args,[
            'class'          => '',
            'icon_left'      => '',
            'title'          => esc_html__('Read More','sunix'),
            'readmore_class' => 'red-btn ',
            'show_readmore'  => sunix_get_theme_opt( 'archive_readmore', '1' ),
            'before'         => '',
            'after'          => '',
            'echo'           => true
        ]);
        if('1' != $args['show_readmore']) return;
        $classes = ['red-readmore', $args['class'], $args['readmore_class']];
        ob_start();
            printf(
                '%1$s<a href="%2$s" title="%3$s" class="%4$s">%5$s %6$s %7$s</a>%8$s',
                $args['before'],
                esc_url( get_the_permalink() ),
                esc_attr( get_the_title() ),
                sunix_optimize_css_class(implode(' ', $classes)),
                !empty($args['icon_left']) ? '<span class="'.esc_attr($args['icon_left']).'"></span>&nbsp;&nbsp;' : '',
                '<span>'.$args['title'].'</span>',
                !empty($args['icon_right']) ? '&nbsp;&nbsp;<span class="'.esc_attr($args['icon_right']).'"></span>' : '',
                $args['after']
            );
        if($args['echo'])
            echo ob_get_clean();
        else 
            return ob_get_clean();
    }
}
/**
 * Post Read more Circle 
 * Prints post read more link
*/
if ( ! function_exists( 'sunix_post_read_more_circle' ) ) {
    function sunix_post_read_more_circle($args = [])
    {
        $args = wp_parse_args($args,[
            'class'          => '',
            'bgcolor'        => 'bg-accent',
            'size'           => '60',
            'shape'          => 'circle',
            'icon'           => 'flaticon-add',
            'title'          => esc_html__('Read More','sunix'),
            'readmore_class' => '',
            'show_readmore'  => '1',
            'before'         => '',
            'after'          => '',
            'echo'           => true
        ]);
        if('1' != $args['show_readmore']) return;
        $classes = ['red-icon', $args['bgcolor'], 'size-'.$args['size'], $args['shape'], 'red-shadow-hover', 'hint--top', $args['class'], $args['readmore_class']];
        ob_start();
            printf(
                '%1$s<a href="%2$s" title="%3$s" class="%4$s" data-hint="%5$s">%6$s %7$s</a>%8$s',
                $args['before'],
                esc_url( get_the_permalink() ),
                esc_attr( get_the_title() ),
                sunix_optimize_css_class(implode(' ', $classes)),
                esc_attr($args['title']),
                !empty($args['icon']) ? '<span class="'.esc_attr($args['icon']).'"></span>' : '<span class="red-i-plus center-align transition"></span>',
                '',
                $args['before']
            );
        if($args['echo'])
            echo ob_get_clean();
        else 
            return ob_get_clean();
    }
}