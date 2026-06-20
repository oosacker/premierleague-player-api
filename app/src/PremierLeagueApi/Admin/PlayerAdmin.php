<?php

namespace Natsuki\PremierLeagueApi;

use SilverStripe\Admin\ModelAdmin;
use SilverStripe\Dev\CsvBulkLoader;

class PlayerAdmin extends ModelAdmin
{
    private static $managed_models = [
        Player::class,
        Club::class,
    ];

    private static $model_importers = [
        //Player::class => PlayerDataLoader::class,
        //Player::class => CsvBulkLoader::class,
     ];

    private static $menu_title = 'Players';

    private static $url_segment = 'players';




}
