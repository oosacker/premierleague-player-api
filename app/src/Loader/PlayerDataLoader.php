<?php

namespace Natsuki\PremierLeagueApi;

use SilverStripe\Dev\CsvBulkLoader;

/**
 * Work in progress - relations are not working
 */

class PlayerDataLoader extends CsvBulkLoader 
{
   public $columnMap = [
      'name' => 'name', 
      'club' => 'Club.club_name', 
      'age' => 'age',
      'position' => 'position',
      'position_cat' => 'position_cat',
      'market_value' => 'market_value',
      'page_views' => 'page_views',
      'fpl_value' => 'fpl_value',
      'fpl_sel' => 'fpl_sel',
      'fpl_points' =>  'fpl_points',
      'region' =>  'region',
      'nationality' =>  'nationality',
      'new_foreign' =>  'new_foreign',
      'age_cat' =>  'age_cat',
      'club_id' =>  'Club.club_id',
      'big_club' => 'Club.big_club',
   ];

   public $duplicateChecks = [
      'name' => 'name'
   ];

   // public $relationCallbacks = [
   //    'Club.club_name' => [
   //       'relationname' => 'Club',
   //       'callback' => 'getClubByName'
   //    ],
   //    'Club.club_id' => [
   //       'relationname' => 'Club_id',
   //       'callback' => 'getClubByName'
   //    ],
   //    'Club.big_club' => [
   //       'relationname' => 'Club_big',
   //       'callback' => 'getClubByName'
   //    ],
   // ];

   // public static function getClubByName(&$obj, $val, $record) 
   // {
   //    return Club::get()->filter('club_name', $val)->First();
   // }

   // public static function getClubByClubId(&$obj, $val, $record) 
   // {
   //    return Club::get()->filter('club_id', $val)->First();
   // }

   // public static function getClubByClubId(&$obj, $val, $record) 
   // {
   //    return Club::get()->filter('club_id', $val)->First();
   // } 
}