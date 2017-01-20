<?php
/*
Plugin Name: New Google Plus Badge
Plugin URI:  http://awplife.com/
Description: Google+ Badge & Profile Widget For Wordpress
Version:     0.1.6
Author:      A WP Life
Author URI:  http://awplife.com/
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Domain Path: /languages
Text Domain: NGPB

My Plugin is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.
 
My Plugin is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
 
You should have received a copy of the GNU General Public License
along with My Plugin. I
*/

class Google_Plus_Badge extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		define("NGPB", "new-google-plus-badge");
		parent::__construct(
			'Google_Plus_Badge', // Base ID
			__( 'Google+ Badge', NGPB ), // Name
			array( 'description' => __( 'A Google+ Badge Widget', NGPB ), ) // Args
		);
	}

	// Front-end display of widget
	public function widget( $args, $instance ) {
		$name = ! empty( $instance['name'] ) ? $instance['name'] : __( 'Follow Us On Google+', NGPB );
		$url = ! empty( $instance['url'] ) ? $instance['url'] : __( 'https://plus.google.com/u/0/104649297856397988957', NGPB );
		$layout = ! empty( $instance['layout'] ) ? $instance['layout'] : __( 'portrait', NGPB );
		$width = ! empty( $instance['width'] ) ? $instance['width'] : __( 250, NGPB );
		$theme = ! empty( $instance['theme'] ) ? $instance['theme'] : __( 'light', NGPB );
		$cover = ! empty( $instance['cover'] ) ? $instance['cover'] : __( 'true', NGPB );
		$tagline = ! empty( $instance['tagline'] ) ? $instance['tagline'] : __( 'true', NGPB );
		$language = ! empty( $instance['language'] ) ? $instance['language'] : __( 'en_US', NGPB );
		
		echo $args['before_widget'];
		if ( ! empty( $instance['name'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['name'] ) . $args['after_title'];
		}
		?>
		<script type="text/javascript">
		window.___gcfg = {lang: '<?php echo $language;?>'};
		(function() {
			var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
			po.src = 'https://apis.google.com/js/platform.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
		})();
		</script>
		<div class="g-person" 
			data-width="<?php echo $width;?>" 
			data-href="<?php echo $url;?>" 
			data-theme="<?php echo $theme;?>" 
			data-layout="<?php echo $layout;?>" 
			data-showtagline="<?php echo $tagline;?>" 
			data-showcoverphoto="<?php echo $cover;?>" 
			data-rel="author">
		</div>
		<?php
		echo $args['after_widget'];
	}
	
	// Backend widget form.
	public function form( $instance ) {
		$name = ! empty( $instance['name'] ) ? $instance['name'] : __( 'Follow Us On Google+', NGPB );
		$url = ! empty( $instance['url'] ) ? $instance['url'] : __( 'https://plus.google.com/u/0/104649297856397988957', NGPB );
		$layout = ! empty( $instance['layout'] ) ? $instance['layout'] : __( 'portrait', NGPB );
		$width = ! empty( $instance['width'] ) ? $instance['width'] : __( 250, NGPB );
		$theme = ! empty( $instance['theme'] ) ? $instance['theme'] : __( 'light', NGPB );
		$cover = ! empty( $instance['cover'] ) ? $instance['cover'] : __( 'true', NGPB );
		$tagline = ! empty( $instance['tagline'] ) ? $instance['tagline'] : __( 'true', NGPB );
		$language = ! empty( $instance['language'] ) ? $instance['language'] : __( 'en_US', NGPB );	
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'name' ) ); ?>"><?php _e( esc_attr( 'Title' ) ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'name' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'name' ) ); ?>" type="text" value="<?php echo esc_attr( $name ); ?>">
		</p>
		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'url' ) ); ?>"><?php _e( esc_attr( 'Google+ Profile Url' ) ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'url' ) ); ?>" type="text" value="<?php echo esc_attr( $url ); ?>">
		</p>
		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'layout' ) ); ?>"><?php _e( esc_attr( 'Badge Layout' ) ); ?></label><br> 
			<input class="widefat layP" id="<?php echo $this->get_field_id( 'layout' ); ?>" name="<?php echo $this->get_field_name( 'layout' ); ?>" <?php if($layout == 'portrait') echo "checked=checked" ?> type="radio" value="portrait" onclick="return CheckLayout(this.value);"> Portrait  &nbsp;&nbsp;
			<input class="widefat layL" id="<?php echo $this->get_field_id( 'layout' ); ?>" name="<?php echo $this->get_field_name( 'layout' ); ?>" <?php if($layout == 'landscape') echo "checked=checked" ?> type="radio" value="landscape" onclick="return CheckLayout();"> Landscape
		</p>
		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'width' ) ); ?>"><?php _e( esc_attr( 'Badge Width' ) ); ?></label> 
			<input class="widefat" id="width_range" name="width_range" type="range" min="180" max="450" value="<?php echo esc_attr( $width ); ?>" onchange="updateRange(this.value);">
			<input class="widefat" id="<?php echo $this->get_field_id( 'width' ); ?>" name="<?php echo $this->get_field_name( 'width' ); ?>" type="text" value="<?php echo esc_attr( $width ); ?>" readonly>
		</p>		
		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'theme' ) ); ?>"><?php _e( esc_attr( 'Badge Theme' ) ); ?></label><br> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'theme' ); ?>" name="<?php echo $this->get_field_name( 'theme' ); ?>" <?php if($theme == 'light') echo "checked=checked" ?> type="radio" value="light"> Light  &nbsp;&nbsp;
			<input class="widefat" id="<?php echo $this->get_field_id( 'theme' ); ?>" name="<?php echo $this->get_field_name( 'theme' ); ?>" <?php if($theme == 'dark') echo "checked=checked" ?> type="radio" value="dark"> Dark
		</p>
		
		<div class="remove" <?php if($layout == "landscape") echo 'style="display:none;"'; ?>>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'cover' ) ); ?>"><?php _e( esc_attr( 'Show Profile Cover' ) ); ?></label><br> 
				<input class="widefat" id="<?php echo $this->get_field_id( 'cover' ); ?>" name="<?php echo $this->get_field_name( 'cover' ); ?>" <?php if($cover == 'true') echo "checked=checked" ?> type="radio" value="true"> Enable  &nbsp;&nbsp;
				<input class="widefat" id="<?php echo $this->get_field_id( 'cover' ); ?>" name="<?php echo $this->get_field_name( 'cover' ); ?>" <?php if($cover == 'false') echo "checked=checked" ?> type="radio" value="false"> Disable
			</p>
			
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'tagline' ) ); ?>"><?php _e( esc_attr( 'Show Tagline' ) ); ?></label><br> 
				<input class="widefat" id="<?php echo $this->get_field_id( 'tagline' ); ?>" name="<?php echo $this->get_field_name( 'tagline' ); ?>" <?php if($tagline == 'true') echo "checked=checked" ?> type="radio" value="true"> Enable  &nbsp;&nbsp;
				<input class="widefat" id="<?php echo $this->get_field_id( 'tagline' ); ?>" name="<?php echo $this->get_field_name( 'tagline' ); ?>" <?php if($tagline == 'false') echo "checked=checked" ?> type="radio" value="false"> Disable
			</p>
		</div>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'language' ); ?>"><?php _e( 'Language' ); ?></label><br>
			<select id="<?php echo $this->get_field_id( 'language' ); ?>" name="<?php echo $this->get_field_name( 'language' ); ?>">
				<option value="en_US" <?php if ($language == 'en_US') echo ' selected="selected"'; ?>>English (US)</option>
				<option value="en_GB" <?php if ($language == 'en_GB') echo ' selected="selected"'; ?>>English (UK)</option>
				<option value="af_ZA" <?php if ($language == 'af_ZA') echo ' selected="selected"'; ?>>Afrikaans</option>
				<option value="ar_AR" <?php if ($language == 'ar_AR') echo ' selected="selected"'; ?>>Arabic</option>
				<option value="hy_AM" <?php if ($language == 'hy_AM') echo ' selected="selected"'; ?>>Armenian</option>
				<option value="bg_BG" <?php if ($language == 'bg_BG') echo ' selected="selected"'; ?>>Bulgarian</option>
				<option value="br_FR" <?php if ($language == 'br_FR') echo ' selected="selected"'; ?>>Breton</option>
				<option value="cs_CZ" <?php if ($language == 'cs_CZ') echo ' selected="selected"'; ?>>Czech</option>
				<option value="zh_CN" <?php if ($language == 'zh_CN') echo ' selected="selected"'; ?>>Chinese (Simplified China)</option>
				<option value="zh_HK" <?php if ($language == 'zh_HK') echo ' selected="selected"'; ?>>Chinese (Traditional Hong Kong)</option>
				<option value="zh_TW" <?php if ($language == 'zh_TW') echo ' selected="selected"'; ?>>Chinese (Traditional Taiwan)</option>
				<option value="da_DK" <?php if ($language == 'da_DK') echo ' selected="selected"'; ?>>Danish</option>
				<option value="nl_NL" <?php if ($language == 'nl_NL') echo ' selected="selected"'; ?>>Dutch</option>
				<option value="fr_FR" <?php if ($language == 'fr_FR') echo ' selected="selected"'; ?>>French (France)</option>
				<option value="fr_CA" <?php if ($language == 'fr_CA') echo ' selected="selected"'; ?>>French (Canada)</option>
				<option value="de_DE" <?php if ($language == 'de_DE') echo ' selected="selected"'; ?>>German</option>
				<option value="he_IL" <?php if ($language == 'he_IL') echo ' selected="selected"'; ?>>Hebrew</option>
				<option value="hi_IN" <?php if ($language == 'hi_IN') echo ' selected="selected"'; ?>>Hindi</option>
				<option value="hu_HU" <?php if ($language == 'hu_HU') echo ' selected="selected"'; ?>>Hungarian</option>
				<option value="ga_IE" <?php if ($language == 'ga_IE') echo ' selected="selected"'; ?>>Irish</option>
				<option value="id_ID" <?php if ($language == 'id_ID') echo ' selected="selected"'; ?>>Indonesian</option>
				<option value="it_IT" <?php if ($language == 'it_IT') echo ' selected="selected"'; ?>>Italian</option>
				<option value="ja_JP" <?php if ($language == 'ja_JP') echo ' selected="selected"'; ?>>Japanese</option>
				<option value="kk_KZ" <?php if ($language == 'kk_KZ') echo ' selected="selected"'; ?>>Kazakh</option>
				<option value="ko_KR" <?php if ($language == 'ko_KR') echo ' selected="selected"'; ?>>Korean</option>
				<option value="la_VA" <?php if ($language == 'la_VA') echo ' selected="selected"'; ?>>Latin</option>
				<option value="ne_NP" <?php if ($language == 'ne_NP') echo ' selected="selected"'; ?>>Nepali</option>
				<option value="fa_IR" <?php if ($language == 'fa_IR') echo ' selected="selected"'; ?>>Persian</option>			
				<option value="pl_PL" <?php if ($language == 'pl_PL') echo ' selected="selected"'; ?>>Polish</option>
				<option value="pt_PT" <?php if ($language == 'pt_PT') echo ' selected="selected"'; ?>>Portuguese </option>
				<option value="ro_RO" <?php if ($language == 'ro_RO') echo ' selected="selected"'; ?>>Romanian</option>
				<option value="ru_RU" <?php if ($language == 'ru_RU') echo ' selected="selected"'; ?>>Russian</option>
				<option value="es_LA" <?php if ($language == 'es_LA') echo ' selected="selected"'; ?>>Spanish</option>
				<option value="es_CL" <?php if ($language == 'es_CL') echo ' selected="selected"'; ?>>Spanish (Chile)</option>
				<option value="es_CO" <?php if ($language == 'es_CO') echo ' selected="selected"'; ?>>Spanish (Colombia)</option>
				<option value="es_ES" <?php if ($language == 'es_ES') echo ' selected="selected"'; ?>>Spanish (Spain)</option>
				<option value="es_MX" <?php if ($language == 'es_MX') echo ' selected="selected"'; ?>>Spanish (Mexico)</option>
				<option value="es_VE" <?php if ($language == 'es_VE') echo ' selected="selected"'; ?>>Spanish (Venezuela)</option>
				<option value="sr_RS" <?php if ($language == 'sr_RS') echo ' selected="selected"'; ?>>Serbian</option>
				<option value="sv_SE" <?php if ($language == 'sv_SE') echo ' selected="selected"'; ?>>Swedish</option>
				<option value="th_TH" <?php if ($language == 'th_TH') echo ' selected="selected"'; ?>>Thai</option>
				<option value="tr_TR" <?php if ($language == 'tr_TR') echo ' selected="selected"'; ?>>Turkish</option>
				<option value="ur_PK" <?php if ($language == 'ur_PK') echo ' selected="selected"'; ?>>Urdu</option>
			</select>
		</p>
		
		<script>
		// on change range value
		function updateRange(val) {
		  jQuery("#width_range").val(val);
		  jQuery("#<?php echo $this->get_field_id( 'width' ); ?>").val(val);		  
        }
		
		// on click layout
		jQuery(".layP").click(function(){
			jQuery(".remove").show();
		});
		jQuery(".layL").click(function(){
			jQuery(".remove").hide();
		});
		</script>
		<?php 
	}

	// Sanitize widget form values as they are saved
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['name'] = ( ! empty( $new_instance['name'] ) ) ? strip_tags( $new_instance['name'] ) : 'Follow Us On Google+';
		$instance['url'] = ( ! empty( $new_instance['url'] ) ) ? strip_tags( $new_instance['url'] ) : 'https://plus.google.com/u/0/104649297856397988957';
		$instance['layout'] = ( ! empty( $new_instance['layout'] ) ) ? strip_tags( $new_instance['layout'] ) : 'portrait';
		$instance['width'] = ( ! empty( $new_instance['width'] ) ) ? strip_tags( $new_instance['width'] ) : 250;
		$instance['theme'] = ( ! empty( $new_instance['theme'] ) ) ? strip_tags( $new_instance['theme'] ) : 'light';
		$instance['cover'] = ( ! empty( $new_instance['cover'] ) ) ? strip_tags( $new_instance['cover'] ) : 'true';
		$instance['tagline'] = ( ! empty( $new_instance['tagline'] ) ) ? strip_tags( $new_instance['tagline'] ) : 'true';
		$instance['language'] = ( ! empty( $new_instance['language'] ) ) ? strip_tags( $new_instance['language'] ) : 'en_US';
		return $instance;
	}
} // end of class function

// Register Google_Plus_Badge Widget
add_action( 'widgets_init', 'register_Google_Plus_Badge_Widget' );
function register_Google_Plus_Badge_Widget() {
    register_widget( 'Google_Plus_Badge' );
}
?>