<?php

define( "WISHLIST", nickonstart_get_wishlist_db() );
const WISHLIST_LIMIT = 3;

add_action( 'wp_ajax_nickonstart_wishlist_action', 'nickonstart_wishlist_action_callback' );
add_action( 'wp_ajax_nopriv_nickonstart_wishlist_action', 'nickonstart_wishlist_action_callback' );
add_action( 'wp_ajax_nickonstart_wishlist_action_db', 'nickonstart_wishlist_action_db_callback' );


/*
 * AJAX Cookies function
 * */
function nickonstart_wishlist_action_callback() {
	$product_id = nickonstart_wishlist_get_product_id();
	$wishlist   = nickonstart_get_wishlist();

	$answer = nickonstart_update_wishlist( $product_id, $wishlist );

	$wishlist = implode( ',', $wishlist );
	setcookie( 'wishlist', $wishlist, time() + ( 86400 * 365 ), '/' );

	wp_die( $answer );
}

/*
 * AJAX DB function
 * */
function nickonstart_wishlist_action_db_callback() {
	$product_id = nickonstart_wishlist_get_product_id();
	global $wpdb;
	$user_id = get_current_user_id();

	$wishlist = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM wp_wishlist WHERE user_id = %d", $user_id ) );
//	$wishlist = $wpdb->get_row(  "SELECT * FROM wp_wishlist WHERE user_id = $user_id"  );

	if ( ! $wishlist ) {
		if ( $wpdb->insert( 'wp_wishlist', [ 'user_id' => $user_id, 'products' => $product_id ], [ '%d', '%d' ] ) ) {
			$answer = json_encode( [
				'status' => 'success',
				'answer' => __( 'The product has been added to wishlist', 'nickon-start' ),
//				'wishlist' => WISHLIST,
			] );
		} else {
			$answer = json_encode( [
				'status' => 'error',
				'answer' => __( 'Error while adding to Wishlist', 'nickon-start' )
			] );
		}

		wp_die( $answer );
	}

	if ( $wishlist->products ) {
		$w_data = explode( ',', $wishlist->products );
	} else {
		$w_data = [];
	}

	$answer       = nickonstart_update_wishlist( $product_id, $w_data );
	$wishlist_upd = implode( ',', $w_data );

	if ( false !== $wpdb->update( 'wp_wishlist', [ 'products' => $wishlist_upd ], [ 'id' => $wishlist->id ], [ '%s' ], [ '%d' ] ) ) {
		wp_die( $answer );
	} else {
		wp_die( json_encode( [
			'status' => 'error',
			'answer' => __( 'DB Error', 'nickon-start' )
		] ) );
	}
}

function nickonstart_wishlist_get_product_id(): int {
	if ( ! isset( $_POST['nonce'] ) ) {
		echo json_encode( [ 'status' => 'error', 'answer' => __( 'Security error 9', 'nickon-start' ) ] );
		wp_die();
	}

	if ( ! wp_verify_nonce( $_POST['nonce'], 'nickonstart-nonce' ) ) {
		echo json_encode( [ 'status' => 'error', 'answer' => __( 'Security error 3', 'nickon-start' ) ] );
		wp_die();
	}

	if ( ! isset( $_POST['product_id'] ) ) {
		echo json_encode( [ 'status' => 'error', 'answer' => __( 'Product error 7', 'nickon-start' ) ] );
		wp_die();
	}

	$product_id = (int) $_POST['product_id'];
	$product    = wc_get_product( $product_id );
	if ( ! $product || ! $product->exists() || $product->get_status() != 'publish' ) {
		echo json_encode( [ 'status' => 'error', 'answer' => __( 'Product error 1', 'nickon-start' ) ] );
		wp_die();
	}

	return $product_id;
}

function nickonstart_update_wishlist( $product_id, &$wishlist ) {
	if ( false !== ( $key = array_search( $product_id, $wishlist ) ) ) {
		unset( $wishlist[ $key ] );
		$answer = json_encode( [
			'status' => 'success',
			'answer' => __( 'The product has been removed from wishlist', 'nickon-start' ),
			'wishlist' => array_values( $wishlist ),
		] );
	} else {
		if ( count( $wishlist ) >= WISHLIST_LIMIT ) {
			array_shift( $wishlist );
		}
		$wishlist[] = (string) $product_id;
		$answer     = json_encode( [
			'status' => 'success',
			'answer' => __( 'The product has been added to wishlist', 'nickon-start' ),
			'wishlist' => $wishlist,
		] );
	}

	return $answer;
}

function nickonstart_in_wishlist( $product_id ) {
	$wishlist = nickonstart_get_wishlist();

	return in_array( $product_id, $wishlist );
}


// ajax method
/*function nickonstart_get_wishlist() {
//	$wishlist = isset( $_COOKIE['wishlist'] ) ? $_COOKIE['wishlist'] : [];
	$wishlist = $_COOKIE['wishlist'] ?? [];
	if ( $wishlist ) {
		$wishlist = explode( ',', $wishlist );
	}

	return $wishlist;
}*/


// non-ajax method
function nickonstart_get_wishlist() {
//	$wishlist = isset( $_COOKIE['wishlist'] ) ? $_COOKIE['wishlist'] : [];
	$wishlist = $_COOKIE['wishlist'] ?? [];
	if ( $wishlist ) {
		$wishlist = json_decode( $wishlist );
	}

	return $wishlist;
}

function nickonstart_get_wishlist_db() {
	if ( ! is_user_logged_in() ) {
		return [];
	}

	global $wpdb;
	$user_id  = get_current_user_id();
	$wishlist = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM wp_wishlist WHERE user_id = %d", $user_id ) );

	if ( ! empty( $wishlist->products ) ) {
		return explode( ',', $wishlist->products );
	}

	return [];
}

function nickonstart_in_wishlist_db( $product_id ) {
	return in_array( $product_id, WISHLIST );
}


/*
 * Create DB table for wishlist
 * */
/*function nickonstart_wishlist_create_table() {
	global $wpdb;
	$wpdb->query( "CREATE TABLE IF NOT EXISTS `wp_wishlist` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `products` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci" );
}

nickonstart_wishlist_create_table();*/
