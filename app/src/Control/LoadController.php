<?php

namespace Natsuki\PremierLeagueApi;

use SilverStripe\Forms\Form;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\FileField;
use SilverStripe\Forms\FormAction;
use SilverStripe\Forms\RequiredFields;
use SilverStripe\Control\Controller;

class LoadController extends Controller 
{
    private $mydata = [];
    
    private static $allowed_actions = 
    [
        'Form',
        'test',
    ];

    private static $url_segment = 'load';   // need this or else the form will be at /Form instead of /load/Form and will show 404 error


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
        echo('<pre>');
        var_dump($data);
        echo('</pre>');
        die('hi');
    }

    public function test()
    {
        die('test');
    }
}
