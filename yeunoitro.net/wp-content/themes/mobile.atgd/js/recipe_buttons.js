/* 
 TynyMCE buttons for [ingredients] and [directions] shortcodes
*/

(function(){
    // creates the plugin
    tinymce.create('tinymce.plugins.recipe', {

         init : function(ed, url, id, controlManager) {
            ed.addButton('ingredients', {
                title : 'Ingredients',
                image : 'http://yeunoitro.net/wp-content/themes/mobile.atgd/images/ingredients.png',
                onclick : function() {
                        ed.execCommand('mceInsertContent', 0, '[ingredients title="Ingredients"]<ul><li>Place your list items here</li></ul>[/ingredients]');
                    }
            });
						ed.addButton('directions', {
                title : 'Directions',
                image : 'http://yeunoitro.net/wp-content/themes/mobile.atgd/images/directions.png',
                onclick : function() {
                        ed.execCommand('mceInsertContent', 0, '[directions title="Directions"]<ol><li>Place your list items here</li></ol>[/directions]');
                    }
            });
        },

        createControl : function(n, cm) {
            return null;
        },
    });
    
    // registers the plugin. 
    tinymce.PluginManager.add('recipe', tinymce.plugins.recipe);
})()
