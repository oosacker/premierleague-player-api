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
        'test'
    ];

    private static $url_segment = 'loader';

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
                new FormAction('doUpload', 'Upload')
            ),
            new RequiredFields()
        );
        return $form;
    }

    public function doUpload($data, $form) 
    {
        return $this->redirectBack();
    }

    public function test()
    {
        die('test');
    }
}
