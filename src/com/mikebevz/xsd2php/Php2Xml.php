<?php
namespace com\mikebevz\xsd2php;

/**
 * Copyright 2010 Mike Bevz <myb@mikebevz.com>
 * 
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 * 
 *   http://www.apache.org/licenses/LICENSE-2.0
 * 
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

require_once dirname(__FILE__).'/Common.php';

/**
 * PHP to XML converter
 * 
 * @author Mike Bevz <myb@mikebevz.com>
 * @version 0.0.4
 */
class Php2Xml extends Common {
    /**
     * Php class to convert to XML
     * @var Object
     */
    private $phpClass = null;
    
    
    /**
     * 
     * @var DOMElement
     */
    private $root;
    
    
    protected $rootTagName;
    
    private $logger;
    
    public function __construct($phpClass = null) {
        if ($phpClass != null) {
            $this->phpClass = $phpClass;
        }
        
        // @todo implement logger injection
        if (class_exists('\Zend_Registry')) { // this does not work due to PHP bug @see http://bugs.php.net/bug.php?id=46813
            $this->logger = \Zend_Registry::get('logger');
        } else {
            $this->logger = new NullLogger(); 
        }
        
        $this->buildXml();
    }
    
    public function getXml($phpClass = null) {
        if ($this->phpClass == null && $phpClass == null) {
            throw new \RuntimeException("Php class is not set");
        }
        
        if ($phpClass != null) {
            $this->phpClass = $phpClass;
        }
        
        $propDocs = $this->parseClass($this->phpClass, $this->dom, true);
        
        foreach ($propDocs as $name => $data) {
            if (is_array($data['value'])) {
                $elName = array_reverse(explode("\\",$name));
                $code = $this->getNsCode($data['xmlNamespace']);
                foreach ($data['value'] as $arrEl) {
                    //@todo fix this workaroung. it's only works for one level array
                    $dom = $this->dom->createElement($code.":".$elName[0]);
                    $this->parseObjectValue($arrEl, $dom);
                    $this->root->appendChild($dom); 
                }
            } else {
                $this->addProperty($data, $this->root);
            }
        }
        $xml = $this->dom->saveXML();
        //$xml = utf8_encode($xml);
        
        return $xml;
        
    }
    
    
    private function parseClass($object, $dom, $rt = false) {
        $refl = new \ReflectionClass($object);
        $docs = $this->parseDocComments($refl->getDocComment());
        
        if ($docs['xmlNamespace'] != '') {
            $code = '';
            if (is_object($this->root)) { // root initialized
                $code = $this->getNsCode($docs['xmlNamespace']);
                $root = $this->dom->createElement($code.":".$docs['xmlName']);
            } else { // creating root element
                $code = $this->getNsCode($docs['xmlNamespace'], true);
                $root = $this->dom->createElementNS($docs['xmlNamespace'], $code.":".$docs['xmlName']);
            }
            
            $dom->appendChild($root);
        } else {
            //print_r("No Namespace found \n");
            $root = $this->dom->createElement($docs['xmlName']);
            $dom->appendChild($root);
        }
        
        if ($rt === true) {
            $this->rootTagName = $docs['xmlName'];
            $this->rootNsName = $docs['xmlNamespace'];
            $this->root = $root;
        }
        
        $properties = $refl->getProperties();
        
        $propDocs = array();
        foreach ($properties as $prop) {
            $pDocs = $this->parseDocComments($prop->getDocComment());
            $propDocs[$prop->getName()] = $pDocs;
            $propDocs[$prop->getName()]['value'] = $prop->getValue($object);
        }
        
        return $propDocs;
    }
    
    private function buildXml() {
        $this->dom = new \DOMDocument('1.0', 'UTF-8');
        $this->dom->formatOutput = true;
        $this->dom->preserveWhiteSpace = false;
        $this->dom->recover = false;
        $this->dom->encoding = 'UTF-8';
        
    }
    
    
    
