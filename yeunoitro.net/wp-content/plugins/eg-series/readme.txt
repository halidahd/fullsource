=== EG-Series ===
Contributors: EmmanuelG
Donate link: http://www.emmanuelgeorjon.com/
Tags: series, posts, taxonomy,
Requires at least: 3.5.0
Tested up to: 3.9.0
Stable tag: 2.1.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

EG-Series helps you to organize your posts in a new way, allowing the creation of groups (series) of posts. Can be useful to promote some posts.

== Description ==

**WordPress** gives us a lot of ways of classification: categories, tags, date ... All of these methods are efficient, and cover most of our needs. But they are applied to all posts, and don't allow differenciating or highlighting some specific posts.
Sometime, it may be helpful to group items into folders or into series, in order to promote these posts, or simply because they belong to a logical sequence, such as tutorials with several stages.

The **EG-Series** plugin gives a set of easy and ergonomic functions to manage series of posts. This plugin allows to include posts into series, to create, delete or rename series. It also includes *widgets* and *shortcodes* to display list of series, or the list of posts belonging to the series of the current post.

**EG-Series** use only standard tools of WordPress, and doesn't create additional tables or objects in WordPress. The version 2 of the plugin uses the taxonomies. The main advantages are:

* The plugin was created in order to reduce as possible, manual operations, and reduce the number of errors,
* **EG-Series** is fully customizable: users can choose the label of *shortcodes*, and slug used for series' link,
* It can be installed and configured very quickly. It also allows to modify a lot of posts without editing them.

With this plugin, you can:

* Add / Delete a post from a serie,
* Create / Rename / Delete series,
* Display the list of series in a post, or display this list in sidebar, with widgets for exemple,
* Display list of posts, using an another shortcode, or an another widget,
* Automatically insert the list of posts of a specific serie, without using shortcode.

**EG-Series** is *TinyMCE Integrated*. That means you don't need to learn the shortcode syntax. The plugin adds a button in the tinymce toolbar. You just have to click on this button, choose parameters/options, and click insert. That's all, the shortcode will be insert into your post with the right parameters.

= Contributions =

Thanks to the following people for their help

