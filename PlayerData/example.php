<?php

/* TestProduct.php */
namespace Test\Models;

use SilverStripe\ORM\DataObject;

class TestProduct extends DataObject {

    private static $table_name = 'Test_TestProduct';

    private static $db = [
        'Title' => 'Varchar(255)',
    ];

    private static $has_many = [
        'Images' => TestProductImage::class,
    ];

    private static $summary_fields = [
        'Title' => 'Title',
    ];

}

/* TestProductImage.php */
namespace Test\Models;

use SilverStripe\ORM\DataObject;

class TestProductImage extends DataObject {

    private static $table_name = 'Test_TestProductImage';

    private static $db = [
        'Title' => 'Varchar(255)',
        'URL' => 'Varchar(255)',
    ];

    private static $has_one = [
        'Product' => TestProduct::class,
    ];

    private static $summary_fields = [
        'Title' => 'Title',
        'URL' => 'URL',
    ];

}

/* TestProductAdmin.php */
namespace Test\Extensions;

use Test\Models\TestProduct;
use Test\Models\TestProductImage;
use SilverStripe\Admin\ModelAdmin;

class TestProductAdmin extends ModelAdmin {
    
    private static $menu_title = 'Tests';
    private static $url_segment = 'tests';
    private static $menu_icon_class = 'font-icon-happy';
    private static $menu_priority = 4;

    private static $managed_models = [
        TestProduct::class,
        TestProductImage::class,
    ];

    private static $model_importers = [
        TestProduct::class => TestCsvBulkLoader::class,
    ];
}

/* TestCsvBulkLoader.php */
namespace Test\Extensions;

use Test\Models\TestProduct;
use Test\Models\TestProductImage;
use SilverStripe\Dev\CsvBulkLoader;

class TestCsvBulkLoader extends CsvBulkLoader
{
    /* Note: expects import columns: ProductName, ProductImageInfo
     * e.g.:
     * MyProduct, "Name1 (Link1), Name2 (Link2), Name3 (Link3)"
     */
    public $columnMap = [
        'ProductName' => 'Title', 
        'ProductImageInfo' => '->importImages',
    ];
    public static function importImages(&$obj, $val, $record) 
    {
        $parts = explode(',', $val);
        $obj->write(); // write first in order to generate its ID for use in the image relation
        
        foreach($parts as $part) {
            $part = str_replace(['(', ')'], ',', $part);
            $subparts = explode(',', $part);
            if(count($subparts) < 2) {
                continue;
            }
            $image = new TestProductImage();
            $image->Title = trim($subparts[0]);
            $image->URL = trim($subparts[1]);
            $image->ProductID = $obj->ID;
            $image->write();
        }
    }
}