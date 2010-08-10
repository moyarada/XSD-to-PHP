<?php
use com\mikebevz\xsd2php;

set_include_path(dirname(__FILE__).'/data/expected/ubl2.0'.PATH_SEPARATOR.
                 dirname(__FILE__).'/data/expected/simple1'.PATH_SEPARATOR.
                 get_include_path());
                        
function __autoload($class) {  
    // convert namespace to full file path  
    $class = 'data/expected/ubl2.0/' . str_replace('\\', '/', $class) . '.php';  
    require_once($class);  
}
                        
use oasis\names\specification\ubl\schema\xsd\CommonBasicComponents_2;
use oasis\names\specification\ubl\schema\xsd\Order_2;
use oasis\names\specification\ubl\schema\xsd\CommonAggregateComponents_2;

//require_once dirname(__FILE__) . '/../../bootstrap.php';
require_once 'PHPUnit/Framework.php';
require_once "../src/Php2Xml.php";

class Xsd2PhpTest extends PHPUnit_Framework_TestCase
{
    
    private $tclass;  
    
    
    protected function setUp ()
    {
        $this->tclass = new xsd2php\Php2Xml();
    }
    protected function tearDown ()
    {
        $this->tclass = null;        
    }
    
    public function testOrderClass() {
       
       
       
       //print(get_include_path());

       //require_once 'oasis/names/specification/ubl/schema/xsd/Order_2/OrderType.php';
       //
       
       
       
       $order = new Order_2\Order();
       
       $orderLine =   new CommonAggregateComponents_2\OrderLine();
       
            $lineItem = new CommonAggregateComponents_2\LineItem();
            $lineItem->ID = 'DYE_SUB';
            $lineItem->Quantity = 110.5;
       
                $price = new CommonAggregateComponents_2\Price();       
                $price->PriceAmount = 200.75;
            $lineItem->Price = $price;
       
       $quantity = new CommonBasicComponents_2\Quantity();
       $quantity->value = 110.22;
       $quantity->unitCode = 'M2';
       
       
       $lineItem->Quantity = $quantity;
              
       $orderLine->LineItem = $lineItem;
       $order->OrderLine = $orderLine; 
       
        $buyerCustomer = new CommonAggregateComponents_2\BuyerCustomerParty();
        $buyerCustomer->AccountingContact = '';
        $buyerCustomer->AdditionalAccountID = '';
          $buyerContact = new CommonAggregateComponents_2\BuyerContact();
          $buyerContact->ElectronicMail = "email@example.com";
          $buyerContact->ID = "CT2344332";
          $buyerContact->Name = 'Jon Doe';
          $buyerContact->Telephone = "24533223";
          
        $buyerCustomer->BuyerContact = $buyerContact;
        $buyerCustomer->SupplierAssignedAccountID = "CT02933822";
        
        $order->BuyerCustomerParty = $buyerCustomer;

       $php2xml = new xsd2php\Php2Xml();
        
       $xml = $php2xml->getXml($order);
       //file_put_contents("data/expected/ubl2.0/Order.xml", $xml);
       $expected = file_get_contents("data/expected/ubl2.0/Order.xml");
       
       $this->assertEquals($expected, $xml);
       //print_r($xml);
       
    }
    
    public function testSimple1Schema() {
        require_once 'shiporder.php';
        require_once 'item.php';
        require_once 'note.php';
        require_once 'price.php';
        require_once 'quantity.php';
        require_once 'title.php';
        require_once 'orderperson.php';
        require_once 'shipto.php';
        require_once 'address.php';
        require_once 'city.php';
        require_once 'country.php';
        require_once 'name.php';
        
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
       
        
        $php2xml = new xsd2php\Php2Xml();
        
       $xml = $php2xml->getXml($shiporder);
       
       //file_put_contents("data/expected/simple1/shiporder.xml", $xml);
       
       $expected = file_get_contents("data/expected/simple1/shiporder.xml");
       
       $this->assertEquals($expected, $xml);
       //print_r($xml);
    }
}