<?php
set_include_path(get_include_path().PATH_SEPARATOR.
                realpath("../src"));

use com\mikebevz\xsd2php;

require_once 'PHPUnit/Framework.php';
require_once "com/mikebevz/xsd2php/Bind.php";
require_once "com/mikebevz/xsd2php/Php2Xml.php";

class BindTest extends PHPUnit_Framework_TestCase
{
    /**
     * 
     * @var xsd2php\Bind
     */
    private $tclass;  
    
    
    protected function setUp ()
    {
        $this->tclass = new xsd2php\Bind();
    }
    protected function tearDown ()
    {
        $this->tclass = null;        
    }
    
    public function testBindSimple1() {
        require_once dirname(__FILE__).'/data/expected/simple1/shiporder.php';
        require_once dirname(__FILE__).'/data/expected/simple1/shipto.php';
        require_once dirname(__FILE__).'/data/expected/simple1/item.php';
        require_once dirname(__FILE__).'/data/expected/simple1/orderperson.php';
        require_once dirname(__FILE__).'/data/expected/simple1/name.php';
        require_once dirname(__FILE__).'/data/expected/simple1/address.php';
        require_once dirname(__FILE__).'/data/expected/simple1/city.php';
        require_once dirname(__FILE__).'/data/expected/simple1/country.php';
        require_once dirname(__FILE__).'/data/expected/simple1/title.php';
        require_once dirname(__FILE__).'/data/expected/simple1/note.php';
        require_once dirname(__FILE__).'/data/expected/simple1/quantity.php';
        require_once dirname(__FILE__).'/data/expected/simple1/price.php';
        $xml = file_get_contents(dirname(__FILE__).'/data/expected/simple1/shiporder.xml');
        $model = new shiporder();
        
        $shiporderModel = $this->tclass->bindXml($xml, $model);
        
        $modelToXml = new xsd2php\Php2Xml();
        $actualXml = $modelToXml->getXml($shiporderModel);
        $this->assertEquals($xml, $actualXml);
        
        
        $shiporder = new shiporder();
        $item = new item();
        
        $note = new note();
        $note->value = "Note";
        $item->note = $note;
        
        $price = new price();
        $price->value = 125.5;    
        $item->price = $price;
        
        $quantity = new quantity();
        $quantity->value = 145;
        $item->quantity = $quantity;
        
        $title = new title();
        $title->value = 'Example title';
        $item->title = $title;
        $shiporder->item = $item; 
        
        $shiporder->orderid = 'Order ID';
        $orderperson = new orderperson();
        $orderperson->value = "Jon Doe";        
        
        $shiporder->orderperson = $orderperson;
        
        $shipto = new shipto();
        $address = new address();
        $address->value = "Big Valley Str. 142";
        
        $shipto->address = $address;
        $city = new city();
        $city->value = "Aalborg"; 
        $shipto->city = $city;
        $country = new country();
        $country->value = "Denmark";
        $shipto->country = $country;
        $name = new name();
        $name->value = "Jon Doe Company";
        $shipto->name = $name;
        
        $shiporder->shipto = $shipto;
        
        $this->assertEquals($shiporder, $shiporderModel);
        
        
    }
}