    private function addProperty($docs, $dom) {
        if ($docs['value'] != '') {
            $el = "";
            
            if (array_key_exists('xmlNamespace', $docs)) {
                $code = $this->getNsCode($docs['xmlNamespace']);
                $el = $this->dom->createElement($code.":".$docs['xmlName']);
            } else {
                $el = $this->dom->createElement($docs['xmlName']);
            }
            
            if (is_object($docs['value'])) {
                //print_r("Value is object \n");
                $el = $this->parseObjectValue($docs['value'], $el);
            } elseif (is_string($docs['value'])) {
                if (array_key_exists('xmlNamespace', $docs)) {
                    $code = $this->getNsCode($docs['xmlNamespace']);
                    $el = $this->dom->createElement($code.":".$docs['xmlName'], $docs['value']);
                } else {
                    $el = $this->dom->createElement($docs['xmlName'], $docs['value']);
                }
            } else {
                //print_r("Value is not string");
            }
            
            $dom->appendChild($el);
        }
    }
  
    /**
     * 
     * Parse value of the object
     * 
     * @param Object $obj
     * @param DOMElement $element
     * 
     * @return DOMElement
     */
    private function parseObjectValue($obj, $element) {
        
        $this->logger->debug("Start with:".$element->getNodePath());
        
        $refl = new \ReflectionClass($obj);
        
        $classDocs  = $this->parseDocComments($refl->getDocComment());
        $classProps = $refl->getProperties(); 
        $namespace = $classDocs['xmlNamespace'];
        //print_r($classProps);
        foreach($classProps as $prop) {
            $propDocs = $this->parseDocComments($prop->getDocComment());
            //print_r($prop->getDocComment());
            if (is_object($prop->getValue($obj))) {
                $code = '';
                //print($propDocs['xmlName']."\n");
                if (array_key_exists('xmlNamespace', $propDocs)) {
                    $code = $this->getNsCode($propDocs['xmlNamespace']);
                    $el = $this->dom->createElement($code.":".$propDocs['xmlName']); 
                    $el = $this->parseObjectValue($prop->getValue($obj), $el);
                } else {
                    $el = $this->dom->createElement($propDocs['xmlName']); 
                    $el = $this->parseObjectValue($prop->getValue($obj), $el);
                }
                //print_r("Value is object in Parse\n");
                
                $element->appendChild($el);
            } else {
                if ($prop->getValue($obj) != '') {
                    if ($propDocs['xmlType'] == 'element') {
                        $el = '';
                        $code = $this->getNsCode($propDocs['xmlNamespace']);
                        $value = $prop->getValue($obj);
                        
                        if (is_array($value)) {
                            $this->logger->debug("Creating element:".$code.":".$propDocs['xmlName']);
                            $this->logger->debug(print_r($value, true));
                            foreach ($value as $node) {
                                $this->logger->debug(print_r($node, true));
                                $el = $this->dom->createElement($code.":".$propDocs['xmlName']);
                                $arrNode = $this->parseObjectValue($node, $el);
                                $element->appendChild($arrNode);
                            }
                            
                        } else {
                            $el = $this->dom->createElement($code.":".$propDocs['xmlName'], $value);
                            $element->appendChild($el);
                        }
                        //print_r("Added element ".$propDocs['xmlName']." with NS = ".$propDocs['xmlNamespace']." \n");
                    } elseif ($propDocs['xmlType'] == 'attribute') {
                        $atr = $this->dom->createAttribute($propDocs['xmlName']);
                        $text = $this->dom->createTextNode($prop->getValue($obj));
                        $atr->appendChild($text);
                        $element->appendChild($atr);
                    } elseif ($propDocs['xmlType'] == 'value') {
                        
                        $this->logger->debug(print_r($prop->getValue($obj), true));
                        
                        $txtNode = $this->dom->createTextNode($prop->getValue($obj));
                        $element->appendChild($txtNode);
                    } 
                }
            }
        }
        
        return $element;
    }
}