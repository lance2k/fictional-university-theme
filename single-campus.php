<?php
get_header();
while (have_posts()) {
    the_post();
    pageBanner(); ?>

<div class="container container--narrow page-section">
    <div class="metabox metabox--position-up metabox--with-home-link">
        <p>
            <a class="metabox__blog-home-link"
                href="<?php echo get_post_type_archive_link('campus'); ?>"><i
                    class="fa fa-home" aria-hidden="true"></i> All Campuses</a> <span
                class="metabox__main"><?php echo the_title(); ?></span>
        </p>
    </div>
    <div class="generic-content"><?php echo the_content(); ?></div>

    <div class="acf-map">
        <?php
        $mapLocation = get_field('map_location');
    ?>
        <div class="marker"
            data-lat="<?php echo $mapLocation['lat']; ?>"
            data-lng="<?php echo $mapLocation['lng']; ?>">
            <h3>
                <?php echo the_title(); ?>
            </h3>
            <?php echo $mapLocation['address']; ?>
        </div>

    </div>

    <?php
        $relatedPrograms = new WP_Query([
            'posts_per_page' => '-1',
            'post_type' => 'program',
            'orderby' => 'title',
            'order' => 'ASC',
            'meta_query' => [
                [
                    'key' => 'related_campus',
                    'compare' => 'LIKE',
                    'value' => '"'.get_the_ID().'"',
                ],
            ],
        ]);

    if ($relatedPrograms->have_posts()) {
        ?>
    <hr class="section-break">
    <h2 class="headline headline--medium">
        Programs Available At This Campus
    </h2>
    <?php

        ?>
    <ul class="min-list link-list">
        <?php
                while ($relatedPrograms->have_posts()) {
                    $relatedPrograms->the_post(); ?>
        <li>
            <a href="<?php echo the_permalink(); ?>">
                <?php echo the_title(); ?>
            </a>
        </li>

        <?php }
                ?>
    </ul>
    <?php
    }
    wp_reset_postdata();
    ?>

</div>
<?php
}
get_footer();
?>