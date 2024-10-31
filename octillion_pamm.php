<?
/*
Plugin Name: Octillion Widget for BTC-E Pamm
Plugin URI: http://www.octillion.info/wp/
Description: Widget shows daily statistics of BTC-E Pamm account
Version: 1.0.0
Author: Octillion S.A.
Author URI: http://www.octillion.info/
*/

/**
 * octillion_pamm_widget Class description
 *
 * @category WPwidget
 * @package  Octillion
 * @author   Octillion S.A. <contact@octillion.info> 
 * @link     http://www.octillion.info/wp/
 */

// creating widget octillion_pamm_widget
class octillion_pamm_widget extends WP_Widget {

    function __construct() {
        parent::__construct(
            // ID for our widget
            'octillion_pamm_widget', 

            // The name of the widget
            __('BTC-E Pamm Widget', 'octillion_pamm_widget_domain'), 

            // Widget description
            array( 'description' => __( 
                'Widget shows daily statistics of BTC-E Pamm account', 
                'octillion_pamm_widget_domain' ), 
            ) 
        );
    }

    // Widget code begins - 
    // identification
    public function widget( $args, $instance ) {
        $title = apply_filters( 'widget_title', $instance['title'] );
        // before and after identification by title
        echo $args['before_widget'];
        if ( ! empty( $title ) )
        echo $args['before_title'] . $title . $args['after_title'];

        // THE MAIN CODE

        $octillion_pamm_agentlink = '?agent=8024065';
        if (isset( $instance['octillion_pamm_agent'] ) && $instance['octillion_pamm_agent']>0) {
            $octillion_pamm_agentlink = '?agent='.$instance['octillion_pamm_agent'];
        }

        $octillion_pamm_image = 'https://pamm.btc-e.com/Widget/GainWidget/';
        $octillion_pamm_image .= $instance[ 'octillion_pamm_account' ].'/';
        $octillion_pamm_image .= $instance[ 'octillion_pamm_size' ].'/'.$instance[ 'octillion_pamm_color' ];
        $octillion_pamm_image .= '/'.$instance[ 'octillion_pamm_language' ].'/widget.png';

        if(@is_array(getimagesize($octillion_pamm_image))) {
            echo '<div><center><a href="https://pamm.btc-e.com/Pamm/';
            echo $instance[ 'octillion_pamm_account' ].$octillion_pamm_agentlink;
            echo '" title="" target="_blank"> <img src="'.$octillion_pamm_image;
            echo '" border="0" title="PAMM: '.$instance[ 'octillion_pamm_account' ];
            echo '" alt="PAMM: '.$instance[ 'octillion_pamm_account' ];
            echo '" /> </a></center></div>';
        }
        else {
          echo '<div><center><b>Pamm account<br /><i>"'.$instance['octillion_pamm_account'].'"</i>
          <br />does not exist!</b></div>';
        }

        echo $args['after_widget'];
        } // closing code of the widget

