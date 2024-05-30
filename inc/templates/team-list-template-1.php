<?php
// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}
?>

<div class="stp-single-team-content">
    <?php if (has_post_thumbnail($post_id)) : ?>
        <div class="stp-member-image">
            <?php echo get_the_post_thumbnail($post_id, 'medium'); ?>
        </div>
    <?php endif; ?>

    <div class="stp-member-name"><?php echo get_the_title($post_id); ?></div>

    <?php if (!empty($designation_names)) : ?>
        <div class="stp-designation">Designation: <?php echo $designation_names; ?></div>
    <?php endif; ?>

    <?php if (!empty($department_names)) : ?>
        <div class="stp-department">Department: <?php echo $department_names; ?></div>
    <?php endif; ?>

    <?php if (!empty($phone)) : ?>
        <div class="stp-phone">Phone: <?php echo esc_html($phone); ?></div>
    <?php endif; ?>

    <?php if (!empty($email)) : ?>
        <div class="stp-email"><strong>Email: </strong><a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a></div>
    <?php endif; ?>
</div>
