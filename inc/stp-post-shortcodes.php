<?php    
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function sohan_team_shortcode($atts){
    extract(shortcode_atts(array(
        'count' => -1
    ), $atts));

    $arg = array(
        'post_type' => 'team-sohan',
        'posts_per_page' => $count,
    );

    $get_post = new WP_Query($arg);

    if ($get_post->have_posts()) {
        $sohan_team_markup = '<div class="stp-team-wrapper">';

        while ($get_post->have_posts()) : $get_post->the_post();
            $post_id = get_the_ID();

            $term_obj_list1 = get_the_terms( $post_id, 'department' );
            $department_names = join(', ', wp_list_pluck($term_obj_list1, 'name'));

            $term_obj_list2 = get_the_terms( $post_id, 'designation' );
            $designation_names = join(', ', wp_list_pluck($term_obj_list2, 'name'));

            // Retrieve custom meta data
            $phone = get_post_meta($post_id, '_team_sohan_phone', true);
            $email = get_post_meta($post_id, '_team_sohan_email', true);

            $sohan_team_markup .= '
                <div class="stp-single-team-content">';
                if ( has_post_thumbnail($post_id) ) {
                    $sohan_team_markup .= 
                    '<div class="stp-member-image">
                    ' . get_the_post_thumbnail($post_id, 'medium') . '
                    </div>';
                }

            $sohan_team_markup .= '<div class="stp-member-name">' . get_the_title($post_id) . '</div>';

            if ( !empty($designation_names) ) {
                $sohan_team_markup .= '<div class="stp-designation"> Designation: ' . $designation_names . '</div>';
            }

            if ( !empty($department_names) ) {
                $sohan_team_markup .= '<div class="stp-department"> Department: ' . $department_names . '</div>';
            }

            if (!empty($phone)) {
                $sohan_team_markup .= '<div class="stp-phone">Phone: ' . esc_html($phone) . '</div>';
            }

            if (!empty($email)) {
                $sohan_team_markup .= '<div class="stp-email"><strong>Email: </strong><a href="mailto:' . esc_attr($email) . '">' . esc_html($email) . '</a></div>';
            }
           
            $sohan_team_markup .= '</div>';

        endwhile;

        $sohan_team_markup .= '</div>';

    } else {
        return $sohan_team_markup = '<div class="stp-no-posts">No team members found.</div>';
    }  

    wp_reset_query();

    return $sohan_team_markup;
}
add_shortcode('sohan_team', 'sohan_team_shortcode');
