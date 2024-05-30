<?php
// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}
?>

<div class="stp-single-team-content stp-style-2">
    <?php if (has_post_thumbnail($post_id)) : ?>
        <div class="stp-member-image">
            <?php echo get_the_post_thumbnail($post_id, 'medium'); ?>
        </div>
    <?php endif; ?>

    <div class="stp-member-name"><?php echo 'This is style 2'; ?></div>

    
</div>