
<?php
//global $theme_options;
$theme_options = nickonstart_theme_options();
?>

<footer class="footer" id="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 col-6">
                <h4><?php _e( 'Information', 'nickon-start' ) ?></h4>
	            <?php
	            wp_nav_menu(
		            [
			            'theme_location' => 'footer-menu',
			            'menu_class'     => 'list-unstyled',
			            'container'      => false,
			            'walker'         => new Nickonstart_Footer_Menu(),
		            ]
	            )
	            ?>
            </div>
	        <?php if ( ! empty( $theme_options['address'] ) ) : ?>
            <div class="col-md-3 col-6">
                <h4><?php _e( 'Our address', 'nickon-start' ) ?></h4>
                <ul class="list-unstyled">
                    <li><?php echo $theme_options['address'] ?></li>
	                <?php if ( ! empty( $theme_options['working_hours'] ) ) : ?>
                    <li><?php echo $theme_options['working_hours'] ?></li>
	                <?php endif; ?>
                </ul>
            </div>
	        <?php endif; ?>
            <div class="col-md-3 col-6">
                <h4><?php _e( 'Contacts', 'nickon-start' ) ?></h4>
                <ul class="list-unstyled">
	                <?php if ( ! empty( $theme_options['phone_1'] ) ) : ?>
                    <li><a href="tel:+<?php echo str_replace(
		                    [' ', '-', '+', '(', ')'], '', $theme_options['phone_1']
	                    ) ?>"><?php echo $theme_options['phone_1'] ?></a></li>
	                <?php endif; ?>
	                <?php if ( ! empty( $theme_options['phone_2'] ) ) : ?>
                    <li><a href="+<?php echo str_replace(
		                    [' ', '-', '+', '(', ')'], '', $theme_options['phone_2']
	                    ) ?>"><?php echo $theme_options['phone_2'] ?></a></li>
	                <?php endif; ?>
                </ul>
            </div>

            <div class="col-md-3 col-6">
                <h4><?php _e( 'Follow us', 'nickon-start' ) ?></h4>
                <ul class="footer-icons">
                    <li>
	                    <?php if ( ! empty( $theme_options['youtube'] ) ) : ?>
                        <a href="<?php echo $theme_options['youtube'] ?>"><i class="fa-brands fa-youtube"></i></a>
	                    <?php endif; ?>
                    </li>
                    <li>
	                    <?php if ( ! empty( $theme_options['facebook'] ) ) : ?>
                        <a href="<?php echo $theme_options['facebook'] ?>"><i class="fa-brands fa-facebook-f"></i></a>
	                    <?php endif; ?>
                    </li>
                    <li>
	                    <?php if ( ! empty( $theme_options['instagram'] ) ) : ?>
                        <a href="<?php echo $theme_options['instagram'] ?>"><i class="fa-brands fa-instagram"></i></a>
	                    <?php endif; ?>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>
</div> <!-- wrapper end -->

<button id="top">
    <i class="fa-solid fa-angles-up"></i>
</button>

<?php wp_footer() ?>
</body>
</html>