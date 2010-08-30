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
require_once 'Common.php';

/**
 * Bind XML to PHP models
 * 
 * @author Mike Bevz <myb@mikebevz.com>
 * @version 0.0.1
 */
class Bind extends Common {
    
    /**
     * Bind XML file to model
     * @param string $xml   XML source
     * @param object $model PHP Model to bind to
     * 
     * @return object PHP model
     */
    public function bindXml($xml, $model) {
        
        $refl = new \ReflectionClass($model);
        $dom = new \DOMDocument();
        $dom->formatOutput = true;
        $dom->loadXML($xml);
        $xpath = new \DOMXPath($dom);
        
        $query = "self::*";
        $root = $xpath->query($query);
        $rootName = $root->item(0)->nodeName;
        if (get_class($model) != $rootName) {
            throw new \RuntimeException("XML file does not correspond to given model (model=".get_class($model)."; xml root=".$rootName);
        } 
        
        $query = "child::*";
        $childs = $xpath->query($query);
        
        foreach ($childs as $child) {
            //print_r($child->nodeName."\n");
            if ($this->hasChild($child)) {
                if (property_exists($model, $child->nodeName)) {
                    $model->{$child->nodeName} = $this->bindXMlRec($child, $dom, $child->nodeName);
                }
                
            } else {
                if (!property_exists($model, $child->nodeName)) {
                    throw new \RuntimeException("Model does not have property ".$child->nodeName);
                }
                if (!class_exists($child->nodeName)) {
                    $propertyDocs = $refl->getProperty($child->nodeName)->getDocComment();
                    $docs = $this->parseDocComments($propertyDocs);
                    $type = $docs['xmlType'];
                    if ($type == 'attribute') {
                        $model->{$child->nodeName} = $child->nodeValue;      
                    } else {
                    //print_r($propertyType);
                     throw new \RuntimeException('Class '.$child->nodeName.' does not exist');
                    }
                } else {
                    $name = $child->nodeName;
                    $cModel = new $name();
                    $cModel->value = $child->nodeValue;
                    $model->{$child->nodeName} = $cModel;
                }
                //print_r($child->nodeValue);
            }
        }
        
        
        return $model;
    }
    
    private function hasChild($node) {
        if ($node->hasChildNodes()) {
          foreach ($node->childNodes as $c) {
           if ($c->nodeType == XML_ELEMENT_NODE)
            return true;
          }
         }
         return false;
    }
    
    public function bindXmlRec($node, $dom, $modelName) {
        $model = '';
        if (class_exists($modelName)) {
            $model = new $modelName();
        } else {
            throw new \RuntimeException('Class '.$modelName.' does not exist');
        }
        
        $refl = new \ReflectionClass($model);
        
        $xpath = new \DOMXPath($dom);
        $query = "child::*";
        $childs = $xpath->query($query, $node);
        foreach ($childs as $child) {
            if ($this->hasChild($child)) {
             if (property_exists($model, $child->nodeName)) {
                    $model->{$child->nodeName} = $this->bindXMlRec($child, $dom, $child->nodeName);
                }
            } else {
                if (!property_exists($model, $child->nodeName)) {
                    throw new \RuntimeException("Model does not have property ".$child->nodeName);
                }
               if (!class_exists($child->nodeName)) {
                    $propertyDocs = $refl->getProperty($child->nodeName)->getDocComment();
                    $docs = $this->parseDocComments($propertyDocs);
                    $type = $docs['xmlType'];
                    if ($type == 'attribute') {
                        $model->{$child->nodeName} = $child->nodeValue;      
                    } else {
                    //print_r($propertyType);
                     throw new \RuntimeException('Class '.$child->nodeName.' does not exist');
                    }
                } else {
                    $name = $child->nodeName;
                    $cModel = new $name();
                    $cModel->value = $child->nodeValue;
                    $model->{$child->nodeName} = $cModel;
                }
            }
        }
        
        return $model;
        
    }
    
    
}