<?php
/*
Plugin Name: Taxonomy filter
Description: Add an input fields to filter taxonomy values on admin post pages
Author: Andrea Landonio
Author URI: http://www.andrealandonio.it
Text Domain: taxonomy_filter
Domain Path: /languages/
Version: 1.1.1
License: GPL v3

Taxonomy filter
Copyright (C) 2013-2015, Andrea Landonio - landonio.andrea@gmail.com

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

// Security check
if (!defined('ABSPATH')) die('Accesso diretto al file non permesso');

// Path missing "__DIR__" constant on environment
if (!defined('__DIR__')) {
    define('__DIR__', dirname(__FILE__));
}

/***************************************************
INCLUDES
 ***************************************************/

require_once('taxonomy-filter-constants.php');
require_once('taxonomy-filter-settings.php');
require_once('taxonomy-filter-bulks.php');

/***************************************************
PLUGIN ACTIVATION
 ***************************************************/

/**
 * Register activation hook
 */
function taxonomy_filter_activation() {
    $options = taxonomy_filter_category_default_options();
    update_option(TFP_PREFIX, $options);
    add_option(TFP_PREFIX, $options);
}
register_activation_hook(__FILE__, 'taxonomy_filter_activation');

/**
 * Retrieve default category options
 *
 * @return stdClass
 */
function taxonomy_filter_category_default_options() {
    // Retrieve hierarchical taxonomies
    $args = array('hierarchical' => true);
    $taxonomies = get_taxonomies($args, 'objects');
    $options = new stdClass();

    // Loop taxonomies
    foreach ($taxonomies as $taxonomy) {
        // Set data (from current taxonomy object)
        $tax = $taxonomy->name;
        $replace = TFP_DEFAULT_REPLACE;
        $hide_blank = TFP_DEFAULT_HIDE_BLANK;
        $option =  new stdClass();

        // Save taxonomy slug
        $option->slug = $tax;
        // Save replace value (1 = replace, 0 = WordPress default)
        $option->replace = $replace;
        // Save hide blank value (1 = hide, 0 = show)
        $option->hide_blank = $hide_blank;

        // Add current taxonomy to options class
        $options->$tax = $option;
    }
    return $options;
}

/***************************************************
PLUGIN DEACTIVATION
 ***************************************************/

/**
 * Register deactivation hook
 */
function taxonomy_filter_deactivation() {
    delete_option(TFP_PREFIX);
}
register_deactivation_hook(__FILE__, 'taxonomy_filter_deactivation');

/***************************************************
PLUGIN ACTIONS
 ***************************************************/

/**
 * Add menu settings
 */
function taxonomy_filter_setting_menu() {
    // Register stylesheet
    wp_register_style('taxonomy_filter_style', plugins_url('taxonomy-filter/css/tfp.css'));
    wp_enqueue_style('taxonomy_filter_style' );

    // Add option page
    add_options_page('Taxonomy filter', 'Taxonomy filter', 'manage_options', TFP_PREFIX, 'taxonomy_filter_settings');
}
add_action('admin_menu', 'taxonomy_filter_setting_menu');

/**
 * Add taxonomy filter boxes to postbox
 */
function taxonomy_filter_add_boxes() {
    $options = get_option(TFP_PREFIX);
    $show_filter = true;
    ?>
    <script type="text/javascript">
        jQuery(document).ready(function() {
            <?php
            // Loop over taxonomy_filter option items
            foreach ($options as $taxonomy) {
                // If current taxonomy is enabled for replace add filter box
                if ($taxonomy->replace == 1) {
                    if ($taxonomy->hide_blank == 1) {
                        $terms = get_terms($taxonomy->slug);
                        $show_filter = !empty($terms);
                    }

                    // Show filter box
                    if ($show_filter) {
                        ?>
                        // Append filter input to taxonomy postbox
                        jQuery('<?php echo "#taxonomy-".$taxonomy->slug ?>').prepend('' +
                            '<label for="<?php echo TFP_PREFIX."_value_".$taxonomy->slug ?>"><?php _e('Filter', TFP_PREFIX);?>:</label>&nbsp;' +
                            '<input type="text" id="<?php echo TFP_PREFIX."_value_".$taxonomy->slug ?>" name="<?php echo TFP_PREFIX."_value_".$taxonomy->slug ?>" class="<?php echo TFP_PREFIX."_value" ?>" autocomplete="off"/>&nbsp;' +
                            '<input type="button" value="reset" id="<?php echo TFP_PREFIX."_reset_".$taxonomy->slug ?>" name="<?php echo TFP_PREFIX."_reset_".$taxonomy->slug ?>" class="bubble-float-left <?php echo TFP_PREFIX."_reset" ?>"/>' +
                            '<p class="tips"><i><?php _e('Use the above field to apply filter', TFP_PREFIX);?></i></p>'
                        );

                        // Input value KeyUp event management
                        jQuery('<?php echo "#".TFP_PREFIX."_value_".$taxonomy->slug ?>').keyup(function () {
                            // Read current taxonomy filter value
                            var filter_value = jQuery(this).val();
                            var filter_ul_id = '<?php echo "#".$taxonomy->slug."checklist" ?>';

                            jQuery(filter_ul_id).find("li").each(function () {
                                // Clean up all classes on KeyUp event
                                jQuery(this).removeClass("filter-exists");
                                jQuery(this).parent("ul.children").removeClass("filter-exists");
                            });

                            jQuery(filter_ul_id).find("input[type='checkbox']").each(function () {
                                // Loop over taxonomy checkboxes
                                var filter_item = jQuery(this).parent(); // checkbox label element
                                var filter_li = jQuery(this).parent().parent(); // checkbox li element

                                if (filter_item.text().toLowerCase().indexOf(filter_value.toLowerCase()) > -1) {
                                    // Show checkbox if text match with filter value
                                    filter_li.show();
                                    // Add "filter-exists" class to identify valid filtered items
                                    filter_li.addClass("filter-exists");
                                    // Add class to all parent UL if at least a valid filtered item exists
                                    filter_li.parents("ul.children").addClass("filter-exists");
                                }
                            });

                            jQuery(filter_ul_id).find("li:not(.filter-exists)").each(function () {
                                // Hide items without children or show previously hidden items (now valid)
                                if (jQuery(this).children("ul.children.filter-exists").length == 0) {
                                    // Hide items (without a child with class "filter-exists")
                                    jQuery(this).hide();
                                }
                                else {
                                    // Show items (with at least a child with class "filter-exists")
                                    jQuery(this).show();
                                }
                            });
                        });

                        // Input reset click event management
                        jQuery('<?php echo "#".TFP_PREFIX."_reset_".$taxonomy->slug ?>').click(function () {
                            // Loop over taxonomy checkboxes
                            jQuery('<?php echo "#".$taxonomy->slug."checklist" ?>').find("input[type='checkbox']").each(function () {
                                // Show all checkboxes
                                jQuery(this).parent().parent().show();
                            });

                            // Clean up value field
                            jQuery('<?php echo "#".TFP_PREFIX."_value_".$taxonomy->slug ?>').val('');
                        });
                        <?php
                    }
                }
            }
            ?>
        });
    </script>
    <?php
}
add_action('admin_head', 'taxonomy_filter_add_boxes');
