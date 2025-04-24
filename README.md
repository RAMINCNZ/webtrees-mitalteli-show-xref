Module for webtrees genealogy software to show XREF and UID values
==================================================================

[![Latest Release](https://img.shields.io/github/release/elysch/webtrees-mitalteli-show-xref.svg)][1]
[![webtrees major version](https://img.shields.io/badge/webtrees-v2.0.x-green)][2]
[![webtrees major version](https://img.shields.io/badge/webtrees-v2.1.x-green)][2]
[![webtrees major version](https://img.shields.io/badge/webtrees-v2.2.x-green)][2]
[![Downloads](https://img.shields.io/github/downloads/elysch/webtrees-mitalteli-show-xref/total.svg)]()

[![paypal](https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif)](https://www.paypal.com/donate/?business=EU37HN97QD9EU&no_recurring=0&currency_code=MXN)

Description
------------
This module adds a Sidebar to the Individual view that shows the XREF and UID (identification strings) for him/her, for all his/her families and the families childs.

You can add a reference to other record within a text or note field writing something like "@<XREF>@" (where <XREF> should be substituted by an existent identification string). After webtrees versions 2.1.22 or 2.2.1 it's probable that will be implemented a way to include references using UID identification strings.

**It's important to note that the XREF's can be changed, so the Webtrees user should use them at his/her own risk.**

NOTE 1: When adding reference links from one record to another, I recommend to always include arbitrary text that permits to identify what information is being referred to, just in case the identification string gets removed/replaced in the destination and the link stops working.

NOTE 2: If you feel that it slows down too much or for whatever reason, you can disable the UID information by editing ShowXrefModule.php file and change "$with_uid = true;" to "$with_uid = false;"

Installation & upgrading
------------------------
Unpack the zip file and place the mitalteli-show-xref folder in the modules_v4 folder of webtrees. Upload the newly added folder to your server. It is activated by default and will work immediately. No additional configuration is required.

Bugs & feature requests
-------------------------
You can [create a new issue on GitHub][3] or comment in the [webtrees forum][4]

Please search in those places before writing new messages. Maybe your concern has already been discussed.

 [1]: https://github.com/elysch/webtrees-mitalteli-show-xref/releases/latest
 [2]: https://webtrees.github.io/download
 [3]: https://github.com/elysch/webtrees-mitalteli-show-xref/issues?state=open
 [4]: https://www.webtrees.net/index.php/forum/index

