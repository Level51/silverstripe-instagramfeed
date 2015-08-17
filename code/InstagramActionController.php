<?php

class InstagramActionController extends Controller
{
    private static $allowed_actions = array(
        'getUserID'
    );

    private static $url_handlers = array(
        'getid' => 'getUserID'
    );

    public function getUserID(SS_HTTPRequest $request){

        // Get the current config
        $conf = SiteConfig::current_site_config();

        // Get the instagram factory
        $f = Injector::inst()->get('InstagramFactory');

        // Get the user id from the factory
        $conf->InstagramUserID = $f->getUserIdByUserName($conf->InstagramUserName);;

        // Write the updated config
        $conf->write();

        // Go back to the settings panel
        $this->redirect('admin/settings');
    }

}