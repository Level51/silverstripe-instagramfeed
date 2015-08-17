# InstagramFeed - A SilverStripe module that brings a Instagram news feed to your homepage
**InstagramFeed** is a small module for your SilverStripe based homepage, that allows you to show a feed of your Instagram posts. All you need to do is to install and setup the module and insert a client id (see setup below) and a username.

---
# Features
* Fetching the most recent Instagram posts of every (public) user
* Fetch is done on every page load - so there are always the most recent posts visible
* Get the User ID, that is needed for the API calls by the given user name
* Contains a InstagramFeedPage page type, that fulfills the basic needs

---
# Setup
1. Be sure that the module is in a folder **instagramfeed/** on the root of the project.
2. <code>sake dev/build "flush=all"</code>, depending on your config you might have to do this via URI in the browser.
3. Visit the [Instagram developer page](https://instagram.com/developer/register/) to register your application
4. Go to the CMS settings and fill there your new generated Client ID as well as your user name ...
    * ... save the changes ...
    * ... and click on the **Get Instagram User ID** action - this will fetch the User ID by the given user name
5. Create a page with the type **InstagramFeedPage** and fill the **Post Limit** field (if not filled, 5 is used as default)
6. Call the page in the frontend - everyting should work now :) of course you can overwrite the very basic demo-template by creating a template called InstagramFeedPage in your theme directory

---
# Maintainers
- Daniel Kliemsch <dk@lvl51.de>

---
# License
Copyright 2015 Daniel Kliemsch

Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

    http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.