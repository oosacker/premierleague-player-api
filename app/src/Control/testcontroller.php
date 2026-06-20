<?php


use SilverStripe\Forms\Form;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\FileField;
use SilverStripe\Forms\FormAction;
use SilverStripe\Forms\RequiredFields;
use SilverStripe\Control\Controller;

class testcontroller extends Controller 
{
    private static $allowed_actions = 
    [

    ];

    public function index()
    {
        die('index');
    }

}