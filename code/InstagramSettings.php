<?php

class InstagramSettings extends DataExtension
{
    private static $db = array(
        'InstagramClientID' => 'Varchar(255)',
        'InstagramUserName' => 'Varchar',
        'InstagramUserID' => 'Int'
    );

    public function updateCMSFields(FieldList $fields) {
        $fields->addFieldsToTab('Root.Instagram', array(
            TextField::create('InstagramClientID', _t('InstagramSettings.INSTAGRAM_CLIENT_ID', 'Instagram client id'))
                ->setDescription(_t('InstagramSettings.INSTAGRAM_CLIENT_ID_DESC', "Register your client here: https://instagram.com/developer/register/")),

            TextField::create('InstagramUserName', _t('InstagramSettings.INSTAGRAM_USER_NAME', 'Instagram user name')),

            ReadonlyField::create('InstagramUserID', _t('InstagramSettings.INSTAGRAM_USER_ID', 'Instagram user id'))
                ->setDescription(_t('InstagramSettings.INSTAGRAM_USER_ID_DESC', "IMPORTANT: Click on the 'Get Instagram ID' button below if you changed your username"))
        ));
    }

    public function updateCMSActions(FieldList $actions) {
        Requirements::javascript('instagramfeed/javascript/InstagramSettings.js');
        $actions->push(FormAction::create('getUserID', _t('InstagramSettings.INSTAGRAM_GET_USER_ID', 'Get Instagram User ID')));
    }

}