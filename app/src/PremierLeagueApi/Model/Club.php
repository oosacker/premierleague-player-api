<?php

/**
 * Work in progress
 */

namespace Natsuki\PremierLeagueApi;

use SilverStripe\ORM\DataObject;
use SilverStripe\Security\Permission;

class Club extends DataObject
{
    
    private static $db = [
        'club_name' => 'Varchar',
        'club_id' =>  'Int',
        'big_club' => 'Boolean',
    ];

    private static $has_many = [
        //'players' => Player::class
     ];

    // needed for namespaced models
    private static $table_name = 'clubs';

    private static $api_access = true;

    public function canView($member = null) 
    {
        return true;
    }

    public function canEdit($member = null) 
    {
        return true;
    }

    public function canDelete($member = null) 
    {
        return true;
    }

    public function canCreate($member = null, $context = []) 
    {
        return true;
    }

}