<?php
/***************************************************
INCLUDES
 ***************************************************/

require_once('taxonomy-filter-constants.php');

/**
 * Manage bulk columns
 *
 * @param $columns
 * @return array
 */
function taxonomy_filter_manage_bulk_columns($columns) {
    $new_columns = array();
    foreach ($columns as $key => $value) {
        $new_columns[$key] = $value;
        if ($key == 'title') {
            if (!TFP_ONLY_DEFAULT_CATEGORY_BULK_FILTER) {
                // Use all the taxonomy filters
                $options = get_option(TFP_PREFIX);
                $show_filter = true;

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
                            $new_columns[TFP_PREFIX . '_field_' . $taxonomy->slug] = 'Taxonomy ' . $taxonomy->slug . ' filter';
                        }
                    }
                }
            }
            else {
                // Use only taxonomy category filter
                $new_columns['taxonomy_filter_field_category'] = 'Taxonomy category filter';
            }
        }
    }
    return $new_columns;
}
add_filter('manage_posts_columns', 'taxonomy_filter_manage_bulk_columns', 10, 1);

/**
 * Manage bulk fields
 *
 * @param $column_name
 */
function taxonomy_filter_add_to_bulk_quick_edit_custom_box($column_name) {
    // Check if is a taxonomy filter column (now only for category taxonomy)
    if (strpos($column_name, 'taxonomy_filter_field_')  !== false) {
        // Get filter category slug
        $taxonomy_field = substr($column_name, 22);
        ?>
        <fieldset class="inline-edit-col-right" id="<?php echo TFP_PREFIX.'_fieldset_'.$taxonomy_field ?>">
            <div class="inline-edit-col">
                <div class="inline-edit-group">
                    <label>
                        <span class="title" id="<?php echo TFP_PREFIX.'_title_'.$taxonomy_field ?>"><?php _e('Filter by', TFP_PREFIX);?> "<?php echo $taxonomy_field ?>"</span>
                        <input type="text" id="<?php echo TFP_PREFIX.'_value_'.$taxonomy_field ?>" name="<?php echo TFP_PREFIX.'_value_'.$taxonomy_field ?>" value="" />
                    </label>
                </div>
            </div>
        </fieldset>

        <script type="text/javascript">
            jQuery(document).ready(function() {
                // Get categories bulk edit section container
                var current_categories = jQuery('.inline-edit-categories');

                // Search if categories container has current taxonomy filter category list
                var current_filter_ul_categories = current_categories.find('<?php echo ".".$taxonomy_field."-checklist" ?>');

                if (current_filter_ul_categories.length == 0) {
                    // Categories container not found, hide taxonomy filter fieldset
                    var current_filter_fieldset = jQuery('<?php echo "#".TFP_PREFIX."_fieldset_".$taxonomy_field ?>');
                    current_filter_fieldset.css('display', 'none');
                }
                else {
                    // Input value KeyUp event management
                    jQuery('<?php echo "#".TFP_PREFIX."_value_".$taxonomy_field ?>').keyup(function () {
                        // Read current taxonomy filter value
                        var filter_value = jQuery(this).val();
                        var filter_value_parent_row = jQuery(this).parents('tr.inline-edit-row.quick-edit-row.inline-editor').attr('id');
                        var filter_ul_class = '#' + filter_value_parent_row + '<?php echo " .".$taxonomy_field."-checklist" ?>';

                        jQuery(filter_ul_class).find("li").each(function () {
                            // Clean up all classes on KeyUp event
                            jQuery(this).removeClass("filter-exists");
                            jQuery(this).parent("ul.children").removeClass("filter-exists");
                        });

                        jQuery(filter_ul_class).find("input[type='checkbox']").each(function () {
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

                        jQuery(filter_ul_class).find("li:not(.filter-exists)").each(function () {
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
                }

                // Disable hide taxonomy filter bulk fields option
                jQuery('<?php echo "#".TFP_PREFIX."_field_".$taxonomy_field."-hide" ?>').parent("label").css("display", "none");
            });
        </script>
        <?php
    }
}
add_action('bulk_edit_custom_box', 'taxonomy_filter_add_to_bulk_quick_edit_custom_box', 10, 1);
add_action('quick_edit_custom_box', 'taxonomy_filter_add_to_bulk_quick_edit_custom_box', 10, 1);

/**
 * Add custom CSS to admin pages to hide bulk columns
 */
function taxonomy_filter_admin_hide_bulk_columns_css() {
    if (!TFP_ONLY_DEFAULT_CATEGORY_BULK_FILTER) {
        // Use all the taxonomy filters
        $options = get_option(TFP_PREFIX);
        $show_filter = true;

        if (count($options) > 0) {
            ?>
            <style type="text/css">
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
                            echo '.column-' . TFP_PREFIX . '_field_' . $taxonomy->slug . ' {display: none !important;} ';
                        }
                    }
                }
                ?>
            </style>
            <?php
        }
    }
    else {
        // Use only taxonomy category filter
        ?>
        <style type="text/css">
            .column-taxonomy_filter_field_category {display: none !important;}
        </style>
        <?php
    }
}
add_action('admin_head', 'taxonomy_filter_admin_hide_bulk_columns_css');
