<?php

// Register and load the widget
function linkedin_load_widget() {
  register_widget( 'linkedin_widget' );
}

add_action( 'widgets_init', 'linkedin_load_widget' );

// Creating the widget
class linkedin_widget extends WP_Widget {

  function __construct() {
    parent::__construct(

      // Base ID of your widget
      'linkedin_widget',

      // Widget name will appear in UI
      __('Footer Linkedin Icon', 'linkedin_widget_domain'),

      // Widget description
      array( 'description' => __( 'A Linkedin icon in the footer.', 'linkedin_widget_domain' ), )
    );
  }


  // Creating widget front-end
  public function widget( $args, $instance ) {
    // before and after widget arguments are defined by themes
    echo $args['before_widget'];

    $link = $instance['link'];

    if ( isset( $instance[ 'link' ] ) ) {
      echo ( "<a href='" . $link . "' target='_blank' rel='bookmark' title='linkedin' class='icon fa-linkedin'><span class='label'>Linkedin</span></a>" );
    }

    echo $args['after_widget'];
  }


  // Widget Backend
  public function form( $instance ) {
    if ( isset( $instance[ 'link' ] ) ) {
      $link = $instance[ 'link' ];
    }
    else {
      $link = __( '', 'linkedin_widget_domain' );
    }
    // Widget admin form
    ?>
    <p>
      <label for="<?php echo $this->get_field_id( 'link' ); ?>"><?php _e( 'Link:' ); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id( 'link' ); ?>" name="<?php echo $this->get_field_name( 'link' ); ?>" type="text" value="<?php echo esc_attr( $link ); ?>" />
    </p>
    <?php
  }

  // Updating widget replacing old instances with new
  public function update( $new_instance, $old_instance ) {
    $instance = array();
    $instance['link'] = ( ! empty( $new_instance['link'] ) ) ? strip_tags( $new_instance['link'] ) : '';
    return $instance;
  }

} // Class linkedin_widget

?>
