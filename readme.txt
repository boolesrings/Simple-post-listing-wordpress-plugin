=== Simple post list ===

Contributors: sgcoskey
Donate link: http://boolesrings.org
Tags: posts, list
Requires at least: 3.0
Tested up to: 3.3
Stable tag: 0.0

Use the [posts] shortcode to show a list of posts.

== Description ==

This is another simple plugin to show a list of posts from your blog.
Use the `[posts]` shortcode on any post or page.

The shortcode supports several options:

* **category_name**: If defined, show posts only from this category.
You can provide multiple comma-separated category names.

* **style**: One of *list* (default) or *post*.  If it
is *list*, then the list style is indented and bulleted.  If it is *post* 
then the title is promoted to `<h2 class="upcoming-entry-title">` and
the list style is plain.

* **text**: One of *none* (default), *excerpt*, or *normal*.  If it
is *excerpt*, then the post excerpt is shown, similar to search results.
If it is *normal* then the full post (up to the `[more]` tag) is shown.

* **null_text**: If no results are returned, shows this text.
Defaults to `(none)`.

* **class_name**: If defined, adds this class name to the generated `<ul>` tag.
Useful for custom styling.

The output can then be further formatted using CSS.  We recommend the
plugin [Improved Simpler
CSS](http://wordpress.org/extend/plugins/imporved-simpler-css/) for
quickly styling your upcoming events list (and your site)!

Report bugs, give feedback, or fork this plugin on
[GitHub](http://github.com/scoskey/Simple-upcoming-wordpress-plugin).

== Installation ==

Nothing unusual here!

== Changelog ==

0.0 initial release
