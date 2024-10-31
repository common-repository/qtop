=== Plugin Name ===
Contributors: Konrad Haenel
Donate link: http://konrad-haenel.de/en/
Tags: sidebar, widget, popularity contest, top list, qtranslate
Requires at least: 2.9
Tested up to: 2.9.2
Stable tag: 0.1.2

Sidebar-widget displaying popular posts and pages based on the Popularity Contest plugin supporting multiple languages with the qTranslate plugin.

== Description ==

Displaying popular posts is always a good idea, but on multi-language blogs most of the usual plugins won't work. This widget is here to help, using some less well know functions of the Popularity Contest plugin combined with the powerful qTranslate plugin. Now you will be able to display top-post in as much languages as you wish!

And it get's better: with options to display excerpts and meta-information and built-in support for the "Advanced Excerpt"-plugin, you now have even more options to fine-tune your top-posts display.

!!! IMPORTANT: qTop requires Crowd Favorite's "Popularity Contest"-plugin to work. !!!

== Features ==
qTop is an ever growing powerful widget to fine-tune the display of top posts/pages based on Alexander King's "Popularity Contest" plugin. It supports String-filtering through qTranslate and the display of excertps and meta-information. Excerpt-display makes use of the "Advanced Excerpt" plugin if availabe.

* results are sent through the qTranslate string-filter to allow multilanguage blogs to display correct post-titles
* optional display of post meta-information (author nickname and post-date)
* optional display of post excerpt
* makes use of "Advanced Excerpt" plugin if available
* option to exclude pages from results

== What's new in the latest versions? ==

=== 0.1.2 ===
* new: added option to exclude pages from top-list
* new: makes use of the "Advanced Excerpt" plugin if available, defaults to standard excerpt otherwise
* changed: using akpc's "get_popular_posts()" instead of "get_top_ranked_posts()" function now, allowing for much more fine-grained post/page selection in future releases

=== 0.1.1 ===
* new: added option to display the post-excerpt (wrapped in a "div"-tag of the "qtop_excerpt" CSS-class)
* changed: uses a sub-loop internally now to allow usage of template tags

== Installation ==

1. If you haven't already, install and activate the "Popularity Contest" plugin by Crowd Favourite: <http://wordpress.org/extend/plugins/popularity-contest/>
2a. Use the "Plugins -> Add New" dialogue to install the "qTop" plugin (which you are probably doing right now) OR...
2b. if you downlaoded the plugin as a zip file upload the contained `qtop` folder to the `/wp-content/plugins/` directory
3. Activate the newly available "qTop" plugin
4. Add the "qTop" widget to any sidebar.
5. Set it's options.
6. Enjoy!

== Frequently Asked Questions ==

= It won't work! Why? =

qTop requires the plugin "Popularity Contest" to work.

= All fonts (title and excerpt) look the same! =

Right now qTop doesn't provide it's own stylesheet, so you have to add styles through your theme. The classes used by qTop are
*qtop_title
*qtop_excerpt
*qtop_meta
The widget's class is
*qtop

= I have now two versions of the Plugin, what happened? =

qTop has moved from the base-path "popularity-contest-top-pages-widget-qtranslate-enabled" to the slightly shortet "qtop". 
If you installed both versions please update both and remove the one titled "qTop [DEPRECATED]". You can alternatively just delete the directory named
"popularity-contest-top-pages-widget-qtranslate-enabled" from the plugins-folder of your WordPress installation.

= What license does this plugin use? =

GPL

== Screenshots ==

1. backend

2. example site integration

== Changelog ==

= 0.1.2 =
* new: added option to exclude pages from top-list
* new: makes use of the "Advanced Excerpt" plugin if available, defaults to standard excerpt otherwise
* changed: using akpc's "get_popular_posts()" instead of "get_top_ranked_posts()" function now, allowing for much more fine-grained post/page selection in future releases

= 0.1.1 =
* new: added option to display the post-excerpt (wrapped in a "div"-tag of the "qtop_excerpt" CSS-class)
* changed: uses a sub-loop internally now to allow usage of template tags

= 0.1.0 =
* changed: display nickname instead of login in meta-info
* changed: updated widget Dashboard control window (from "qTop Widget" to just "qTop")

= 0.0.9 =
* new: added option to display meta-info of entries (wrapped in a "div"-tag of the "qtop_meta" css-class)

= 0.0.8 =
* fixed: changelog

= 0.0.7 =
* fixed: option to wrap div-tag now working properly
* changed: complete code overhaul, now compliant with wordpress 2.8+ widget API

= 0.0.6 =
* new: option to wrap a div-tag around the resulting list of posts/pages for further syling-possibilities
* changed: overhaul of widget-options-panel structure
* changed: moved base plugin-directory to "qtop" (please uninstall prior versions before installing this one)

= 0.0.5 =
* old fork will no longer be maintained, please use the new version at http://wordpress.org/extend/plugins/qtop/
* changed name, description and instructions accordingly

= 0.0.4 =
* fixed: "The plugin does not have a valid header" error due to nested folder structure

= 0.0.3 =
* new FAQ
* new installation instructions
* converted plugin files format to UTF8

= 0.0.2 =
* totally renamed everything, please uninstall v 0.0.1 before installing 0.0.2

= 0.0.1 =
* initial release