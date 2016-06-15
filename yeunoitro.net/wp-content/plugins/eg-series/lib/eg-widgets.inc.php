<?php
/*
Package Name: EG-Widgets
Plugin URI:
Description:  Abstract class to create and manage widget
Version: 2.1.1
Author: Emmanuel GEORJON
Author URI: http://www.emmanuelgeorjon.com/
*/

/*  Copyright 2009-2013  Emmanuel GEORJON  (email : blog@emmanuelgeorjon.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/


if (!class_exists('EG_Widget_211')) {

	class EG_Widget_211 extends WP_Widget {

		var $textdomain;
		var $fields;
		var $default_options;

		function display_comment($instance, $id, $form_field_id, $form_field_name) {
			return ( "\n".'<p><strong>'.esc_html__($this->fields[$id]['label'], $this->textdomain).'</strong></p>' );
		} // End of display_comment

		function display_separator($instance, $id, $form_field_id, $form_field_name) {
			return ( "\n".'<hr />' );
		} // End of display_separator

		function display_textarea($instance, $id, $form_field_id, $form_field_name) {
			$output .= "\n".'<p><label for="'.$form_field_name.'">'.esc_html__($this->fields[$id]['label'], $this->textdomain).': <br />'.
					 "\n".'<textarea cols="30" rows="3" id="'.$form_field_id.'" name="'.$form_field_name.'">'.format_to_edit($instance[$id]).'</textarea>'.
					 "\n".'</label></p>';
			return ($output);
		} // End of display_textarea

		function display_numeric($instance, $id, $form_field_id, $form_field_name) {
			$this->fields[$id]['type'] = 'text';
			return ($this->display_text($instance, $id, $form_field_id, $form_field_name));
		} // End of display_numeric

		function display_text($instance, $id, $form_field_id, $form_field_name) {
			$output = "\n".'<p>'.
					"\n".'<label for="'.$form_field_name.'">'.esc_html__($this->fields[$id]['label'], $this->textdomain).': </label><br />'.
					"\n".'<input type="'.$this->fields[$id]['type'].'" name="'.$form_field_name.'" value="'.$instance[$id].'"/>'.
					"\n".'</p>';
			return ($output);
		} // End of display_text

		function display_radio($instance, $id, $form_field_id, $form_field_name) {
			$output = "\n".'<p>'.
					"\n".esc_html__($this->fields[$id]['label'], $this->textdomain).':<br />';
			$num = 0;
			foreach ($this->fields[$id]['list'] as $value => $label) {
				$output .= "\n".'<input type="radio" name="'.$form_field_name.'" value="'.$value.'"'.($value==$instance[$id] ? ' checked' : '').'/> '.
							"\n".'<label for="'.$form_field_name.'">'.esc_html__($label, $this->textdomain).'</label>'.
							"\n".(++$num == sizeof($this->fields[$id]['list']) ? '' : '<br />');
			}
			$output .= '</p>';
			return ($output);
		} // End of display_radio

		function display_checkbox($instance, $id, $form_field_id, $form_field_name) {
			$output = "\n".'<p>'.
					"\n".esc_html__($this->fields[$id]['label'], $this->textdomain).':<br />';
// eg_plugin_error_log('Widget', 'Field: ', $this->fields[$id]);
			if (isset($this->fields[$id]['list'])) {
				if (1 == sizeof($this->fields[$id]['list']) ) {
					$output .= 	"\n".'<input type="hidden" name="'.$form_field_name.'" value="0" />'.
								"\n".'<input type="'.$this->fields[$id]['type'].'" name="'.$form_field_name.'" value="1"'.($instance[$id] ? ' checked' : '').' /> '.
								"\n".'<label for="'.$form_field_name.'">'.esc_html__(current($this->fields[$id]['list']), $this->textdomain).'</label>';
				}
				else {
					$num = 0;
					$output .= '<input type="hidden" value="0" name="'.$form_field_name.'" /> ';
					foreach ($this->fields[$id]['list'] as $value => $label) {
						// eg_plugin_error_log('EG-Widget', $value.' => '.$label);
						$output .= 	/*"\n".'<input type="hidden" name="'.$form_field_name.'[]" value="0" />'.*/
									"\n".'<input type="'.$this->fields[$id]['type'].'" name="'.$form_field_name.'[]" value="'.$value.'"'.(in_array($value, (array)$instance[$id]) ? ' checked' : '').'/> '.
									"\n".'<label for="'.$form_field_name.'[]">'.esc_html__($label, $this->textdomain).'</label>'.
									"\n".(++$num == sizeof($this->fields[$id]['list']) ? '' : '<br />');
					}
				}
			}
			$output .= '</p>';
			return ($output);
		} // End of display_checkbox

		function display_select($instance, $id, $form_field_id, $form_field_name) {
			$output = "\n".'<p>'.
					"\n".'<label for="'.$form_field_name.'">'.esc_html__($this->fields[$id]['label'], $this->textdomain).':</label><br />'.
					"\n".'<select name="'.$form_field_name.'">';

			foreach ($this->fields[$id]['list'] as $value => $label) {
				$output .= "\n".'<option value="'.$value.'" '.($value==$instance[$id] ? ' selected' : '').'>'.esc_html__($label, $this->textdomain).'</option>';
			}
			$output .= "\n".'</select>'.
						"\n".'</p>';
			return ($output);
		} // End of display_select

		public function form( $instance ) {

			$instance = wp_parse_args( (array) $instance, $this->default_options);
			$output = '';
			foreach ($this->fields as $id => $field) {
				$form_field_id   = $this->get_field_id($id);
				$form_field_name = $this->get_field_name($id);
				$output .= call_user_func(array(&$this, 'display_'.$field['type']), $instance, $id, $form_field_id, $form_field_name);
			} // End of foreach
			echo $output;
		} // End of form

		public function update( $new_instance, $old_instance ) {

			foreach ($new_instance as $key => $value) {
				if (isset($this->fields[$key])) {
					if ($this->fields[$key]['type'] == 'text') {
						$new_instance[$key] = strip_tags($new_instance[$key]);
					} // End of type text
				} // End of isset $key
			} // End of foreach
			return ($new_instance);
		} // End of update

	} // End of class

} // End of class_exists

?>