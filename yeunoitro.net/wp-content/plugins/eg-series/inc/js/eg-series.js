jQuery(document).ready( function() {

	jQuery("#posts-list").sortable({
		connectWith: '.egs-sortable',
		placeholder: 'placeholder',
		revert: true
	}).disableSelection();

	jQuery(".eg-series").sortable({
		connectWith: '#posts-list',
		revert: true,
		placeholder: 'placeholder',
		update: function () {
			var serie_id = jQuery(this).attr('id');
			var order_list = jQuery('ul#' + serie_id).sortable('toArray');
			jQuery("div#ajax-wait").show(0);
			jQuery("div#ajax-response").hide(0);

			jQuery.ajax({
				type: "POST",
				url: egSeriesSetup.ajax_url,
				cache: false,
				data: {
					action: egSeriesSetup.UpdateSeries,
					serie: serie_id,
					posts: order_list,
					eg_series_nonce: egSeriesSetup.nonce
				},
				success: function(msg) {
					jQuery("div#ajax-wait").hide(0);
					code_msg = msg.split('|');
					jQuery("div#ajax-response").removeClass().addClass((code_msg[0]>0) ? 'error' : 'updated').show(0).html('<p>' + code_msg[1] + '</p>');
					if (code_msg[0] > 0) {
						jQuery('#posts-list').sortable('cancel');
						jQuery(this).sortable('cancel');
					}
				} // End of success
			}); // End of jQuery Index
			// return (false);
		} // End of update
	}).disableSelection();
});