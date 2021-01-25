<?php

namespace Natsuki\PremierLeagueApi;

use SilverStripe\ORM\DataObject;
use SilverStripe\Security\Permission;

class Player extends DataObject
{
    
    // name,club,age,position,position_cat,market_value,page_views,fpl_value,fpl_sel,fpl_points,region,nationality,new_foreign,age_cat,club_id,big_club,new_signing
    // Alexis Sanchez,Arsenal,28,LW,1,65,4329,12,17.10%,264,3,Chile,0,4,1,1,0
    private static $db = [
        'name' => 'Varchar',
        'club' => 'Varchar',
        'age' => 'Int',
        'position' => 'Varchar',
        'position_cat' => 'Int',
        'market_value' => 'Int',
        'page_views' => 'Int',
        'fpl_value' => 'Int',
        'fpl_sel' => 'Varchar',
        'fpl_points' =>  'Int',
        'region' =>  'Int',
        'nationality' =>  'Varchar',
        'new_foreign' =>  'Int',
        'age_cat' =>  'Int',
        'club_id' =>  'Int',
        'big_club' => 'Boolean',
        'new_signing' =>  'Boolean',
    ];


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