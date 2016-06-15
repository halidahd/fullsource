<?php
/***************************************************
INCLUDES
 ***************************************************/

require_once('taxonomy-filter-constants.php');

/***************************************************
PLUGIN SETTINGS
 ***************************************************/

// Check request data before save settings
if ((isset($_GET['page']) && $_GET['page'] == TFP_PREFIX) && isset($_POST['taxonomy_filter_action'])) {
    taxonomy_filter_save_settings();
}
/**
 * Add taxonomy filter settings before the admin page is rendered
 */
function taxonomy_filter_admin_init() {
	register_setting('taxonomy_filter_options', TFP_PREFIX);
	add_settings_section('taxonomy_filter_main', '', 'taxonomy_filter_option_main_show', 'taxonomy_filter_plugin');
}
add_action('admin_init', 'taxonomy_filter_admin_init');

/**
 * Load internalization supports
 */
function taxonomy_filter_load_textdomain() {
    load_plugin_textdomain(TFP_PREFIX, false, dirname(plugin_basename( __FILE__ )) . '/languages/');
}
add_action( 'plugins_loaded', 'taxonomy_filter_load_textdomain');

/**
 * Render admin settings page
 */
function taxonomy_filter_settings() {
	settings_fields('taxonomy_filter_options');
	?>
	<div class="wrap">
        <div class="icon32"><img src="<?php echo plugins_url('taxonomy-filter/images/icon32.png');?>" /></div>
        <h2><?php _e('Taxonomy filter settings', TFP_PREFIX);?></h2>

        <script type="text/javascript">
        jQuery(document).ready(function($) {
            jQuery('body').on('click', '.button-primary.reset:not(.confirm, .disabled)', function(e) {
                e.preventDefault();
                $this = jQuery(this);
                $this.addClass('confirm');
                var resetLabel = $this.val();
                var confirmLabel = '<?php _e('Confirm reset', TFP_PREFIX);?>';
                var timer = 5;
                $this.val(confirmLabel + ' (' + timer + ')');
                t = setInterval(
                    function(){
                        timer -= 1;
                        $this.val(confirmLabel + ' (' + timer + ')');
                        if (timer == 0) {
                            clearInterval(t);
                            $this.removeClass('confirm').val(resetLabel);
                        }
                    }, 1000
                );
            });

            jQuery('body').on('click', '.button-primary.reset.confirm:not(.disabled)', function() {
                clearInterval(t);
                jQuery('#formaction').val('taxonomy_filter_reset');
                jQuery(this).val('<?php _e('Resetting..', TFP_PREFIX);?>').addClass('disabled');
            });

            <?php if (isset($_GET['updated'])) { ?>
            jQuery('#setting-error-settings_updated').delay(3000).slideUp(400);
            <?php }	?>
        });
        </script>

        <div id="poststuff">
            <div id="post-body" class="metabox-holder">
                <div id="post-body-content">
                    <p>
                        <?php _e('Choose in which taxonomy admin page box show filter field. Change "hide filter" checkbox if you want to hide filter field if taxonomy has no values. You can enable a taxonomy filter by checking his checkbox input beside taxonomy names.<br /><span class="description">Note: The plugin does not support non-hierarchical tags.</span>', TFP_PREFIX);?>
                    </p>
                    <form method="post" action="">
                        <?php
                        // Prints out all settings of taxonomy filter settings page
                        do_settings_sections('taxonomy_filter_plugin');
                        ?>
                        <input id="formaction" name="taxonomy_filter_action" type="hidden" value="taxonomy_filter_update" /><br />
                        <p>
                            <input name="submit" type="submit" class="button-primary" value="<?php _e('Save', TFP_PREFIX);?>" />
                            <input name="reset" type="submit" class="button-primary reset" value="<?php _e('Reset', TFP_PREFIX);?>" />
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php
}

/**
 * Render admin settings page options and fields
 */