* [C&eacute;dric](http://cedric.bosdonnat.free.fr/)
* [Jan Fabry](http://monkeyman.be/)

== Installation ==

1. The plugin is available for download on the WordPress repository,
1. Download the file `eg-series.zip`, and uncompress it,
1. Upload the resulting files to a folder in `../wp-content/plugins/`,
1. Activate EG-Series through the 'Plugins' menu in WordPress,
1. The plugin is ready to be used,
1. You can go to *Settings / EG-Series* menu, to set the plugin parameters.

The plugin is now ready to be used.
You can also install the plugin directly from the WordPress interface.

= Usage =

**EG-Series** adds three administration pages, two widgets and two shortcodes.

= Administration pages =

* **EG-Series Post** allows to quickly create series, and assign them to posts, without edit post one by one,
* **EG-Series Series** gives ability to change or rename series,
* **Settings/EG-Series**  contains all options of the plugin. In this page, you can activate the **auto shortcode** feature.

= Shortcodes =

There two shortcodes: one to display list of series, one to display list of posts for a specific serie.

Shortcodes syntax is:

* Parameters related to the shortcode **series**, to display the list of existing series:

	* **title**: title of the shortcode. Default value: '',
	* **titletag**: html tag used to surround the title. Default value: *h2*,
	* **listtype**: format of the list. Possible values: *ul* for simple list, *ol* for ordered list, or *select* for select combobox. Default value: *ul*,
	* **number**: number of series to display. Default value: *0* (all series),
	* **more**: id of the post or the page where the list of all series are displayed. Default value: *0* (no page),
	* **hide_empty**: Display or hide series with no posts attached. Possible values: *0* all series are shown, *1* only series with posts are displated. Default value: *1*,
	* **width**: length (number of characters) to be used for series name, Default value: *0* (no cut),
	* **show_count**: show the number of posts attached to the serie. Possible values: *0* count hidden, *1* count displayed. Default value: *0*,
	* **description**: show series description. Possible values: *0* description hidden, *1* description shown. Default value: *0*,
	* **listposts**:  Show the list of posts attached to each serie. Possible value: *0* posts are not displayed, *1* posts are displayed. Default value: *0*,

	The following parameters are used only when *listposts* is set to 1:
	* **show_date**: Show date of posts. Possible values: *0* date not displayed, *1* date displayed. Default value: *0*,
	* **expand**: Show the excerpt of each post. Possible values: *0* excerpt not displayed, *1* excerpt displayed. Default value: *0*,
	* **post_orderby**: defines the sort key for posts. Possible values: title, date or user_order. Default: date,
	* **post_order**: defines the sort order. Possible values: ASC (ascending), DESC (descending). Default value: ASC,
	* **numposts**: the number of posts to display for each serie. Default value: *0* (all posts are displayed).

* To display the list of posts of a serie: [seriesposts *options*], with the following options:

	* **id**: ID of a post included in the serie you want to display. Default value: 0 (current post is used),
	* **name**: slug of the serie for which we want to display posts. Default value: '',
	* **sid**: id of the serie for which we want to display posts. Default value: 0 (parameters *id*, and/or *name* are used),
	* **title**: title of the list. Default '' (no title),
	* **titletag**: html tag to put before and after the title. Default: h2,
	* **listtype**: type of list. Possible values are: select, ul for simple list, ol for numbered list). Default: ul,
	* **orderby**: choose the sort key (title,post_title, date or post_date, user_order) - Default: date,
	* **order**: choose the order (ASC for ascending, or DESC for descending) - Default: DESC,
	* **show_date**: display dates or not. Possible values: 0 or 1, False or True. Default: 1 or True,
	* **expand**: display excerpt of each post. Possible values: 0 or 1. Default: 0,
	* **numposts**: number of posts to display. Default value: 0 (all posts are displayed),
	* **width**: length (number of characters) to be used for posts name, Default value: *0* (no cut),

Two widgets provide the same lists than the shortcode, and can be customized with the same options. The Widgets **Series Posts** appears only if the current post is belonging to a serie, and this serie contains more than one post.

== Frequently Asked Questions ==

= I have **404 page not found** error after activating the plugin =
Go to the *Settings / Permalink* menu, and just click on the *save* button. This operation will regenerate the permalinks rewrite rules, and the error will disappear.

= How to delete a serie? =

* Version 1.x*: A serie is automatically deleted when there is no more post inside. So, you can use the *Posts / EG-Serie Posts*, to delete the serie from all the posts.
* Version 2.x*: Go to menu *Posts / Series*, select series you want to delete, and click on delete button

= How can I modify the style of lists? =
Lists use standard HTML tags `ul` and `ol`. So, EG-Series will use the existing styles of your theme. If you want to customize the lists, the plugin provides some CSS styles:
	* For the list of series: `.eg-series-series` et `.eg-series-series-item`,
	* For the list of posts: `.eg-series-posts` et `.eg-series-posts-item`

= I currently use the plugin Serial Posts, can I easily move to EG-Series? =

* Version 1.x*: Uninstall the plugin [Serial Posts](http://wordpress.org/extend/plugins/serial-posts "Serial posts"), and install the plugin EG-Series. In the menu * Settings / EG-Series*, modify the custom field option, by specifying `Serial`.
*Version 2.x*: You cannot get your *Serial posts* series, from the *EG-Series* plugin. You have to re-create your series.

= How can I move from EG-Series to Serial Posts? =

* Version 1.x*: Before uninstall EG-Series, modify the custom field option, in the menu *Settings / EG-Series*, specify `Serial`. Then uninstall widgets, if required, deactivate the *auto shortcode* option, and finally uninstall EG-Series. You can then install the plugin [Serial Posts](http://wordpress.org/extend/plugins/serial-posts/ "Serial posts").
* Version 2.x*: You cannot get your *EG-Series* series, from the *Serial posts* plugin. You have to re-create your series.

= I use the plugin *In-Series* of , *series* of Justin Tadlock, or *Organize Series* of , can I move to EG-Series? =

* Version 1.x*: There is no gateway or import function for these plugins. This kind of feature is studied (perhaps in a next version).
* Version 2.x*: Nothing to do. These plugins use the same taxonomy, named **serie**. So no conversions are required to move from these plugins to *EG-Series*, but also to move from *EG-Series* to these plugins.

= How can I modify the date format in the posts list? =
By default, *EG-Series* uses the date format entered in the option page of WordPress. But you can change this format, by editing the field "Date Format" in the option page of the plugin.

== Screenshots ==

1. **Post Editing page**: TinyMCE integration and additional metabox to quickly choose or add a serie,
2. **TinyMCE editor**: Choose shortcodes options, to insert list of series into a post,
3. **TinyMCE editor**: Choose shortcodes options, to insert list of posts of a specific serie, into a post,
4. **Series Editor**: Add, edit, or remove a serie like you do for a stanard category or tag,
5. **Bulk Editor**: Easily add or remove a post from a serie, using the drag&drop feature,
5. **Options page**: personalized the plugins with the parameters, and the options.

== Changelog ==

= Version 2.1.1 - Apr 15th, 2014 =

* Change: Compatibility with WordPress 3.9 (TinyMCE button),
! Bug fix: Error message `Warning: Illegal string offset 'series' in /public_html/wp-content/plugins/eg-series/inc/eg-series-admin.inc.php on line 56`
* Bug fix: changes in posts were not visible, because of cache (solution: clear cache when a change is made on taxonomies in a post),
* Bug fix: Error message in the option page,
* Bug fix: French Translation updated,
* Change: Internal librairies updates.

= Version 2.1.0 - Oct 28th, 2013 =

* New: new parameters *description*, *expand* for the shortcode **series**,
* New: new parameters *sid*, *width* for the shortcode **seriesposts**,
* New: you can choose now the slug used in permalinks,
* New: cache management improvement,
* Change: all the plugin source code was reviewed to fit with the API of the latest WordPress version (3.6 and 3.7).

= Version 2.0.5 - Oct 31st, 2012 =

* Change: internal librairies updates (warning message about empty object).

= Version 2.0.4 - Jan 25th, 2011 =

* Bug fix: warning message in debug mode, when no custom post type is defined,
* Bug fix: pages didn't appear in the EG-Series Bulk Editor,
* Bug fix: wrong characters displayed in widget when series or posts title are cut,
* New: Add an optional menu in the admin menu bar,
* Change: internal librairies updates acccording recommendations about enqueuing styles and scripts (for WP 3.3).

= Version 2.0.3 - Oct 27th, 2011 =

* New: Add EG-Series menu in the administration bar
* Change: Conversion procedure from 1.x to 2.x is not performed during the plugin activation. This conversion is done within a page in the tools menu.
* Change: internal libraries

= Version 2.0.1 - Oct 26th, 2011 =

* Bug fix: function.array-merge, Argument #2 is not an array in eg-series-core.inc.php on line 417

= Version 2.0.0 - Oct 25th, 2011 =

Notes: EG-Series 2.0 works only with WP 3.0 and upper. Most of the code of this version is new. I rewrote the plugin, using taxonomy rather than metavalue. The conversion is performed during upgrade.

Changes:

* New: optional load of the stylesheet,
* New: ability to choose who can edit series (administrator, editor, author, ...),
* New: you can add a description to each serie,
* New: can display the number of posts of series,
* New: manage custom post types,
* New: option to disable auto-shortcode for posts that already contain manual shortcode,
* New: clean database, and options during uninstallation process,
* Change: Ajax functions are secured,
* Change: new options form,
* Change: new internal libraries,
* Bug fix: only administrators can now change options,
* Bug fix: with shortcode, posts was not ordered when expand option is set to 1,
* Bug fix: In Mass Serie editor, can drag posts to an empty list now
* Bug fix: uninstallation didn't work properly

= Version 1.4.4 - July 29th, 2010 =

* Bug fix: fatal error in eg-series.php,

= Version 1.4.3 - July 28th, 2010 =

* Bug fix: errors in widgets with WP 3.0,
* Change: internal library (eg-forms 1.1.0).

= Version 1.4.2 - Jan 25th, 2010 =

* Bug fix: Excerpt didn't display with some themes,
* New: ability to manage also future posts (but they are not displayed in shortcodes or widgets)

= Version 1.4.1 - Jan 24th, 2010 =

* Bug fix: Error in title of widget that lists posts
* Change: internal library (eg-forms 1.0.7)

= Version 1.4.0 - Jan 18th, 2010 =

* Bug fix: could not change series name,
* Bug fix: issues in the post edit page when plugin was activated,
* Bug fix: Bad translation of widget panel in administration interface,
* New: choose position of the auto-shortcode (beginning or end of the post),
* New: in the widget displaying posts, can use the name of the current serie as title,
* New: can associate a page or a post with a serie,
* Change: enclose the shortcode outputs into **div** tag.
* Change: internal library

= Version 1.3.4 - Dec 20th, 2009 =

* Bug fix: Error message "The plugin does not have a valid header." during auto-installing.

= Version 1.3.3 - Dec 20th, 2009 =

* Bug fix: Error message "The plugin does not have a valid header." during auto-installing.
* Change: Internal library (EG-Plugin 1.1.2).
* Change: Removing Metabox internal library.

= Version 1.3.2 - Dec 20th, 2009 =

* Bug fix: in the "edit posts" page, all fields was empty when using EG-Attachments.

= Version 1.3.1 - Sept 28th, 2009 =

* Bug fix: style issue when use ol/ul list and option expand,
* Bug fix: display "published" posts rather than all posts,
* Change: Internal library (EG-Plugin 1.1.1)

= Version 1.3.0 - Sept 21st, 2009 =

* New: manage posts order,
* Change: the page *EG-Series Posts* is entirely rewritten, using Javascript
* Change: the *EG-Series metabox* is also redefined

= Version 1.2.1- Sept 14th, 2009 =

* Bugfix: Expand option doesn't work when used the TinyMCE button
* Change: Internal change of librairies

= Version 1.2.0 - Sept 01, 2009 =

* New: in posts shortcode, ability to display excerpt,
* New: in series shortcode, ability to display series AND posts (as a table of content),
* New: in the series management page, ability to delete a serie,
* Bugfix: style for dates,
* Bugfix: "More series" link doesn't displayed evenif requested,
* Change: Use wp_cache to avoid repeating request several times,
* Change: internal librairies changes.

Thanks to Cedric ... for its help during bugfix, and Dale for its ideas.

= Version 1.2.1- Sept 12th, 2009 =

* Bugfix: Expand option doesn't work when used the TinyMCE button
* Change: Internal change of librairies

= Version 1.2.0 - Sept 01, 2009 =

* New: in posts shortcode, ability to display excerpt,
* New: in series shortcode, ability to display series AND posts (as a table of content),
* New: in the series management page, ability to delete a serie,
* Bugfix: style for dates,
* Bugfix: "More series" link doesn't displayed evenif requested,
* Change: Use wp_cache to avoid repeating request several times,
* Change: internal librairies changes.

= Version 1.1.0 - July 13rd, 2009 =

* New: Add option to choose where to display lists
* Change: Internal change of librairies

= Version 1.0.4 - June 7th, 2009 =

* Bugfix: Display some debug code
* New: The auto shortcode options can become the default options for the series windows in the TinyMCE editor

= Version 1.0.3 - May 25th, 2009 =

* Bugfix: Pages was not displayed in the shortcodes
* Bugfix: Error when post_title and post_date were used with orderby

= Version 1.0.2 - May 23th, 2009 =

* Bugfix: Error in the posts widget

= Version 1.0.1 - May 23th, 2009 =

* Bugfix: French translation
* Bugfix: Bad widget behavior (link to the last post)
* Bugfix: Series editor: wrong number of posts per serie
* New: Choose to delete or not options during plugin deletion,
* New: Choose to delete or not, custom fields linked to the plugin, during plugin deletion.

= Version 1.0.0 - May 21th, 2009 =

* Bugfix: Shortcode parameters orderby and order works properly now.
* New: Manage posts AND pages (in the mass edit page, and metabox is included also into the page editor),
* New: Ability to choose to display or not display the date in the posts list, and to choose the date format,
* New: Add orderby and order parameters to tha automatic shortcode options list.

= Version 0.9.1 - Apr 8th, 2009 =

* Bugfix: Error message in administration interface with WordPress MU
* Change: Internal change of librairies

= Version 0.9.0 - Mar 22th, 2009 =

* New: Initial release

== Upgrade Notice ==

= From 1.x to 2.x =
The conversion is not performed during the plugin activation. This conversion is done within a page in the menu **Tools / EG-Series 1.x to 2.x**. If this menu doesn't appear, you don't have series from the previous version, or these series are already converted.

== Customize your theme ==

EG-Series 2.x uses now a specific taxonomy to implement series. It means

* The link to series can be: http://host/path/[slug]/[Name of the serie]
* You can build / customize a specific page in your theme to display the content of a serie.

In the path `.../wp-content/plugins/eg-series/themes`, you will find some available customization for themes *Twenty Ten*, ...
To customize these themes, just copy the file `taxonomy-series.php` into the path of your theme `.../wp-content/themes/[Name of the theme]`.

You can also customize your theme, by modifying the `index.php` or `archive.php` file. For example:
`<h1 class="page-title"><?php
	$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
	printf( __('Posts for serie &laquo; %s &raquo;', 'arras'), htmlspecialchars($term->name));
?></h1>
<div class="archive-meta"><?php
	echo htmlspecialchars(term_description( '', get_query_var( 'taxonomy' ) ));
?></div>`

To customize your theme templates, you have some templates tags available in the file `eg-series-template-tags.inc.php`
