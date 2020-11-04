<?php
/*
Plugin Name:  Bellevue College Contact Widget
Plugin URI:   https://github.com/BellevueCollege/contact-widget
Description:  Department/Unit contact Widget.
Version:      1.1
Author:       Bellevue College DevCom
Author URI:   http://www.bellevuecollege.edu/
GitHub Plugin URI: bellevuecollege/netId-user-sync
*/

class Bc_Contact_Widget extends WP_Widget {
	
//	Construct Widget	//
function __construct() {
	parent::__construct(
		// Base ID of your widget
		'bc_contact_widget',

		// Widget name will appear in UI
		__( 'Office Contact', 'wp_widget_plugin' ),

		// Widget description
		array( 'description' => __( 'Show your Bellevue College contact information!', 'wp_widget_plugin' ), )
	);
}

// widget form creation
function form( $instance ) {

	// Check values
	if ( $instance ) {
		$contact_widget_title  = isset( $instance['contact_widget_title'] ) ? esc_attr( $instance['contact_widget_title'] ) : '';
		$contact_phone         = isset( $instance['contact_phone']) ? esc_attr( $instance['contact_phone'] ) : '';
		$contact_email         = isset( $instance['contact_email'] ) ? esc_attr( $instance['contact_email'] ): '';
		$website_manager_name  = isset( $instance['website_manager_name'] ) ? esc_attr( $instance['website_manager_name'] ) : '';
		$website_manager_email = isset( $instance['website_manager_email'] ) ? esc_attr( $instance['website_manager_email'] ) : '';

	} else {
		$contact_widget_title  = 'Contact Us';
		$contact_phone         = '';
		$contact_email         = '';
		$website_manager_name  = '';
		$website_manager_email = '';

	}
	?>

	<p>
		<label for="<?php echo $this->get_field_id('contact_widget_title'); ?>"><?php _e('Contact Widget Title:', 'wp_widget_plugin'); ?></label>
		<input id="<?php echo $this->get_field_id('contact_widget_title'); ?>" class="widefat" name="<?php echo $this->get_field_name('contact_widget_title'); ?>" type="text" value="<?php echo $contact_widget_title; ?>" />
	</p>


	<p>
		<label for="<?php echo $this->get_field_id('contact_phone'); ?>"><?php _e('Office Phone #: ', 'wp_widget_plugin'); ?></label>
		<input id="<?php echo $this->get_field_id('contact_phone'); ?>" class="widefat" name="<?php echo $this->get_field_name('contact_phone'); ?>" type="text" value="<?php echo $contact_phone; ?>" />
	</p>

	<p>
		<label for="<?php echo $this->get_field_id('contact_email'); ?>"><?php _e('Office Email: ', 'wp_widget_plugin'); ?></label>
		<input id="<?php echo $this->get_field_id('contact_email'); ?>" class="widefat" name="<?php echo $this->get_field_name('contact_email'); ?>" type="text" value="<?php echo $contact_email; ?>" />
	</p>

	<p>
		<label for="<?php echo $this->get_field_id('website_manager_name'); ?>"><?php _e('Website Manager Name:', 'wp_widget_plugin'); ?></label>
		<input id="<?php echo $this->get_field_id('website_manager_name'); ?>" class="widefat" name="<?php echo $this->get_field_name('website_manager_name'); ?>" type="text" value="<?php echo $website_manager_name; ?>" />
	</p>

	<p>
		<label for="<?php echo $this->get_field_id('website_manager_email'); ?>"><?php _e('Website Manager Email:', 'wp_widget_plugin'); ?></label>
		<input id="<?php echo $this->get_field_id('website_manager_email'); ?>" class="widefat" name="<?php echo $this->get_field_name('website_manager_email'); ?>" type="text" value="<?php echo $website_manager_email; ?>" />
	</p>



<?php
}

// update widget
function update( $new_instance, $old_instance ) {
	$instance = $old_instance;
	// Fields
	$instance['contact_widget_title']  = strip_tags( $new_instance['contact_widget_title'] );
	$instance['contact_phone']         = strip_tags( $new_instance['contact_phone'] );
	$instance['contact_email']         = strip_tags( $new_instance['contact_email'] );
	$instance['website_manager_name']  = strip_tags( $new_instance['website_manager_name'] );
	$instance['website_manager_email'] = strip_tags( $new_instance['website_manager_email'] );
	return $instance;
}

// display widget
function widget( $args, $instance ) {
	extract( $args );
	// these are the widget options
	$contact_widget_title  = apply_filters( 'widget_title', $instance['contact_widget_title'] );
	$contact_phone         = $instance['contact_phone'];
	$contact_email         = apply_filters( 'widget_title', $instance['contact_email'] );
	$website_manager_name  = $instance['website_manager_name'];
	$website_manager_email = $instance['website_manager_email'];
	echo $before_widget;
	// Display the widget

	// Check if contact title is set
	if ( $contact_widget_title ) {
		//echo  "<h3>".$contact_widget_title."</h3>" ;
		echo $before_title . $contact_widget_title . $after_title;
	} ?>
	<div style="margin: .5em 1em">
		<p>
			<?php
				// Check if contact text is set
				if ( $contact_phone ) {
					echo "Phone: $contact_phone<br />";
				}

				// Check if hours text is set
				if ( $contact_email ) {
					echo "Email: <a href='mailto:$contact_email'>$contact_email</a>";
				}
			?>
		</p>
		<?php
			// Check if hours text is set
			if ( $website_manager_name && $website_manager_email ) {
				echo "<p><small>Website Managed By: <a href='mailto:$website_manager_email'>$website_manager_name</a></small></p>";
			}
		?>

	</div>

	<?php
		echo $after_widget;
	}
} // bc_contact_widget Class

// register widget
add_action( 'widgets_init', function(){
	register_widget( 'bc_contact_widget' );
} );
