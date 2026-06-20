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
        'new_signing' =>  'Boolean',
    ];

    private static $has_one = [
        'club' => Club::class
     ];

     private static $summary_fields = [
        'name' => 'Name',
        'Club.name' => 'Club',
        'age' => 'Age',
        'position' => 'Position',
    ];

    private static $searchable_fields = [
        'name',
        'age',
        'position',
        'nationality',
    ];

    // needed for namespaced models
    private static $table_name = 'players';

    private static $api_access = true;

    /*
        ADMIN
        CMS_ACCESS_AssetAdmin
        CMS_ACCESS_CMSMain
        CMS_ACCESS_ReportAdmin
        SITETREE_REORGANISE
        true
        false
    */
    public function canView($member = null) 
    {
        return true;
    }

    public function canEdit($member = null) 
    {
        return Permission::check('ADMIN', 'any', $member);
    }

    public function canDelete($member = null) 
    {
        return Permission::check('ADMIN', 'any', $member);
    }

    public function canCreate($member = null, $context = []) 
    {
        return Permission::check('ADMIN', 'any', $member);
    }

}