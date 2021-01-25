## Overview

The Silverstripe webserver will act as a REST API server to provide info about Premier League football players.

* The api is found at /api/v1/natsuki-PremierLeagueApi-player (MUST INCLUDE NAMESPACE).
* The data is loaded from the backend by the ModelAdmin / CSV upload feature.
* Currently only uses one table / DataObject (Player), will try to make it Player + Club (having trouble with relations in CSV uploading).

https://github.com/silverstripe/silverstripe-restfulserver