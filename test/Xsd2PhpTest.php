<?php


require_once dirname(__FILE__) . '/../../bootstrap.php';
require_once 'PHPUnit/Framework.php';
require_once "application/connector/ubl/utils/Xsd2Php.php";


function autoLoader($className){
    //Directories added here must be 
//relative to the script going to use this file. 
//New entries can be added to this list
    $directories = array(
      '',
      'data/ubl',
      'data'
    );

    //Add your file naming formats here
    $fileNameFormats = array(
      '%s.php'
    );
    
    // @todo include classes using namespaces
    //if (preg_match('/\\/', $className)) {
        
    //}
        
    // this is to take care of the PEAR style of naming classes
    $path = str_ireplace('_', '/', $className);
    if(@include_once $path.'.php'){
        return;
    }
    
    foreach($directories as $directory){
        foreach($fileNameFormats as $fileNameFormat){
            $path = $directory.sprintf($fileNameFormat, $className);
            if(file_exists($path)){
                include_once $path;
                return;
            }
        }
    }
}

class Xsd2PhpTest extends PHPUnit_Framework_TestCase
{
    private $tclass;  
    private $xsd;
    
    protected function setUp ()
    {
        $this->xsd = dirname(__FILE__)."/../../../../application/connector/ubl/schemas/maindoc/UBL-Order-2.0.xsd";
        $this->tclass = new Xsd2Php($this->xsd);
    }
    protected function tearDown ()
    {
        $this->tclass = null;        
    }
    
    public function testConstruction() {
        //$xml = $this->tclass->getXML();
        //print_r($xml->saveXml());
        //$actual = $xml->saveXml();
        //file_put_contents(dirname(__FILE__).'/data/XSDConvertertoXML.xml', $xml->saveXml());
        //$expected = file_get_contents(dirname(__FILE__).'/data/XSDConvertertoXML.xml');
        //$this->assertEquals($expected, $actual);
    }
    
    public function testGeneratePHP() {
        $this->tclass->setXmlForPhp(dirname(__FILE__).'/data/XSDConvertertoXML.xml');
      //$phpCode = $this->tclass->getPHP();
      //print_r($phpCode);
        //file_put_contents(dirname(__FILE__).'/data/UBLOrder.php', $phpCode);
      

      //include_once 'data/UBLOrder.php';
        //spl_autoload_register('autoLoader');
        
        /*
        $order = new Order_2\Order();
        
        $order->AccountingCost = 120;
        $buyer = new CommonAggregateComponents_2\BuyerCustomerParty();
        $buyerContact = new CommonAggregateComponents_2\BuyerContact();

        $buyerContact->ElectronicMail = 'dude@example.com';
        $buyerContact->ID = "someID";
        $buyer->BuyerContact =  $buyerContact;
        $order->BuyerCustomerParty = $buyer;
        
        $seller = new CommonAggregateComponents_2\SellerSupplierParty();
        
        $order->SellerSupplierParty = $seller;
        $order->Contract = "#ref";
        //$order->OrderLine
        
        //$order->   
        //$order
         */
      
      
       $this->tclass->savePhpFiles(dirname(__FILE__).'/data');
       
      
    }
    
    
    
}