    public function form($instance) {

        if ( isset( $instance[ 'octillion_pamm_agent' ] ) && $instance['octillion_pamm_agent']>0 ) {
            $octillion_pamm_agent = $instance[ 'octillion_pamm_agent' ]; 
        } else { 
            $octillion_pamm_agent = '';
        }
        if ( 
            isset($instance['octillion_pamm_account'] ) && 
            trim($instance['octillion_pamm_account']) != '' 
            ) {
            $octillion_pamm_account = $instance[ 'octillion_pamm_account' ]; 
        } else { 
            $octillion_pamm_account = 'RobinHood';
        }
        if ( 
            isset($instance['octillion_pamm_language'] ) && 
            in_array($instance['octillion_pamm_language'], array('en', 'ru', 'zh'))
            ) {
            $octillion_pamm_language = $instance['octillion_pamm_language']; 
        } else { 
            $octillion_pamm_language = 'en';
        }
        if ( 
            isset($instance['octillion_pamm_color'] ) && 
            in_array($instance['octillion_pamm_color'], array("1", "2", "0"))
            ) {
            $octillion_pamm_color = $instance['octillion_pamm_color']; 
        } else { 
            $octillion_pamm_color = "1";
        }
        if ( 
            isset($instance['octillion_pamm_size']) && 
            in_array($instance['octillion_pamm_size'], array("1", "2", "0", "3"))
            ) {
            $octillion_pamm_size = $instance[ 'octillion_pamm_size' ];
        } else {
            $octillion_pamm_size = "2";
        }

        if (isset($instance['title'])) {
            $title = $instance['title'];
        }
        else {
            $title = __( $octillion_pamm_account, 'octillion_pamm_widget_domain' );
        } ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>">
                <?php _e('Title:'); ?>
            </label> 
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
            <br />
            <label for="<?php echo $this->get_field_id('octillion_pamm_account'); ?>"><?php _e('Pamm account name:'); ?></label>			
            <input class="widefat" id="<?php echo $this->get_field_id('octillion_pamm_account'); ?>" name="<?php echo $this->get_field_name('octillion_pamm_account'); ?>" type="text" value="<?php echo esc_attr($octillion_pamm_account); ?>" />
            <br />
            <label for="<?php echo $this->get_field_id('octillion_pamm_language'); ?>"><?php _e('Widget Language:'); ?></label>         
            <select class="widefat" id="<?php echo $this->get_field_id('octillion_pamm_language'); ?>" name="<?php echo $this->get_field_name('octillion_pamm_language'); ?>" type="text">
                <option value='en' <?php echo ($octillion_pamm_language == 'en')?'selected="selected"':''; ?>>English</option>
                <option value='ru' <?php echo ($octillion_pamm_language == 'ru')?'selected="selected"':''; ?>>Russian</option> 
                <option value='zh' <?php echo ($octillion_pamm_language == 'zh')?'selected="selected"':''; ?>>Chinese</option>
            </select>
            <br />
            <label for="<?php echo $this->get_field_id('octillion_pamm_color'); ?>"><?php _e('Select widget color:'); ?></label>          
            <select class="widefat" id="<?php echo $this->get_field_id('octillion_pamm_color'); ?>" name="<?php echo $this->get_field_name('octillion_pamm_color'); ?>" type="text">
                <option value='1' <?php echo ($octillion_pamm_color == "1")?'selected="selected"':''; ?>>dark</option>
                <option value='2' <?php echo ($octillion_pamm_color == "2")?'selected="selected"':''; ?>>grey</option> 
                <option value='0' <?php echo ($octillion_pamm_color == "0")?'selected="selected"':''; ?>>white</option> 
            </select>
            <br />
            <label for="<?php echo $this->get_field_id('octillion_pamm_size'); ?>"><?php _e('Select widget size:'); ?></label>          
            <select class="widefat" id="<?php echo $this->get_field_id('octillion_pamm_size'); ?>" name="<?php echo $this->get_field_name('octillion_pamm_size'); ?>" type="text">
                <option value='1' <?php echo ($octillion_pamm_size == "1")?'selected="selected"':''; ?>>small 138x162 px</option>
                <option value='2' <?php echo ($octillion_pamm_size == "2")?'selected="selected"':''; ?>>medium 179x243 px</option>
                <option value='0' <?php echo ($octillion_pamm_size == "0")?'selected="selected"':''; ?>>long 553x48 px</option>
                <option value='3' <?php echo ($octillion_pamm_size == "3")?'selected="selected"':''; ?>>large 431x216 px</option>
            </select>
            <br />
            <label for="<?php echo $this->get_field_id('octillion_pamm_agent'); ?>"><?php _e('Agent account number:'); ?></label>            
            <input class="widefat" id="<?php echo $this->get_field_id('octillion_pamm_agent'); ?>" name="<?php echo $this->get_field_name('octillion_pamm_agent'); ?>" type="text" value="<?php echo esc_attr($octillion_pamm_agent); ?>" />
            <br />
        </p>
    <?php }

    // Widget Update
    public function update($new_instance, $old_instance) 
    {
        $instance = $old_instance;
        $instance['title'] = (! empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        $instance['octillion_pamm_account'] = (trim($new_instance['octillion_pamm_account']) != '') ? strip_tags($new_instance['octillion_pamm_account']) : 'RobinHood';
        $instance['octillion_pamm_agent'] = ($new_instance['octillion_pamm_agent']>0) ? strip_tags($new_instance['octillion_pamm_agent']) : '';
        $instance['octillion_pamm_language'] = (in_array($new_instance['octillion_pamm_language'], array('en', 'ru', 'zh'))) ? $new_instance['octillion_pamm_language'] : 'en';
        $instance['octillion_pamm_color'] = (in_array($new_instance['octillion_pamm_color'], array("1", "2", "0"), true)) ? $new_instance['octillion_pamm_color'] : "1";
        $instance['octillion_pamm_size'] = (in_array($new_instance['octillion_pamm_size'], array("1", "2", "0", "3"))) ? $new_instance['octillion_pamm_size'] : "2";
        return $instance;
    }

} // closing class octillion_pamm_widget

// register and start our widget
function btru_load_widget() {
    register_widget('octillion_pamm_widget');
}
add_action('widgets_init', 'btru_load_widget');

function btcepamm_shortcode($atts) 
{
    extract(shortcode_atts(array('acc' => 'RobinHood','agent' => '8024065','lang' => 'en','size' => 'long','color' => 'dark',), $atts));
    if ($size=="long") {
        $size="0";
    } elseif ($size=="small") {
        $size="1";
    } elseif ($size=="medium") {
        $size="2";
    } elseif ($size=="large") {
        $size="3";
    }
    if ($color=="dark") {
        $color="1";
    } elseif ($color=="grey") {
        $color="2";
    } elseif ($color=="white") {
        $color="0";
    } 

    $shortcode_img = 'https://pamm.btc-e.com/Widget/GainWidget/'.$acc.'/'.$size.'/'.$color.'/'.$lang.'/widget.png';

    if (@is_array(getimagesize($shortcode_img))) {
        return '<a href="https://pamm.btc-e.com/Pamm/'.$acc.'?agent='.$agent.'" title="" target="_blank"><img src="'.$shortcode_img.'" border="0" title="PAMM: '.$acc.'" alt="PAMM: '.$acc.'" /></a>';
    } else {
        return '<b>Couldn\'t find PAMM account <i>"'.$acc.'"</i> at BTC-E!</b>';
    }
}

add_shortcode("btcepamm", "btcepamm_shortcode");

?>