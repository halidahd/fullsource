<?php
/* ------------------------------------------------------------------------------------
*  COPYRIGHT AND TRADEMARK NOTICE
*  Copyright 2008-2015 Arnan de Gans. All Rights Reserved.
*  ADROTATE is a trademark of Arnan de Gans.

*  COPYRIGHT NOTICES AND ALL THE COMMENTS SHOULD REMAIN INTACT.
*  By using this code you agree to indemnify Arnan de Gans from any
*  liability that might arise from it's use.
------------------------------------------------------------------------------------ */

$title = $wpdb->get_var("SELECT `name` FROM `".$wpdb->prefix."adrotate_groups` WHERE `id` = '$group_edit_id';");
$stats = $wpdb->get_row("SELECT SUM(`clicks`) as `clicks`, SUM(`impressions`) as `impressions` FROM `".$wpdb->prefix."adrotate_stats` WHERE `group` = '$group_edit_id';", ARRAY_A);
$stats_today = $wpdb->get_row("SELECT `clicks`, `impressions` FROM `".$wpdb->prefix."adrotate_stats` WHERE `group` = '$group_edit_id' AND `thetime` = '$today';", ARRAY_A);

$stats_graph_month = $wpdb->get_row("SELECT SUM(`clicks`) as `clicks`, SUM(`impressions`) as `impressions` FROM `{$wpdb->prefix}adrotate_stats` WHERE `group` = {$group_edit_id} AND `thetime` >= {$monthstart} AND `thetime` <= {$monthend};", ARRAY_A);

// Get Click Through Rate
$ctr = adrotate_ctr($stats['clicks'], $stats['impressions']);						
$ctr_graph_month = adrotate_ctr($stats_graph_month['clicks'], $stats_graph_month['impressions']);

// Prevent gaps in display
if(empty($stats['impressions'])) $stats['impressions'] = 0;
if(empty($stats['clicks']))	$stats['clicks'] = 0;
if(empty($stats_today['impressions'])) $stats_today['impressions'] = 0;
if(empty($stats_today['clicks'])) $stats_today['clicks'] = 0;
if(empty($stats_graph_month['impressions'])) $stats_graph_month['impressions'] = 0;
if(empty($stats_graph_month['clicks'])) $stats_graph_month['clicks'] = 0;
?>

<h3><?php _e('Statistics for group', 'adrotate'); ?> '<?php echo $title; ?>'</h3>
<table class="widefat" style="margin-top: .5em">

	<tbody>
  	<tr>
        <td width="20%"><div class="stats_large"><?php _e('Impressions', 'adrotate'); ?><br /><div class="number_large"><?php echo $stats['impressions']; ?></div></div></td>
        <td width="20%"><div class="stats_large"><?php _e('Clicks', 'adrotate'); ?><br /><div class="number_large"><?php echo $stats['clicks']; ?></div></div></td>
        <td width="20%"><div class="stats_large"><?php _e('Impressions today', 'adrotate'); ?><br /><div class="number_large"><?php echo $stats_today['impressions']; ?></div></div></td>
        <td width="20%"><div class="stats_large"><?php _e('Clicks today', 'adrotate'); ?><br /><div class="number_large"><?php echo $stats_today['clicks']; ?></div></div></td>
        <td width="20%"><div class="stats_large"><?php _e('CTR', 'adrotate'); ?><br /><div class="number_large"><?php echo $ctr.' %'; ?></div></div></td>
  	</tr>
	</tbody>

</table>

<h3><?php _e('Monthly overview of clicks and impressions', 'adrotate'); ?></h3>
<table class="widefat" style="margin-top: .5em">

	<tbody>
	<tr>
        <th colspan="5">
        	<div style="text-align:center;"><?php echo adrotate_stats_nav('groups', $group_edit_id, $month, $year); ?></div>
        	<?php echo adrotate_stats_graph('groups', $group_edit_id, 1, $monthstart, $monthend); ?>
        </th>
	</tr>
	<tr>
        <td width="33%"><div class="stats_large"><?php _e('Impressions', 'adrotate-pro'); ?><br /><div class="number_large"><?php echo $stats_graph_month['impressions']; ?></div></div></td>
        <td width="33%"><div class="stats_large"><?php _e('Clicks', 'adrotate-pro'); ?><br /><div class="number_large"><?php echo $stats_graph_month['clicks']; ?></div></div></td>
        <td width="34%"><div class="stats_large"><?php _e('CTR', 'adrotate-pro'); ?><br /><div class="number_large"><?php echo $ctr_graph_month; ?> %</div></div></td>
	</tr>
	</tbody>

</table>	

<p><em><strong><?php _e('Note:', 'adrotate'); ?></strong> <?php _e('All statistics are indicative. They do not nessesarily reflect results counted by other parties.', 'adrotate'); ?></em></p>