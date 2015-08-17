<?php

class InstagramFactory
{

    protected $prepared, $service, $clientID, $userName, $userID;

    /**
     * Set up the factory if not already happened
     * Creates the RestfulService, gets the needed information from the SiteConfig
     * and fetches the users id from the given username (if not already stored in the config)
     */
    public function __construct(){
        if (!$this->prepared) {
            // Create the service
            $this->service = RestfulService::create('https://api.instagram.com/v1/');
            $this->prepared = true;

            // Get the current SiteConfig
            $conf = SiteConfig::current_site_config();

            if (!$conf->InstagramUserName || !$conf->InstagramClientID)
                user_error('Please specify instagram username and client id in the cms settings tab.', E_USER_ERROR);

            $this->clientID = $conf->InstagramClientID;
            $this->userName = $conf->InstagramUserName;

            // Get the user id and store it in the site conf if not already there
            if (!$conf->InstagramUserID) {
                $conf->InstagramUserID = $this->getUserIdByUserName($this->userName);
                $conf->write();
            }

            $this->userID = $conf->InstagramUserID;
        }
    }

    /**
     * Get the id of a user by the given username
     */
    public function getUserIdByUserName($username){

        // Set the related parameter
        $this->service->setQueryString(array(
            'q' => $username,
            'client_id' => $this->clientID
        ));

        // Call the API
        $response = $this->service->request('users/search');

        // Check if response given
        if(!$response)
            return array(
                'status' => 'error',
                'message' => 'error during api call'
            );

        // Decode the JSON content
        $response = json_decode($response->getBody());

        // Return the first found entry
        if(isset($response->data)) {
            return $response->data[0]->id;
        }
    }

    /**
     * Get the recent media of a user, limited by the param
     */
    public function getUsersRecentMedia($limit=5){

        // Set up the query
        $this->service->setQueryString(array(
            'client_id' => $this->clientID,
            'count' => $limit
        ));

        // Request the related sub url of the API
        $response = $this->service->request('users/' . $this->userID . '/media/recent');

        if(!$response)
            return array(
                'status' => 'error',
                'message' => 'error during api call'
            );

        // Decode the JSON content
        $response = json_decode($response->getBody());

        // Loop over the data and prepare it for template usage
        if(isset($response->data)) {
            $posts = ArrayList::create();
            foreach($response->data as $post) {
                $posts->push(ArrayData::create($post));
            }
            return $posts;
        }
    }

}