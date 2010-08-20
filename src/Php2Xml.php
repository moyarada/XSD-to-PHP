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
 * @version 0.0.1
 */
class Php2Xml extends Common {
    /**
     * Php class to convert to XML
     * @var Object
     */
    private $phpClass = null;
    /**
     * Dom document
     * @var DOMDocument
     */
    private $dom;
    
    /**
     * 
     * @var DOMElement
     */
    private $root;
    
    public function __construct($phpClass = null) {
        
        if ($phpClass != null) {
            $this->phpClass = $phpClass;
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
        
        $xml = "XML";
        
        $propDocs = $this->parseClass($this->phpClass, $this->dom, true);
        
        //$this->logger = \Zend_Registry::get('logger');
        
        foreach ($propDocs as $name => $data) {
            if (is_array($data['value'])) {
                
                $this->logger->debug(print_r($name, true));
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
        
        //print_r($propDocs);
        return $this->dom->saveXML();
        
    }
    
    private $namespaces = array();
    private $lastNsKey = 0;
    private $rootTagName;
    
    private function getNsCode($longNs, $rt = false) {
        // if namespace exists - just use its name
        // otherwise add it as nsatrribute to root and use its name 
        if (array_key_exists($longNs, $this->namespaces)) {
            return $this->namespaces[$longNs];
        } else {
            $this->namespaces[$longNs] = 'ns'.$this->lastNsKey;
            //$this->logger->debug($this->namespaces[$longNs]);
            if ($rt === false) {
                $nsAttr = $this->dom->createAttributeNS($longNs, $this->namespaces[$longNs].":".$this->rootTagName);
            }
            $this->lastNsKey++;
            return  $this->namespaces[$longNs];
        }
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
            $code = $this->getNsCode($docs['xmlNamespace']);
            $root = $this->dom->createElement($code.":".$docs['xmlName']);
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
        
    }
    
    
    
    private function addProperty($docs, $dom) {
        if ($docs['value'] != '') {
            $code = $this->getNsCode($docs['xmlNamespace']);
            $el = $this->dom->createElement($code.":".$docs['xmlName']);
            if (is_object($docs['value'])) {
                $el = $this->parseObjectValue($docs['value'], $el);
            } else {
                if (is_string($docs['value'])) {
                    $code = $this->getNsCode($docs['xmlNamespace']);
                    $el = $this->dom->createElement($code.":".$docs['xmlName'], $docs['value']);
                }
                
            }
            
            $dom->appendChild($el);
        }
    }
    
    private function parseArrayValue($arr, $element) {
        if (!is_array($arr) || count($arr) == 0) {
            return;
        }
        //$el = '';
        foreach ($arr as $key => $value) {
            if (is_string($value)) {
                //$el =
                //@todo is this case possible? 
            }
            if (is_object($value)) {
                $name = array_reverse(explode("\\",get_class($value)));
                //$this->logger = \Zend_Registry::get('logger');
                //$this->logger->debug(print_r($name[0], true));
                //$el = $this->dom->createElement($name[0]);
                $element = $this->parseObjectValue($value, $element); 
            }
            
            if (is_array($value)) {
                //@todo implement and test on  multi level arrays
            }
           // if value string = append child
           // if value array = parse array value
           // if value object = parseObjectValue
           //$element->appendChild($el);         
        }
        
        return $element;
    }
    
    private function parseObjectValue($obj, $element) {
        
        $refl = new \ReflectionClass($obj);
        
        $classDocs  = $this->parseDocComments($refl->getDocComment());
        $classProps = $refl->getProperties(); 
        $namespace = $classDocs['xmlNamespace'];
        
        foreach($classProps as $prop) {
            $propDocs = $this->parseDocComments($prop->getDocComment());
            //print('Value:');
            //print_r($prop->getValue($refl));
            if (is_object($prop->getValue($obj))) {
                
                /*
                $code = '';
                if (is_object($this->root)) {
                    $code = $this->getNsCode($docs['xmlNamespace']);
                    $root = $this->dom->createElementNS($docs['xmlNamespace'], $code.":".$docs['xmlName']);
                } else {
                    $root = $this->dom->createElementNS($docs['xmlNamespace'], $docs['xmlName']);
                }*/
                
                //$el = '';
                //if ($namespace != '') {
                $code = $this->getNsCode($namespace);
                $el = $this->dom->createElement($code.":".$propDocs['xmlName']); 
                $el = $this->parseObjectValue($prop->getValue($obj), $el);
                $element->appendChild($el);
            } else {
                if ($prop->getValue($obj) != '') {
                    if ($propDocs['xmlType'] == 'element') {
                        $el = '';
                        
                        $code = $this->getNsCode($namespace);
                        $el = $this->dom->createElement($code.":".$propDocs['xmlName'], $prop->getValue($obj));
                        //}
                        $element->appendChild($el);
                    } elseif ($propDocs['xmlType'] == 'attribute') {
                        $atr = $this->dom->createAttribute($propDocs['xmlName']);
                        $text = $this->dom->createTextNode($prop->getValue($obj));
                        $atr->appendChild($text);
                        $element->appendChild($atr);
                    } elseif ($propDocs['xmlType'] == 'value') {
                        $txtNode = $this->dom->createTextNode($prop->getValue($obj));
                        $element->appendChild($txtNode);
                    } 
                }
            }
        }
        
        return $element;
    }
    
    
    
    
    
}