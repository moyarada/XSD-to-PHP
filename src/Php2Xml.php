<?php
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

/**
 * PHP to XML converter
 * 
 * @author Mike Bevz <myb@mikebevz.com>
 * @version 0.0.1
 */
class Php2Xml {
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
        //Analyze class
        //Convert XML code
        //Save XML to file
    }
    
    public function getXml($phpClass = null) {
        if ($this->phpClass == null && $phpClass == null) {
            throw new RuntimeException("Php class is not set");
        }
        
        if ($phpClass != null) {
            $this->phpClass = $phpClass;
        }
        
        $xml = "XML";
        
        $refl = new ReflectionClass($this->phpClass);
        //$refl->getProperty('ds')->getValue();
        $classDocs = $this->parseDocComments($refl->getDocComment());
        
        $this->addRoot($classDocs);
        
        $properties = $refl->getProperties();
        
        $propDocs = array();
        foreach ($properties as $prop) {
            $pDocs = $this->parseDocComments($prop->getDocComment());
            $propDocs[$prop->getName()] = $pDocs;
            $propDocs[$prop->getName()]['value'] = $prop->getValue($this->phpClass);
        }
        
        foreach ($propDocs as $data) {
            $this->addProperty($data);
        }
        
        //print_r($propDocs);
        return $this->dom->saveXML();
        
    }
    
    private function buildXml() {
        $this->dom = new DOMDocument('1.0', 'UTF-8');
        $this->dom->formatOutput = true;
        
    }
    
    private function addRoot($docs) {
        $this->root = $this->dom->createElementNS($docs['xmlNamespace'], $docs['xmlName']);
        $this->dom->appendChild($this->root);
        //$this->dom->createAttributeNS();
    } 
    
    private function addProperty($docs) {
        if ($docs['value'] != '') {
            
            $el = $this->dom->createElement($docs['xmlName']);
            if (is_object($docs['value'])) {
                $el = $this->parseObjectValue($docs['value'], $el);
            } else {
                $el = $this->dom->createElement($docs['xmlName'], $docs['value']);
            }
            
            $this->root->appendChild($el);
        }
    }
    
    private function parseObjectValue($obj, $element) {
        
        $refl = new ReflectionClass($obj);
        
        $classDocs  = $this->parseDocComments($refl->getDocComment());
        $classProps = $refl->getProperties(); 
        $namespace = $classDocs['xmlNamespace'];
        
        foreach($classProps as $prop) {
            //print_r($prop->getValue($obj));
            $propDocs = $this->parseDocComments($prop->getDocComment());
            //print('Value:');
            //print_r($prop->getValue($refl));
            if (is_object($prop->getValue($obj))) {
                $el = $this->dom->createElementNS($namespace, $propDocs['xmlName']);
                $el = $this->parseObjectValue($prop->getValue($obj), $el);
                $element->appendChild($el);
            } else {
                if ($prop->getValue($obj) != '') {
                    if ($propDocs['xmlType'] == 'element') {
                        $el = $this->dom->createElementNS($propDocs['xmlNamespace'], $propDocs['xmlName'], $prop->getValue($obj));
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
    
    
    
    private function parseDocComments($comments) {
        $comments = explode("\n", $comments);
        $commentsOut = array();
        foreach ($comments as $com) {
            if (preg_match('/@/', $com)) {
                $com = preg_replace('/\* /', '', $com);
                $com = preg_replace('/@([a-zA-Z]*)( *)(.*)/', '$1|$3', $com);
                $com = explode('|', $com);
                //$arr = array();
                $commentsOut[trim($com[0])] = trim($com[1]);
                //array_push($commentsOut, array($com[0] => $com[1]));
            }
        }
        
        return $commentsOut;
    }
    
}