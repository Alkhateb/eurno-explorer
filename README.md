# eurno-explorer
A Wordpress plugin to show account balances and BPs of EOS based blockchains.

## Beta Notice
The current version of this plugin is a beta release and all users are advised that they install and use the plugin at their own risk. We have done our utmost to ensure complete functionality and ease of use, however, we are continuing to develop the plugin everyday. At present you can see the list of known about issues below. 

## Compatibility
We have tested the Eurno Explorer plugin on all versions of Wordpress from **4.9.8** to the current **5.0.3**. Other than the issues listed within this page we have found the plugin to function normally. 

## Current Issues
The following issues are already noted by the Eurno team and are being actively worked on, if you notice an issue which needs attention and is not listed below please create a pull request. Alternatively, if you think you can solve an issue listed below please do the same. 

#### Wordpress Gutenberg editor compatibility.
As with many wordpress plugins which use shortcodes the Gutenberg editor has provided some errors. With our Eurno Explorer the error is no different: Wordpress displays "update failed." or "publishing failed." when you save a page with the [eurno_explorer] shortcode. From what we can see the page does in fact update and the plugin is then visibile on the page you create. 
**Solution**
As a workaround in order to prevent this error message from being displayed you can use the classic Wordpress editor (as is reccommended by other plugin developers), you can download it here: [https://en-gb.wordpress.org/plugins/classic-editor/](https://en-gb.wordpress.org/plugins/classic-editor/)
