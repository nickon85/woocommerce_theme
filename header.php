<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( "charset" ); ?>>">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta name='robots' content='max-image-preview:large'>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<?php wp_head(); ?>
</head>

<body <?php body_class() ?>>
<?php wp_body_open(); ?>

<?php
//global $theme_options;
$theme_options = nickonstart_theme_options();
$wishlist      = /*nickonstart_get_wishlist()*/ defined( 'WISHLIST' ) ? WISHLIST : [];
?>

<div class="wrapper">

    <header class="header">
        <div class="header-top py-1">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-6 col-sm-4">
                        <div class="header-top-phone d-flex align-items-center h-100">
							<?php if ( ! empty( $theme_options['phone_1'] ) ) : ?>
                                <i class="fa-solid fa-mobile-screen"></i>
                                <a href="tel:+<?php echo str_replace(
									[ ' ', '-', '+', '(', ')' ], '', $theme_options['phone_1']
								) ?>" class="ms-2"><?php echo $theme_options['phone_1'] ?></a>
							<?php endif; ?>
                        </div>
                    </div>

                    <div class="col-sm-4 d-none d-sm-block">
                        <ul class="social-icons d-flex justify-content-center">
							<?php if ( ! empty( $theme_options['youtube'] ) ) : ?>
                                <li>
                                    <a href="<?php echo $theme_options['youtube'] ?>">
                                        <i class="fa-brands fa-youtube"></i>
                                    </a>
                                </li>
							<?php endif; ?>
							<?php if ( ! empty( $theme_options['facebook'] ) ) : ?>
                                <li>
                                    <a href="<?php echo $theme_options['facebook'] ?>">
                                        <i class="fa-brands fa-facebook-f"></i>
                                    </a>
                                </li>
							<?php endif; ?>
							<?php if ( ! empty( $theme_options['instagram'] ) ) : ?>
                                <li>
                                    <a href="<?php echo $theme_options['instagram'] ?>">
                                        <i class="fa-brands fa-instagram"></i>
                                    </a>
                                </li>
							<?php endif; ?>
                        </ul>
                    </div>

                    <div class="col-6 col-sm-4">
                        <div class="header-top-account d-flex justify-content-end">
                            <div class="btn-group me-2">
                                <div class="dropdown">
                                    <button class="btn btn-sm dropdown-toggle" type="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                        Account
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item" href="#">Sign In</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#">Sign Up</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="btn-group">
                                <div class="dropdown">
                                    <button class="btn btn-sm dropdown-toggle" type="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                        EN
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item" href="#">RU</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#">DE</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- ./header-top-account -->
                    </div>
                </div>
            </div>
        </div>
        <!-- ./header-top -->

        <div class="header-middle bg-white py-4">
            <div class="container-fluid">
                <div class="row align-items-center">

                    <div class="col-sm-6">
                        <a href="<?php echo home_url( '/' ) ?>" class="header-logo h1"><?php bloginfo( 'name' ); ?></a>
                    </div>

                    <div class="col-sm-6 mt-2 mt-md-0">
						<?php aws_get_search_form( true ); ?>
                    </div>

                </div>
            </div>

        </div>
        <!-- ./header-middle -->
    </header>

    <div class="header-bottom sticky-top" id="header-nav">
        <nav class="navbar navbar-expand-lg bg-dark" data-bs-theme="dark">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-expanded="false"
                        aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="offcanvas offcanvas-start" id="offcanvasNavbar" tabindex="-1"
                     aria-labelledby="offcanvasNavbarLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Catalog</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                                aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
						<?php
						wp_nav_menu(
							[
								'theme_location' => 'header-menu',
								'menu_class'     => 'navbar-nav',
								'container'      => false,
								'walker'         => new Nickonstart_Header_Menu(),
							]
						)
						?>
                    </div>
                </div>

                <div>
					<?php if ( ! is_page( 'wishlist' ) ): ?>
                        <a href="<?php echo get_permalink( get_page_by_path( 'wishlist' ) ) ?>" class="btn p-1" id="wishlist-link">
                            <i class="fa-solid fa-heart"></i>
                            <span class="badge text-bg-warning bg-warning rounded-circle"><?php echo count( $wishlist ); ?></span>
                        </a>
					<?php endif; ?>

					<?php if ( ! is_cart() ): ?>
                        <button class="btn p-1" id="cart-open" type="button" data-bs-toggle="offcanvas"
                                data-bs-target="#offcanvasCart" aria-controls="offcanvasCart">
                            <i class="fa-solid fa-cart-shopping"></i>
                            <span class="badge text-bg-warning cart-badge bg-warning rounded-circle">
                            <?php // echo WC()->cart->get_cart_contents_count(); ?>
                            <?php echo count( WC()->cart->get_cart() ); ?>
                        </span>
                        </button>
					<?php endif; ?>
                </div>

            </div>
        </nav>
    </div>
    <!-- ./header-bottom -->

	<?php if ( ! is_cart() ): ?>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasCart" aria-labelledby="offcanvasCartLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasCartLabel"><?php _e( 'Cart', 'nickon-start' ) ?></h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">

			<?php woocommerce_mini_cart(); ?>

        </div>
    </div>
<?php endif; ?>