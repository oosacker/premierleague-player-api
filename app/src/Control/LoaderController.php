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
        if($this->fileLoader()) {
            $this->displayInfo($this->big_array);
            die('<br>DONE');
        } 
        else {
            die('<br>FAIL!!');
        }
    }


    protected function fileLoader() : bool
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
            $this->displayInfo('FILE LOADED');
            return true;
        } 
        else {
            $this->displayInfo('COULD NOT LOAD FILE!!');
            return false;

        }
    }


    protected function loadToDatabase()
    {
        // https://docs.silverstripe.org/en/4/developer_guides/model/relations/
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
