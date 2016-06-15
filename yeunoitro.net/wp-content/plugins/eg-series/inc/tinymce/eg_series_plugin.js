(function() {
	tinymce.PluginManager.requireLangPack('egs_shortcode');

	tinymce.create('tinymce.plugins.egs_shortcode', {

		init : function(ed, url) {

			ed.addCommand('mceEGSeries', function() {
				var post_id = tinymce.DOM.get('post_ID').value;
				ed.windowManager.open({
					file : url + '/eg_series_popup.php?post_id=' + post_id,
					width : 600 + parseInt(ed.getLang('egs_shortcode.delta_width', 0)),
					height : 450 + parseInt(ed.getLang('egs_shortcode.delta_height', 0)),
					inline : 1
				}, {
					plugin_url : url, // Plugin absolute URL
				});
			});

			ed.addButton('egs_shortcode', {
				title : ed.getLang('egs_shortcode.desc'),
				cmd : 'mceEGSeries',
				image : url + '/img/egseries.png',
			});
		},

		createControl : function(n, cm) {
			return null;
		},

		getInfo : function() {
			return {
				longname  : 'EG-Series',
				author 	  : 'Emmanuel GEORJON',
				authorurl : 'http://www.emmanuelgeorjon.com/',
				infourl   : 'http://wordpress.org/extend/plugins/eg-series/',
				version   : '2.0.0'
			};
		}
	});

	// Register plugin
	tinymce.PluginManager.add('egs_shortcode', tinymce.plugins.egs_shortcode);
})();