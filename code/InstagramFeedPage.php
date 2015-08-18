<?php

class InstagramFeedPage extends Page {

    private static $singular_name = 'Instagram Feed';
    private static $description = 'Basic page for an instagram feed.';

    private static $db = array(
        'PostsLimit' => 'Int'
    );

    public function getCMSFields(){
        $fields = parent::getCMSFields();
        $fields->addFieldToTab('Root.Main',
            NumericField::create('PostsLimit', _t('InstagramFeed.POSTS_LIMIT', 'Post Limit')));
        return $fields;
    }

    public function getPosts(){
        // Get a instance of the factory
        $f = Injector::inst()->get('InstagramFactory');

        // Set the limit - take it from the backend if set, otherwise take 5 as default
        $limit = ($this->PostsLimit) ? $this->PostsLimit : 5;

        // Get the posts
        return $f->getUsersRecentMedia($limit);
    }

    // Get the caption without the hashtags and optional limited by $limit letters
    public function stripCaption($caption, $limit = null){

        // Remove the hash tags
        $caption = substr($caption, 0, strpos($caption, '#'));

        // Create a HTMLText
        $sf = HTMLText::create('Caption');
        $sf->setValue($caption);

        // Optional: limit the characters
        if ($limit != null)
            return $sf->LimitCharacters($limit, '...');

        return $sf;
    }

    // Get the date from given timestamp, formatted with strftime
    public function getDate($timestamp, $format = "%Y/%m/%d, %H:%M") {
        return strftime($format, $timestamp);
    }

}

class InstagramFeedPage_Controller extends Page_Controller {}