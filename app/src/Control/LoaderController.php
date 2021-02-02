<?php

namespace Natsuki\PremierLeagueApi;

use SilverStripe\Forms\Form;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\FileField;
use SilverStripe\Forms\FormAction;
use SilverStripe\Forms\RequiredFields;
use SilverStripe\Control\Controller;

class LoaderController extends Controller 
{
    private $big_array = []; 

    private static $allowed_actions = 
    [
        'index' => 'ADMIN',
        'Form' => 'ADMIN',
    ];

    private static $url_segment = 'loader';   // need this or else the form will be at /Form instead of /load/Form and will show 404 error


    public function index()
    {
        return [];
    }


    public function Form() : Form
    {
        $form = new Form(
            $this,
            'Form',
            new FieldList(
                new FileField('CsvFile', false)
            ),
            new FieldList(
                new FormAction('doUpload', 'GO!')
            ),
            new RequiredFields()
        );
        return $form;
    }


    public function doUpload($data, $form) : void
    {
        if($this->loadFile()) {

            //$this->displayInfo($this->big_array);
            
            if($this->loadDatabase()) {
                die('<br>DONE');
            }

            
        } 
        else {
            die('<br>FAIL!!');
        }
    }


    protected function loadFile() : bool
    {
        $file = $_FILES['CsvFile']['tmp_name'];
        $handle = fopen($file, "r");
        $index = 0;

        if ($handle !== FALSE) {

            $data = fgetcsv($handle);

            while ($data !== FALSE) {	
                $this->big_array[$index++] = $data;
                $data = fgetcsv($handle);
            }
            
            fclose($handle);
            //$this->displayInfo('FILE LOADED');
            return true;
        } 
        else {
            $this->displayInfo('COULD NOT LOAD FILE!!');
            return false;

        }
    }


    protected function loadDatabase() : bool
    {
        // https://docs.silverstripe.org/en/4/developer_guides/model/relations/

        //$this->displayInfo($this->big_array);

        $count = 0;

        if($this->big_array) {
            for($i=1; $i<sizeof($this->big_array)-1; $i++) {

                // check if club name already exists
                $clubName = $this->big_array[$i][1];
                $oldClub = Club::get()->filter([
                    'name' => $clubName,
                ])->first();    // need first() as get() will return a DataList not single object


                $player = new Player();
                $playerName = $this->big_array[$i][0];
                $player->name = $playerName;
                $player->write();

                // if not exists, then add it to database
                if(!$oldClub) {
                    $newClub = new Club();
                    $newClub->name = $clubName;
                    $newClub->write();
                    $this->displayInfo($clubName);
                    $newClub->players()->add($player);
                }
                else {
                    $oldClub->players()->add($player);
                }
                
                $this->displayInfo($playerName);

                
            }
            return true;
        }
        else {
            die('NO data');      
        }
    }


    protected function displayInfo($data)
    {
        if(is_array($data)) {
            echo('<pre>');
            var_dump($data);
            echo('</pre>');
        }
        else {
            echo('<br>' . $data . '<br>');
        }
    }
}
