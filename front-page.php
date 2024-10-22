<?php get_header() ?>

    <main class="main">

		<?php
		global $post;
		$slider   = get_posts( [
			'post_type' => 'slider',
			// 'order' => 'ASC'
		] );
		$cards    = get_posts( [
			'post_type' => 'card',
			 'order' => 'ASC'
		] );
		$about_us = get_post( 314 );
		?>

		<?php if ( $slider ) : ?>
            <div class="container">
                <div id="carousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="7500">
                    <div class="carousel-indicators">
						<?php for ( $i = 0; $i < count( $slider ); $i ++ ): ?>
                            <button type="button" data-bs-target="#carousel" data-bs-slide-to="<?php echo $i ?>"
							        <?php if ( $i == 0 ): ?>class="active"<?php endif; ?>
                                    aria-current="true" aria-label="Slide <?php echo $i + 1 ?>"></button>
						<?php endfor; ?>
                    </div>
                    <div class="carousel-inner">
						<?php $i = 0;
						foreach ( $slider as $post ): setup_postdata( $post ); ?>
                            <div class="carousel-item <?php if ( $i == 0 ): ?>active<?php endif; ?>">
                                <img src="<?php the_post_thumbnail_url( 'full' ) ?>"
                                     class="d-block w-100"
                                     alt="<?php the_title() ?>">
                                <div class="carousel-caption d-none d-md-block">
                                    <h2><?php the_title() ?></h2>
									<?php the_content( '' ); ?>
                                </div>
                            </div>
							<?php $i ++;
						endforeach;
						wp_reset_postdata(); ?>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>

		<?php endif; ?>

        <section class="home-categories">
            <div class="container">
                <div class="row mb-5">
                    <div class="col-12">
                        <h2 class="section-title">
                            <span><?php _e( 'Categories', 'nickon-start' ) ?></span>
                        </h2>
                    </div>
                </div>

				<?php echo do_shortcode( '[product_categories hide_empty="0"]' ) ?>

            </div>
        </section>

		<?php if ( $cards ): ?>
            <section class="advantages">
                <div class="container">
                    <div class="row mb-5">
                        <div class="col-12">
                            <h2 class="section-title">
                                <span><?php _e( 'Our advantages', 'nickon-start' ) ?></span>
                            </h2>
                        </div>
                    </div>

                    <div class="row gy-3 items">

						<?php foreach ( $cards as $post ): setup_postdata( $post ); ?>
                            <div class="col-lg-3 col-sm-6">
                                <div class="item">
	                                <?php the_content( '' ); ?>
                                </div>
                            </div>
						<?php endforeach;
						wp_reset_postdata(); ?>
                        <!--<div class="col-lg-3 col-sm-6">
                            <div class="item">
                                <p>
                                    <i class="fas fa-cubes"></i>
                                </p>
                                <p>Широкий ассортимент товаров. Более 10 тыс. наименований</p>
                            </div>
                        </div>

                        <div class="col-lg-3 col-sm-6">
                            <div class="item">
                                <p>
                                    <i class="fas fa-hand-holding-usd"></i>
                                </p>
                                <p>Приятные и конкурентные цены</p>
                            </div>
                        </div>

                        <div class="col-lg-3 col-sm-6">
                            <div class="item">
                                <p>
                                    <i class="fa-solid fa-user-graduate"></i>
                                </p>
                                <p>Консультации от профессионалов</p>
                            </div>
                        </div>-->
                    </div>

                </div>
            </section>
		<?php endif; ?>

        <section class="featured-products">
            <div class="container">
                <div class="row mb-5">
                    <div class="col-12">
                        <h2 class="section-title">
                            <span><?php _e( 'Featured products', 'nickon-start' ) ?></span>
                        </h2>
                    </div>
                </div>

				<?php echo do_shortcode( '[featured_products limit="8"]' ) ?>

            </div>
        </section>

        <section class="new-products">
            <div class="container">
                <div class="row mb-5">
                    <div class="col-12">
                        <h2 class="section-title">
                            <span><?php _e( 'New products', 'nickon-start' ); ?></span>
                        </h2>
                    </div>
                </div>

				<?php echo do_shortcode( '[nickonstart_new_products limit="8"]' ); ?>

            </div>
        </section>

		<?php if ( $about_us !== false ): ?>
            <section class="about-us" id="about">
                <div class="container">
                    <div class="row mb-5">
                        <div class="col-12">
                            <h2 class="section-title">
                                <span><?php echo $about_us->post_title; ?></span>
                            </h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
							<?php echo $about_us->post_content; ?>
                        </div>
                    </div>
                </div>
            </section>
		<?php endif; ?>

        <div class="container">
            <iframe id="map"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7733.207929812346!2d-3.2042436241346253!3d55.95551293968172!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4887c791f72b4e03%3A0x36e1c509aa1960e4!2zMSBRdWVlbiBTdCwgRWRpbmJ1cmdoIEVIMiAxSkQsINCS0LXQu9C40LrQvtCx0YDQuNGC0LDQvdC40Y8!5e0!3m2!1sru!2sua!4v1725995840848!5m2!1sru!2sua"
                    width="100%" height="450" style="border:0; display: block;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </main>

<?php get_footer() ?>