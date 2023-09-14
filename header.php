<!DOCTYPE html>
<html <?php echo language_attributes(); ?>>

<head>
    <meta
        charset="<?php echo bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>

<body <?php echo body_class(); ?>>
    <header class="site-header">
        <div class="container">
            <h1 class="school-logo-text float-left">
                <a href="<?php echo site_url(); ?>"><strong>Fictional</strong>
                    University</a>
            </h1>
            <span class="js-search-trigger site-header__search-trigger"><i class="fa fa-search"
                    aria-hidden="true"></i></span>
            <i class="site-header__menu-trigger fa fa-bars" aria-hidden="true"></i>
            <div class="site-header__menu group">
                <nav class="main-navigation">
                    <ul>
                        <li <?php echo (is_page('about-us') or 14 == wp_get_post_parent_id(0)) ? 'class="current-menu-item"' : ''; ?>><a
                                href="<?php echo site_url('/about-us'); ?>">About
                                Us</a></li>
                        <li <?php if ('program' == get_post_type()) {
                            echo 'class="current-menu-item"';
                        }
?>><a href="<?php echo get_post_type_archive_link('program'); ?>">Programs</a>
                        </li>
                        <li <?php if ('event' == get_post_type() or is_page('past-events')) {
                            echo 'class="current-menu-item"';
                        }
?>><a href="<?php echo get_post_type_archive_link('event'); ?>">Events</a>
                        </li>
                        <li><a href="#">Campuses</a></li>
                        <li <?php if ('post' == get_post_type()) {
                            echo 'class="current-menu-item"';
                        }
?>><a href="<?php echo site_url('/blog'); ?>">Blog</a>
                        </li>
                    </ul>
                </nav>
                <div class="site-header__util">
                    <a href="#" class="btn btn--small btn--orange float-left push-right">Login</a>
                    <a href="#" class="btn btn--small btn--dark-orange float-left">Sign Up</a>
                    <span class="search-trigger js-search-trigger"><i class="fa fa-search"
                            aria-hidden="true"></i></span>
                </div>
            </div>
        </div>
    </header>