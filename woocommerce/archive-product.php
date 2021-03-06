<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * @author  Tesseract
 * @package WooCommerce/Templates
 * @version 2.5.3
 */

// Exit if accessed directly
if ( ! defined('ABSPATH')) {
	exit;
}

$layout = get_theme_mod('tesseract_woocommerce_loop_layout');

get_header('shop');

	/**
	 * woocommerce_before_main_content hook
	 *
	 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
	 * @hooked woocommerce_breadcrumb - 20
	 */
	do_action('woocommerce_before_main_content');

	if (apply_filters('woocommerce_show_page_title', true)) { ?>
		<h1 class="page-title"><?php woocommerce_page_title(); ?></h1>
	<?php
	}

	do_action('woocommerce_archive_description');

	if (have_posts()) {

		/**
		 * woocommerce_before_shop_loop hook
		 *
		 * @hooked woocommerce_result_count - 20
		 * @hooked woocommerce_catalog_ordering - 30
		 */
		do_action('woocommerce_before_shop_loop');

		woocommerce_product_loop_start();

		woocommerce_product_subcategories();

		while (have_posts()) : the_post();

			wc_get_template_part('content', 'product');

		endwhile; // end of the loop.

		woocommerce_product_loop_end();

		/**
		 * woocommerce_after_shop_loop hook
		 *
		 * @hooked woocommerce_pagination - 10
		 */
		do_action('woocommerce_after_shop_loop');

	} elseif ( ! woocommerce_product_subcategories(array('before' => woocommerce_product_loop_start(false), 'after' => woocommerce_product_loop_end(false)))) {

		wc_get_template('loop/no-products-found.php');

	}

	/**
	 * woocommerce_after_main_content hook
	 *
	 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
	 */
	do_action('woocommerce_after_main_content');

	/**
	 * woocommerce_sidebar hook
	 *
	 * @hooked woocommerce_get_sidebar - 10
	 */
	if (($layout == 'sidebar-left') || ($layout == 'sidebar-right')) {
		do_action('woocommerce_sidebar');
	}

get_footer('shop');
