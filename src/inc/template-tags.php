<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package aero
 */

if ( ! function_exists( 'aero_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function aero_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( 'Posted on %s', 'post date', 'aero' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'aero_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function aero_posted_by() {
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( 'by %s', 'post author', 'aero' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'aero_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function aero_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'aero' ) );
			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'aero' ) . '</span>', $categories_list ); // WPCS: XSS OK.
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'aero' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'aero' ) . '</span>', $tags_list ); // WPCS: XSS OK.
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'aero' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				)
			);
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'aero' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

if ( ! function_exists( 'aero_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function aero_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>

			<div class="post-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div><!-- .post-thumbnail -->

		<?php else : ?>

		<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
			<?php
			the_post_thumbnail( 'post-thumbnail', array(
				'alt' => the_title_attribute( array(
					'echo' => false,
				) ),
			) );
			?>
		</a>

		<?php
		endif; // End is_singular().
	}
endif;


if ( ! function_exists( 'aero_custom_logo' ) ) :
  /**
   * Displays a  custom logo.
   * Allowes adding custom class.
   */
  function aero_custom_logo( $linkClass = '') {
      $html          = '';

      $custom_logo_id = get_theme_mod( 'custom_logo' );

      // We have a logo. Logo is go.
      if ( $custom_logo_id ) {
        $custom_logo_attr = array(
          'class'    => 'custom-logo',
          'itemprop' => 'logo',
        );

        /*
         * If the logo alt attribute is empty, get the site title and explicitly
         * pass it to the attributes used by wp_get_attachment_image().
         */
        $image_alt = get_post_meta( $custom_logo_id, '_wp_attachment_image_alt', true );
        if ( empty( $image_alt ) ) {
          $custom_logo_attr['alt'] = get_bloginfo( 'name', 'display' );
        }

        /*
         * If the alt attribute is not empty, there's no need to explicitly pass
         * it because wp_get_attachment_image() already adds the alt attribute.
         */
        $html = sprintf(
          '<a href="%1$s" class="custom-logo-link %3$s" rel="home" itemprop="url">%2$s</a>',
          esc_url( home_url( '/' ) ),
          wp_get_attachment_image( $custom_logo_id, 'full', false, $custom_logo_attr ),
          " " . $linkClass
        );
      }

      return $html;
  }
endif;


if ( ! function_exists( 'aero_tagline' ) ) :
  /**
   * Displays site tagline.
   *
   */
  function aero_tagline( $class = '') {
      $html          = '';

      $tagline = get_bloginfo("description");

      if ( $tagline ) {
        $arr = explode(' ', $tagline);

        foreach ($arr as $key => $str) {
          $html = $html . '<span class = ' . $class . '--' . $key . '>' . $str . ' ' . '</span>';
        }
      }

      return $html;
  }
endif;


if ( ! function_exists( 'get_virtual_tour_preview' ) ) :
  /**
   * Displays site tagline.
   *
   */
  function get_virtual_tour_preview($post = null) {

      $post = get_post( $post );
      if ( ! $post ) {
          return '';
      }

      $html = get_the_post_thumbnail( $post->ID, 'medium');
      $meta = get_post_meta($post->ID)['virtual_tour_link'][0];

      if ($meta) {
        $html = sprintf(
          '<a href="%1$s" class="tours__item-img">%2$s</a>',
          $meta,
          $html
        );
      }

      $title = get_the_title();

      if ($title) {
        $title = sprintf(
          '<a href ="%1$s" class="tours__item-title">%2$s</a>',
          $meta,
          $title
        );
      }

      return
        '<div class="tours__preview">' .
          $html  .
        '</div>' .
        $title;
  }
endif;