function taxonomy_filter_fields() {
	?>
	<table class="wp-list-table widefat fixed posts taxonomy-filter-table" cellspacing="0">
		<thead>
			<tr>
                <th scope="col" id="cb" class="manage-column column-cb check-column"></th>
                <th scope="col" id="name" class="manage-column label-column"><?php _e('Name', TFP_PREFIX);?></th>
                <th scope="col" id="slug" class="manage-column slug-column"><?php _e('Slug', TFP_PREFIX);?></th>
                <th scope="col" id="rewrite" class="manage-column slug-column"><?php _e('Rewrite slug', TFP_PREFIX);?></th>
                <th scope="col" id="options" class="manage-column options-column"><?php _e('Options', TFP_PREFIX);?></th>
			</tr>
		</thead>
		<tfoot>
			<tr>
                <th scope="col" id="cb" class="manage-column column-cb check-column"></th>
                <th scope="col" id="name" class="manage-column label-column"><?php _e('Name', TFP_PREFIX);?></th>
                <th scope="col" id="slug" class="manage-column slug-column"><?php _e('Slug', TFP_PREFIX);?></th>
                <th scope="col" id="rewrite" class="manage-column slug-column"><?php _e('Rewrite slug', TFP_PREFIX);?></th>
                <th scope="col" id="options" class="manage-column options-column"><?php _e('Options', TFP_PREFIX);?></th>
			</tr>
		</tfoot>
		<tbody id="the-list">
            <?php
            $options = get_option(TFP_PREFIX);
            $tax_list = "";
            $i = 1;

            // Retrieve hierarchical taxonomies
            $args = array('hierarchical' => true);
            $taxonomies = get_taxonomies($args, 'objects');

            if ($taxonomies) {
                // Loop taxonomies
                foreach ($taxonomies as $taxonomy) {
                    // Retrieve current taxonomy data
                    $slug = $taxonomy->rewrite['slug'];
                    $name = $taxonomy->name;

                    // Append taxonomy name to a variable containing taxonomy list
                    $tax_list .= $name.',';

                    // Check if current taxonomy is checked
                    $checked = "";
                    if ($options->$name->replace == 1) $checked = 'checked="checked"';
                    ?>
                    <tr id="post-<?php echo $i ?>" <?php echo ($i % 2 == 0)?'class="alternate"':'' ?> valign="top">
                        <th scope="row" class="check-column">
                            <?php echo '<input type="checkbox" id="'.$name.'" name="taxonomies['.$name.']" value="1" '.$checked.'>';?>
                        </th>
                        <td class="label-column">
                            <label for="<?php echo $name;?>">
                                <?php echo $taxonomy->labels->name; if ($taxonomy->_builtin == 1) echo ' <span class="description" style="color:#ababab">(builtin)</span>';?>
                            </label>
                        </td>
                        <td class="slug-column"><?php echo $name; ?></td>
                        <td class="slug-column"><?php echo $slug; ?></td>
                        <td class="options-column">
                            <label><input type="checkbox" id="hide_blank_opt[<?php echo $name;?>]" name="hide_blank_opt[<?php echo $name;?>]" value="1" <?php if (!empty($options) && $options->$name->hide_blank == 1) echo 'checked="checked"';?> /> <?php _e('Hide filter if taxonomy is blank', TFP_PREFIX);?></label>
                        </td>
                    </tr>
                    <?php
                    $i++;
                }
            }
            ?>
		</tbody>
	</table>
	<input type="hidden" name="tax" value="<?php echo $tax_list;?>"/>
    <?php
}

/**
 * Show admin settings page
 */
function taxonomy_filter_option_main_show() {
    taxonomy_filter_fields();
}

/**
 * Save admin page settings
 */
function taxonomy_filter_save_settings() {
    // Explode taxonomy list
	$taxonomies = explode(',', $_POST['tax']);
	$options = new stdClass();

    // Manage save actions
	if ($_POST['taxonomy_filter_action'] != "taxonomy_filter_reset") {
        // Read post data
		if (isset($_POST['taxonomies'])) $taxs = $_POST['taxonomies'];
		else $taxs = array();
		if (isset($_POST['hide_blank_opt'])) $hide_blank_opt = $_POST['hide_blank_opt'];
		else $hide_blank_opt = array();

        // Loop taxonomies
		foreach ($taxonomies as $taxonomy) {
			if (!empty($taxonomy)) {
                // Set data (from post request)
				if ($taxs[$taxonomy] == 1) $replace = 1;
				else $replace = 0;
				if (!empty($hide_blank_opt[$taxonomy])) $hide_blank = 1;
				else $hide_blank = 0;
				$option =  new stdClass();

                // Save taxonomy slug
                $option->slug = $taxonomy;
                // Save replace value (1 = replace, 0 = WordPress default)
                $option->replace = $replace;
                // Save hide blank value (1 = hide, 0 = show)
                $option->hide_blank = $hide_blank;

                // Add current taxonomy to options class
				$options->$taxonomy = $option;
			}
		}
	}
	else {
        // Loop taxonomies
		foreach ($taxonomies as $taxonomy ) {
			if (!empty($taxonomy)) {
                // Set data (from defaults)
				$replace = TFP_DEFAULT_REPLACE;
                $hide_blank = TFP_DEFAULT_HIDE_BLANK;
				$option = new stdClass();

                // Save taxonomy slug
                $option->slug = $taxonomy;
                // Save replace value (1 = replace, 0 = WordPress default)
                $option->replace = $replace;
                // Save hide blank value (1 = hide, 0 = show)
                $option->hide_blank = $hide_blank;

                // Add current taxonomy to options class
				$options->$taxonomy = $option;
			}
		}
	}

    // Save options and reload admin settings page
	update_option(TFP_PREFIX, $options);
	Header("Location: options-general.php?page=".TFP_PREFIX."&updated=true");
}
