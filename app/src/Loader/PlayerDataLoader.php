<?php

namespace Natsuki\PremierLeagueApi;

use SilverStripe\Dev\CsvBulkLoader;

class PlayerDataLoader extends CsvBulkLoader 
{
   public $columnMap = [
      'name' => 'name', 
      'club' => '->importClubInfo',
   ];

   public static function importClubInfo(&$obj, $val, $record) 
   {
      $obj->write(); // write first in order to generate its ID for use in the image relation
      $image = new Club();
      $image->write();
   }

}