<?php    
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}



function sohan_team_shortcode($atts) {
    extract(shortcode_atts(array(
        'count' => -1,
        'title' => '',
        'template_no' => '2'
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

            $term_obj_list1 = get_the_terms($post_id, 'department');
            $department_names = join(', ', wp_list_pluck($term_obj_list1, 'name'));

            $term_obj_list2 = get_the_terms($post_id, 'designation');
            $designation_names = join(', ', wp_list_pluck($term_obj_list2, 'name'));

            // Retrieve custom meta data
            $phone = get_post_meta($post_id, '_team_sohan_phone', true);
            $email = get_post_meta($post_id, '_team_sohan_email', true);

            // Include the template file and pass necessary variables
            ob_start();
            $template_path = locate_template('templates/team-list-template-'.$template_no.'.php') ? locate_template('templates/team-list-template-'.$template_no.'.php') : plugin_dir_path(__FILE__) . 'templates/team-list-template-'.$template_no.'.php';
            include $template_path;
            $sohan_team_markup .= ob_get_clean();

        endwhile;

        $sohan_team_markup .= '</div>';

    } else {
        $sohan_team_markup = '<div class="stp-no-posts">No team members found.</div>';
    }

    wp_reset_query();

    return $sohan_team_markup;
}
add_shortcode('sohan_team', 'sohan_team_shortcode');

