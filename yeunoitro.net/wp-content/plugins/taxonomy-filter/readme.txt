=== Taxonomy filter ===
Contributors: lando1982
Tags: usability, filter, admin, category, tag, term, taxonomy, hierarchy, organize, manage
Requires at least: 3.0
Tested up to: 4.4.1
Stable tag: 1.1.1
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl.html

Taxonomy filter is a simple and flexible plugin which allow users to filter hierarchical term taxonomies inside admin pages.

== Description ==

Taxonomy filter is a simple and flexible plugin which allow users to filter hierarchical term taxonomies inside admin pages. If you need to simplify your tags and categories research on admin pages, this plugin will make it easier for you. It adds a custom input field (only for configured taxonomies) that you can use to filter a every taxonomy list.

Imagine having too many tags on your post admin page and having to lose so much time scrolling a long list of items or having to search for a tag with the classic browser search box. With "Taxonomy filter" plugin you can search, choice and select tags in a very short time, a great gain!

In addition, you have to setup which taxonomies should have "Taxonomy filter" activated. When you install and activate the plugin, an admin page is added on settings section. In this page are automatically listed all valid taxonomies, you have two options:

* enable on post management pages (allow you to turn on/off filter field)
* hide filter field if taxonomy is empty

You can also manage taxonomy filters into bulk edit section if you want to perform a quick edit.

If in your theme you have changed post columns using the 'manage_edit-post_columns' filter, you need to add another filter to apply the taxonomy filter bulk section.
For example:
`
add_filter('manage_edit-post_columns', 'taxonomy_filter_manage_bulk_columns', 99, 1);
add_filter('manage_edit-<CUSTOM-TYPES>_columns', 'taxonomy_filter_manage_bulk_columns', 99, 1);
`

It works only with hierarchical taxonomies (both default categories and [custom taxonomies](http://codex.wordpress.org/Custom_Taxonomies)).

= Usage =

1. Go to `WP-Admin -> Posts -> Add New`.
2. Find the input filter field on page sidebar.
3. Select tags filtering list.

Links: [Author's Site](http://www.andrealandonio.it)

== Installation ==

1. Unzip the downloaded `taxonomy-filter` zip file
2. Upload the `taxonomy-filter` folder and its contents into the `wp-content/plugins/` directory of your WordPress installation
3. Activate `taxonomy-filter` from Plugins page

== Frequently Asked Questions ==

= Works on multisite? =

Yes, you have only to enable valid taxonomies on settings page for every site.

= Works on hierarchical taxonomies? =

Yes, you can filter items over taxonomies with multiple child/parent levels.

= Works on with custom post types? =

Yes, keep in mind to add 'manage_edit-post_columns' filter if you want show filter in bulk edit section.

= Works on with custom taxonomies? =

Yes, by default you can filter all the taxonomies that you have enabled in taxonomy filter settings page.

== Screenshots ==

1. Settings admin page
2. Filter tags (initial list before filtering and filtered list)
3. Filter categories (initial list before filtering and filtered list)
4. Bulk edit section

== Changelog ==

= 1.1.1 - 2015-10-25 =
* Extend filters selection to all the categories in bulk edit section

= 1.1.0 - 2015-10-24 =
* Add filters to bulk edit section

= 1.0.2 - 2014-12-11 =
* Increased plugin's compatibility to older WordPress versions

= 1.0.1 - 2014-11-15 =
* Fixed hierarchical filter search

= 1.0.0 - 2014-11-12 =
* First release

== Upgrade Notice ==

= 1.0.0 =
This version requires PHP 5.3.3+
