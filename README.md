## Overview

The Silverstripe webserver will act as a REST API server to provide info about Premier League football players. 
There is a custom data loader class (LoaderController.php) which has a form to handle the CSV file upload. This is used to save player data into the database. This class is implemented by a Silverstripe controller action, which is found at the address /loader/. This address is set by the routes.yml file inside /_config/.

* 2 database tables will be created, clubs and players. They are linked as a one-to-many relationship. See the data models inside src/Model/.
* The REST api is found at /api/v1/natsuki-PremierLeagueApi-{classname} (MUST INCLUDE NAMESPACE). 
* Example requests: /api/v1/natsuki-PremierLeagueApi-club/?name=arsenal will display all data relating to Arsenal, /api/v1/Natsuki-PremierLeagueApi-Player/?nationality=brazil will show all Brazilian players.
* The data is loaded from a ADMIN-only controller action which is found at /loader/ (may need flushing by appending ?flush=all to the end of the URL).
* Database tables can be deleted via DeletePlayers dev task, found at /dev/tasks/delete/.
* The $searchable_fields determines which fields can be used for searching the API.

https://github.com/silverstripe/silverstripe-restfulserver