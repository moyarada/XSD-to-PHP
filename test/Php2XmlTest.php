<?php
use oasis\names\specification\ubl\schema\xsd\CommonBasicComponents_2;
use oasis\names\specification\ubl\schema\xsd\Order_2;
use oasis\names\specification\ubl\schema\xsd\CommonAggregateComponents_2;

require_once dirname(__FILE__) . '/../../bootstrap.php';
require_once 'PHPUnit/Framework.php';
require_once "application/connector/ubl/utils/Php2Xml.php";

class Xsd2PhpTest extends PHPUnit_Framework_TestCase
{
    
    private $tclass;  
    
    
    protected function setUp ()
    {
        $this->tclass = new Php2Xml();
    }
    protected function tearDown ()
    {
        $this->tclass = null;        
    }
    
    public function testOrderClass() {
         set_include_path(realpath(dirname(__FILE__).'/data').PATH_SEPARATOR.get_include_path());
       require_once 'oasis/names/specification/ubl/schema/xsd/Order_2/Order.php';
       
       //print(get_include_path());
       
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

       $php2xml = new Php2Xml();
        
       $xml = $php2xml->getXml($order);
       
       print_r($xml);
    }
}