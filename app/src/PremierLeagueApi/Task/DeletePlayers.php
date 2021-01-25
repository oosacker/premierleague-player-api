<?php

namespace Natsuki\PremierLeagueApi;

use SilverStripe\Dev\BuildTask;

class DeletePLayers extends BuildTask
{
    protected $title = 'Delete';

    protected $description = 'Deletes all players from database';

    private static $segment = 'delete';

    public function run($request)
    {
        $list = Player::get();

        $count = 0;
        foreach($list as $item) {
            echo $item->delete();
            echo($count . '<br>');
            $count++;
        }

        echo('Deleted ' . $count . ' players');
        
    }

}
