# Eurno Explorer
The Eurno Explorer is a Wordpress plugin which will allow website owners/managers to easily display various statistics regarding numerous EOS based blockchains. At present the explorer includes the following blockchains: *EOS*, *Enumivo* and *Telos*. We will be adding more blockchains in the near future. If you would like us to consider adding your chain please [contact us](https://eurno.org/#contact).

## Capabilities
The Eurno Explorer will allow you to display a full table of the current block producers, ordered by their rank within the relevant blockchain. It will also provide the functionality for your website's users to search their account and retrieve information such as their balance, recent transactions and transaction receipts. 

## Customisation
You can customise the Eurno Explorer to allow you to display balances for any valid token within the supported blockchains. In order to add a token you are simply required to follow the instructions specified on the relevant page. 

For example, to add an EOS based token you would install the plugin and then navigate to the EOS sub menu page in the admin panel. When on the correct page you will be presented with four input fields and one dropdown selector. Input the correct data and it will be automatically added to the plugin. 

In order to remove a token head over to the page of the chain you wish to manage and then check the box next to the token you wish to remove and press save. 

### Notice regarding logos
At present you are required to upload your desired logo in the Wordpress media uploader, copy the URL of the image and then paste that into the *logo* field. We are working on implementing the Wordpress uploader for future versions of the plugin. 

## Beta Notice
The current version of this plugin is a beta release and all users are advised that they install and use the plugin at their own risk. We have done our utmost to ensure complete functionality and ease of use, however, we are continuing to develop the plugin everyday. At present you can see the list of known about issues below. 

## Compatibility
We have tested the Eurno Explorer plugin on all versions of Wordpress from **4.9.8** to the current **5.0.3**. Other than the issues listed within this page we have found the plugin to function normally. 

## Support
If you enjoy our work and would like to support the Eurno project please vote for our block producer **eurnoproject** on the Enumivo blockchain. 

If you would like to donate to the Eurno project please send EOS, Telos or ENU to **eurnoproject**

If you would like to support our developer directly please donate EOS, Telos or ENU to **summitdecent**

This plugin has been developed entirely from scratch on a voluntary basis so your donations will make a difference and enable our developer to continue his work. 

## Current Issues
The following issues are already noted by the Eurno team and are being actively worked on, if you notice an issue which needs attention and is not listed below please create a pull request. Alternatively, if you think you can solve an issue listed below please do the same. 

#### ~~Wordpress Gutenberg editor compatibility.~~
~~As with many Wordpress plugins which use shortcodes the Gutenberg editor has provided some errors. With our Eurno Explorer the error is no different: Wordpress displays "update failed." or "publishing failed." when you save a page with the [eurno_explorer] shortcode. From what we can see the page does in fact update and the plugin is then visible on the page you create. ~~

#### ~~Not displaying on preview page~~
~~This is due to a line of code I have put on the include file which prevents the rendered html/js from displaying on the editor. Will fix today~~

#### ~~Votes incorrectly formatted~~
~~It was pointed out I need to divide the value returned for votes by 10,000 as they are showing billions and not millions (as per the api call). This will be rectified tonight (10/1/2019).~~

## Thanks
We would like to thank everyone who has supported the Eurno project and assisted with trouble shooting this plugin. The people over at [Stack Overflow](https://stackoverflow.com) have been a huge help, thank you.

We would also like to thank @nayuki for their QRcode generator plugin, and @caldwell for their RenderJSON plugin.

# Happiness. 
