<?php

get_header();
pageBanner([
    'title' => 'All Programs',
    'subtitle' => 'There is something for everyone. Have a look around.',
]); ?>

<div class="container container--narrow page-section">
    <ul class="link-list min-list">
        <?php
    while (have_posts()) {
        the_post(); ?>
        <li><a
                href="<?php echo the_permalink(); ?>"><?php echo the_title(); ?></a>
        </li>
        <?php }
    echo paginate_links();
?>
    </ul>
</div>
<?php
get_footer();
?>