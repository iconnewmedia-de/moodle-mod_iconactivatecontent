# ICON activate external content #

## What is it? ##
This plugin is for when you want to include GDPR-compliant embeddings of content from external platforms such as YouTube, Facebook, Twitter, Instagram, Google Maps.

The issue with simply embedding the iframe code that social media platforms generate for you with their share-feature,
is that those platforms might instantly set a cookie or receive the viewer's ip address upon opening your page.

The solution is to not include the iframe until the viewer has activated the content by pressing a button and thereby given their consent.

## Using this plugin ##

### External content ###
Here is where you paste the HTML that the external platform will have given you for embedding on other pages.
#### Embedding a YouTube video ####
When you watch a video on YouTube, you'll see a "Share" link to the bottom right of the video. When you click it, you get a selection of possible share-options.
The first option in the list is "Embed". Clicking it will give you the HTML for the iframe to embed. Copy this HTML snippet and paste it into the "External content" field of this plugin.

#### Embedding a Tweet, Facebook post or Instagram post ####
All three platforms are very similar: To the top right of the tweet you'll find three dots. Click on them to get a menu with further options. Further down you have "Embed Tweet". It opens a new tab with the HTML code to embed. Click on the "Copy Code" button next to it, then copy this into the  "External content" field of this plugin.
Note: From Facebook you can only embed your public posts!

#### Embedding Google Maps ####
When you've entered a location in Google maps, you get multiple buttons, the first one being "Directions", the last one "Share". Click the share button.
A new layer pops up. It has two tabs. The first one is "Send a link". We don't want that one. Choose the second tab "Embed a map" instead.
Then click on "Copy HTML"

### Headline, Text, Footer ###
Those are the texts that will get displayed until the user has activated the external content. The default texts are just a suggestion.
If you're using one of the platforms mentioned above, the "Platform" placeholder will automatically get replaced by the name of the platform as soon as the text editor for external content loses focus.
The plugin will also automatically select the corresponding icon to display next to the teaser text.

### Icon ###
The icon will be displayed to the right side of the text (see above "Headline, Text, Footer"). 
Five common icons are already available from the drop down: Twitter, YouTube, Facebook, Instagram and Google Maps.
You also have the possibility to upload an icon of your choice or to not display any icon at all.
Using icons is highly recommended as it allows users to quickly recognize the platforms that this will lead to.

## Installing via uploaded ZIP file ##

1. Log in to your Moodle site as an admin and go to _Site administration >
   Plugins > Install plugins_.
2. Upload the ZIP file with the plugin code. You should only be prompted to add
   extra details if your plugin type is not automatically detected.
3. Check the plugin validation report and finish the installation.

## Installing manually ##

The plugin can be also installed by putting the contents of this directory to

    {your/moodle/dirroot}/mod/iconactivatecontent

Afterwards, log in to your Moodle site as an admin and go to _Site administration >
Notifications_ to complete the installation.

Alternatively, you can run

    $ php admin/cli/upgrade.php

to complete the installation from the command line.

(Btw. "ICON" in the name of this plugin refers to the name of the company that created this, ICON Vernetzte Kommunikation GmbH.
It has nothing to do with icons being an important feature of this plugin. We hope this doesn't cause any confusion.)

## License ##

2022 ICON Vernetzte Kommunikation GmbH <pascal.collins@iconnewmedia.de>

This program is free software: you can redistribute it and/or modify it under
the terms of the GNU General Public License as published by the Free Software
Foundation, either version 3 of the License, or (at your option) any later
version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY
WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A
PARTICULAR PURPOSE.  See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with
this program.  If not, see <https://www.gnu.org/licenses/>.

