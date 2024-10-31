<?php
/*
Plugin Name: qTop
Plugin URI: http://konrad-haenel.de/en/downloads/qtop-wordpress-widget/
Description: Sidebar-widget displaying popular posts and pages based on the Popularity Contest plugin and supporting multiple languages with the qTranslate plugin. <em>***** !!! IMPORTANT: Requires a working installation of <a href="http://wordpress.org/extend/plugins/popularity-contest/" target="_blank">Crowd Favorite's "Popularity Contest"-plugin</a>. !!! *****</em>
Author: Konrad Haenel
Version: 0.1.2
Author URI: http://konrad-haenel.de/en

    This widget is released under the GNU General Public License (GPL)
    http://www.gnu.org/licenses/gpl.txt

    This is a WordPress plugin (http://wordpress.org) and widget
*/

/* Add our function to the widgets_init hook. */
add_action( 'widgets_init', 'qtop_load_widgets' );

/* Function that registers our widget. */
function qtop_load_widgets() {
	register_widget( 'qTopWidget' );
}

class qTopWidget extends WP_Widget {
	
	// CONSTRUCTOR
	function qTopWidget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'qtop', 'description' => 'Top-Pages qTranslated' );

		/* Widget control settings. */
		$control_ops = array( 'width' => "100%", 'id_base' => 'qtop-widget' );

		/* Create the widget. */
		$this->WP_Widget( 'qtop-widget', 'qTop', $widget_ops, $control_ops );
	}
	
	// WIDGET RENDERING
	function widget($args, $instance) {
		extract( $args );
		
		/* User-selected settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$maxentries = $instance['maxentries'];
		$wrapdiv = isset( $instance['wrapdiv'] ) ? $instance['wrapdiv'] : false;
		$displaymeta = isset( $instance['displaymeta'] ) ? $instance['displaymeta'] : false;
		$displayexcerpt = isset( $instance['displayexcerpt'] ) ? $instance['displayexcerpt'] : false;
		$hidepages = isset( $instance['hidepages'] ) ? $instance['hidepages'] : false;
		
		// convert $hidepages boolean to string
		$hidepagesString = ($hidepages)? 'yes' : 'no' ;
		
		// SAVE CURRENT POST
		global $post;
		$tmp_post = $post;

		
		// RENDER WIDGET BEGIN
		// this widget only works with ak popularity contest and qTranslate
		if (function_exists('akpc_get_popular_posts_array') && function_exists('_e')) { 
			// get array of popular posts and pages
			global $akpc;
			$popposts =  $akpc->get_popular_posts('popular', $maxentries, $hidepagesString, array('column' => 'total'));
		
			echo $before_widget;
			echo $before_title; _e($title); echo $after_title;
			if($wrapdiv){ ?><div><?php }; ?>
				 <ul>
				 <?php 
					if ($popposts) {
						foreach ($popposts as $ppost) { 
							$post = get_post($ppost->ID);
							setup_postdata($post);
							?>
							<li><a href="<?php the_permalink(); ?>"><span class="qtop_title"><?php the_title(); ?></span></a>
							<?php if ($displayexcerpt) { ?>
							<div class="qtop_excerpt"><a href="<?php the_permalink(); ?>"><?php if (function_exists('the_advanced_excerpt')){ the_advanced_excerpt();} else { the_excerpt(); }?></a></div>
							<?php } ?>
							<?php if ($displaymeta) { 
								$userinfo = get_userdata($post->post_author); ?>
							<div class="qtop_meta">by <?php the_author(); ?> | <?php _e(mysql2date('d.m.Y', $post->post_date)); ?></div>
							<?php } ?>
							</li>
						<?php
						} 
					}
					?>
				</ul>
			<?php if($wrapdiv){ ?></div><?php }; ?>
			<?php 
			echo $after_widget;
		}				
		// RENDER WIDGET END

		// RESTORE POST
		$post = $tmp_post;
	}

	// WIDGET CONTROL FORM
	function form($instance) {
		/* Set up some default widget settings. */
		$defaults = array( 'title' => 'TOP 5', 'maxentries' => '5', 'wrapdiv' => false, 'displaymeta' => false, 'displayexcerpt' => false);
		$instance = wp_parse_args( (array) $instance, $defaults ); 
		
		// RENDER WIDGET FORM BEGIN
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>"  class="widefat" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'maxentries' ); ?>">Max entries:</label>
			<input id="<?php echo $this->get_field_id( 'maxentries' ); ?>" name="<?php echo $this->get_field_name( 'maxentries' ); ?>" value="<?php echo $instance['maxentries']; ?>" size="3" maxlength="3" />
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php if ( $instance['hidepages'] ) { echo 'checked="checked"';}; ?> id="<?php echo $this->get_field_id( 'hidepages' ); ?>" name="<?php echo $this->get_field_name( 'hidepages' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'hidepages' ); ?>">Exclude pages?</label>
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php if ( $instance['wrapdiv'] ) { echo 'checked="checked"';}; ?> id="<?php echo $this->get_field_id( 'wrapdiv' ); ?>" name="<?php echo $this->get_field_name( 'wrapdiv' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'wrapdiv' ); ?>">Wrap DIV around list?</label>
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php if ( $instance['displayexcerpt'] ) { echo 'checked="checked"';}; ?> id="<?php echo $this->get_field_id( 'displayexcerpt' ); ?>" name="<?php echo $this->get_field_name( 'displayexcerpt' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'displayexcerpt' ); ?>">Display post excerpt?</label>
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php if ( $instance['displaymeta'] ) { echo 'checked="checked"';}; ?> id="<?php echo $this->get_field_id( 'displaymeta' ); ?>" name="<?php echo $this->get_field_name( 'displaymeta' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'displaymeta' ); ?>">Display post meta-info?</label>
		</p>
		<?php
		// RENDER WIDGET FORM END
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;

		/* Strip tags (if needed) and update the widget settings. */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['maxentries'] = $new_instance['maxentries'];
		$instance['wrapdiv'] = $new_instance['wrapdiv'];
		$instance['displaymeta'] = $new_instance['displaymeta'];
		$instance['displayexcerpt'] = $new_instance['displayexcerpt'];
		$instance['hidepages'] = $new_instance['hidepages'];

		return $instance;

	}
}
?>