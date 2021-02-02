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
    private $mydata = [];

    private static $allowed_actions = 
    [
        'Form',
        'test',
    ];

    private static $url_segment = 'loader';   // need this or else the form will be at /Form instead of /load/Form and will show 404 error


    public function index()
    {
        return [];
    }


    public function Form() 
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


    public function doUpload($data, $form) 
    {
        
        $file = $_FILES['CsvFile']['tmp_name'];
        $handle = fopen($file, "r");
        $big_array = []; 

        if ($handle !== FALSE) {
            $data = fgetcsv($handle);
            while ($data !== FALSE) 
            {		
                $big_array = array_merge($big_array, $data);
                $data = fgetcsv($handle);
            }
            fclose($handle);
        } 
        else {
            die('<br>fail');
        }
        
        echo('<pre>');
        var_dump($big_array);
        echo('</pre>');
        die('<br>hi');
    }

    public function loadData()
    {
        // https://docs.silverstripe.org/en/4/developer_guides/model/relations/
    }

    public function test()
    {
        die('test');
    }
}
