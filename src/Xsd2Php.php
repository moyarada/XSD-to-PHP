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

require_once 'PHPClass.php';
 
 /** 
 * Generate PHP classes based on XSD schema
 * 
 * @author Mike Bevz <myb@mikebevz.com>
 * @version 0.0.1
 * 
 */
class Xsd2Php
{
    /**
     * XSD schema to convert from
     * @var String
     */
    private $xsdFile;
    
    /**
     * 
     * @var DOMDocument
     */
    private $dom;
    
    /**
     * 
     * @var DOMXPath
     */
    private $xpath;
    
    /**
     * Namespaces in the current xsd schema
     * @var array
     */
    private $nspace;
    
    /**
     * XML file suitable for PHP code generation
     * @var string
     */
    private $xmlForPhp;
    
    /**
     * Namespaces = array (className => namespace ), used in dirs/files generation 
     * @var array
     */
    private $namespaces;
    
    private $shortNamespaces;
    
    private $xmlSource;
    
    private $reservedWords = array (
        'and', 'or', 'xor', '__FILE__', 'exception',
        '__LINE__', 'array', 'as', 'break', 'case',
        'class', 'const', 'continue', 'declare', 'default',
        'die', 'do', 'echo', 'else', 'elseif',
        'empty', 'enddeclare', 'endfor', 'endforeach', 'endif',
        'endswitch', 'endwhile', 'eval', 'exit', 'extends',
        'for', 'foreach', 'function', 'global', 'if',
        'include', 'include_once', 'isset', 'list', 'new',
        'print', 'require', 'require_once', 'return', 'static',
        'switch', 'unset', 'use', 'var', 'while', 
        '__FUNCTION__', '__CLASS__', '__METHOD__', 'final', 'php_user_filter',
        'interface', 'implements', 'instanceof', 'public', 'private',
        'protected', 'abstract', 'clone', 'try', 'catch',
        'throw', 'this', 'final', '__NAMESPACE__', 'namespace', 'goto',
        '__DIR__'
    );
    
    
    /**
     * XSD schema converted to XML
     * @return string $xmlSource
     */
    public function getXmlSource()
    {
        return $this->xmlSource;
    }

	/**
	 * 
     * @param string $xmlSource XML Source
     */
    public function setXmlSource($xmlSource)
    {
        $this->xmlSource = $xmlSource;
    }
    
    /**
     * 
     * @param string $xsdFile Xsd file to convert
     * 
     * @return void
     */
	public function __construct($xsdFile)
    {
        
        $this->xsdFile = $xsdFile;
        
        $this->dom = new DOMDocument();
        $this->dom->load($this->xsdFile, 
                         LIBXML_DTDLOAD | 
                         LIBXML_DTDATTR |
                         LIBXML_NOENT |
                         LIBXML_XINCLUDE);
                 
        $this->xpath = new DOMXPath($this->dom);         
        
        $query   = "//namespace::*";
        $entries =  $this->xpath->query($query);
        $nspaces = array();
        foreach ($entries as $entry) {
            if ($entry->nodeName != 'xmlns:xsd' 
                && $entry->nodeName != 'xmlns:xml')  {
                    if (preg_match('/:/', $entry->nodeName)) {
                        $nodeName = explode(':', $entry->nodeName); 
                        $nspaces[$nodeName[1]] = $entry->nodeValue;
                    
                    } else {
                        $nspaces[$entry->nodeName] = $entry->nodeValue;
                    }
            }

        }
        
        $this->shortNamespaces = $nspaces;
        $this->dom = $this->loadImports($this->xsdFile, $this->dom);
    }
    
    /**
     * Save generated classes to directory
     * @param string  $dir             Directory to save classes to
     * @param boolean $createDirectory Create directory, false by default
     * 
     * @return void
     */
    public function saveClasses($dir, $createDirectory) {
        $this->setXmlSource($this->getXML()->saveXML());
        $this->savePhpFiles($dir, $createDirectory);
    }
    
    /**
     * Recursive method adding imports and includes
     * 
     * @param string      $xsdFile Path to XSD Schema filename
     * @param DOMDocument $domNode 
     * @param DOMDocument $domRef 
     */
    private function loadImports($xsdFile, $domNode, $domRef = null) {
        
        if (is_null($domRef)) {
            $domRef = $domNode;
        }
        
        $xpath = new DOMXPath($domNode);
        
        $query = "//*[local-name()='import' and namespace-uri()='http://www.w3.org/2001/XMLSchema']";
        $entries = $xpath->query($query);
            foreach ($entries as $entry) {
                $namespace = $entry->getAttribute('namespace');
                $parent = $entry->parentNode;
                $xsd = new DOMDocument();
                
                $xsdFileName = realpath(dirname($xsdFile) . "/" . $entry->getAttribute("schemaLocation"));
                if (!file_exists($xsdFileName)) {
                    print_r('File '.$xsdFileName. "does not exist"."\n");
                    continue;
                }
                $result = $xsd->load($xsdFileName, 
                                LIBXML_DTDLOAD|LIBXML_DTDATTR|LIBXML_NOENT|LIBXML_XINCLUDE);
                
                if ($result) {
                        $xsd = $this->importIncludes($xsdFileName, $xsd);
                        foreach ($xsd->documentElement->childNodes as $node) {
                            
                            $newNodeNs = $domNode->createAttribute("namespace");
                            $textEl = $domNode->createTextNode($namespace);
                            $newNodeNs->appendChild($textEl);

                            $newNode = $domNode->importNode($node, true);
                            $newNode->appendChild($newNodeNs); 
                            $parent->insertBefore($newNode, $entry);
                        }
                        $parent->removeChild($entry);
                  
                }
                
                $xpath = new DOMXPath($xsd);
                $query = "//*[local-name()='import' and namespace-uri()='http://www.w3.org/2001/XMLSchema']";
                $imports = $xpath->query($query);
                if ($imports->length != 0) {
                   $domRef = $this->loadImports($xsdFileName, $xsd, $domRef);
                } 
                
            }
            
            return $domRef;
    }
    
    /**
     * Recursive import of includes
     * 
     * @param string      $xsdFile Path to XSD file
     * @param DOMDocument $domNode DOM document
     * @param DOMDocument $domRef  Used only recursivelly
     */
    private function importIncludes($xsdFile, $domNode, $domRef = null) {
        /**
         * Import includes, because it's not always correctly processed 
         * @see http://www.mail-archive.com/php-bugs@lists.php.net/msg102950.html
         */
        if (is_null($domRef)) {
            $domRef = $domNode;
        }

        $xpath = new DOMXPath($domNode);    
        $query = "//*[local-name()='include' and namespace-uri()='http://www.w3.org/2001/XMLSchema']";
        $includes = $xpath->query($query);
        
        foreach ($includes as $include) {
            $parent = $include->parentNode;
            //$namespace = $include->parentNode;
            $xsd = new DOMDocument();
            
            $xsdFileName = realpath(dirname($xsdFile) . "/" . $include->getAttribute("schemaLocation"));
            print_r('Importing schema '.$xsdFileName."\n");
            if (!file_exists($xsdFileName)) {
                print_r('Include File '.$xsdFileName. "does not exist"."\n");
                continue;
            }
            $result = $xsd->load($xsdFileName, 
                                LIBXML_DTDLOAD|LIBXML_DTDATTR|LIBXML_NOENT|LIBXML_XINCLUDE);
                               
            if ($result) {
                foreach ($xsd->documentElement->childNodes as $node) {
                    $newNode = $domNode->importNode($node, true);
                    $parent->insertBefore($newNode, $include);
                }
                $parent->removeChild($include);
            } 

            $xpath = new DOMXPath($xsd);
            $query = "//*[local-name()='import' and namespace-uri()='http://www.w3.org/2001/XMLSchema']";
            $imports = $xpath->query($query);
                    
            if ($imports->length != 0) {
               $domRef = $this->importIncludes($xsdFileName, $xsd, $domRef);
            }
            
        }
        print("Processed schema $xsdFile\n");
        return $domRef;
    }
    
    /**
     * Convert XSD to XML suitable for PHP code generation
     * 
     * @return string
     */
    public function getXmlForPhp()
    {
        return $this->xmlForPhp;
    }

	/**
     * @param string $xmlForPhp XML
     * 
     * @return void
     */
    public function setXmlForPhp($xmlForPhp)
    {
        $this->xmlForPhp = $xmlForPhp;
    }
    
    /**
     * Convert XSD to XML suitable for further processing
     * 
     * @return string XML string
     */
	public function getXML()
    {
        try {
            $xsl    = new XSLTProcessor();
            $xslDom = new DOMDocument();
            $xslDom->load(dirname(__FILE__) . "/xsd2php2.xsl");
            $xsl->registerPHPFunctions();
            $xsl->importStyleSheet($xslDom);
            $this->dom = $xsl->transformToDoc($this->dom);
            $this->dom->formatOutput = true;

            return $this->dom;
            
        } catch (Exception $e) {
            throw new Exception(
                "Error interpreting XSD document (".$e->getMessage().")");
        }
    }
    
    /**
     * Save PHP files to directory structure 
     * 
     * @param string $dir Directory to save files to
     * 
     * @return void
     * 
     * @throws RuntimeException if given directory does not exist
     */
    private function savePhpFiles($dir, $createDirectory = false) {
        if (!file_exists($dir) && $createDirectory === false) {
            throw new RuntimeException($dir." does not exist");
        }
        
        if (!file_exists($dir) && $createDirectory === true) {
            mkdir($dir, 0777, true);
        }
        
        $classes = $this->getPHP();
        
        foreach ($classes as $fullkey => $value) {
            $keys = explode("|", $fullkey);
            $key = $keys[0];
            $namespace = $this->namespaceToPath($keys[1]); 
            $targetDir = $dir.DIRECTORY_SEPARATOR.$namespace;
            if (!file_exists($targetDir)) {
                mkdir($targetDir, 0777, true);
            }
            file_put_contents($targetDir.DIRECTORY_SEPARATOR.$key.'.php', $value);
        }
        echo "Generated classes saved to ".$dir;
    }
    
    /**
     * Return generated PHP source code
     * 
     * @return string
     */
    private function getPHP() {
        $phpfile = $this->getXmlForPhp();
        if ($phpfile == '' && $this->getXmlSource() == '') {
            throw new RuntimeException('There is no XML generated');
        }
        
        $dom = new DOMDocument();
        if ($this->getXmlSource() != '') {
            $dom->loadXML($this->getXmlSource(), LIBXML_DTDLOAD | LIBXML_DTDATTR |
                 LIBXML_NOENT | LIBXML_XINCLUDE);
        } else {
            $dom->load($phpfile, LIBXML_DTDLOAD | LIBXML_DTDATTR |
                 LIBXML_NOENT | LIBXML_XINCLUDE);
        }
                 
        $xPath = new DOMXPath($dom);         
                 
        $classes = $xPath->query('//classes/class');
        
        $sourceCode = array();
        foreach ($classes as $class) {
            
            $phpClass = new PHPClass();
            $phpClass->name = $class->getAttribute('name');
            
            if ($class->getAttribute('type') != '') {
                $phpClass->type = $class->getAttribute('type');
            }
            
            if ($class->getAttribute('simpleType') != '') {
                $phpClass->type = $class->getAttribute('simpleType');
            }
            
            $phpClass->namespace = $class->getAttribute('namespace');
            
            if ($class->getElementsByTagName('extends')->length > 0) {
                $phpClass->extends = $class->getElementsByTagName('extends')->item(0)->getAttribute('name');
                $phpClass->type    = $class->getElementsByTagName('extends')->item(0)->getAttribute('name');
                $phpClass->extendsNamespace = $this->namespaceToPhp($class->getElementsByTagName('extends')->item(0)->getAttribute('namespace'));
            }
            
            $docs = $xPath->query('docs/doc', $class);
            $docBlock = array();
            $docBlock['xmlNamespace'] = $this->expandNS($phpClass->namespace);
            $docBlock['xmlType']      = $phpClass->type;
            $docBlock['xmlName']      = $phpClass->name;
            
            foreach ($docs as $doc) {
                if ($doc->nodeValue != '') {
                    $docBlock["xml".$doc->getAttribute('name')] = $doc->nodeValue;
                } elseif ($doc->getAttribute('value') != '') {
                    $docBlock["xml".$doc->getAttribute('name')] = $doc->getAttribute('value');
                }    
            }
            
            $phpClass->classDocBlock = $docBlock;
            
            $props      = $xPath->query('property', $class);
            $properties = array();
            $i = 0;
            foreach($props as $prop) {
                $properties[$i]['name'] = $prop->getAttribute('name');
                $docs                   = $xPath->query('docs/doc', $prop);
                foreach ($docs as $doc) {
                    $properties[$i]["docs"][$doc->getAttribute('name')] = $doc->nodeValue;
                } 
                $properties[$i]["docs"]['xmlType']      = $prop->getAttribute('xmlType');
                $properties[$i]["docs"]['xmlNamespace'] = $this->expandNS($prop->getAttribute('namespace'));
                $properties[$i]["docs"]['xmlMinOccurs'] = $prop->getAttribute('minOccurs');
                $properties[$i]["docs"]['xmlMaxOccurs'] = $prop->getAttribute('maxOccurs');
                $properties[$i]["docs"]['xmlName']      = $prop->getAttribute('name');
                $properties[$i]["docs"]['var']          = $prop->getAttribute('type');
                $i++;
            }
            
            $phpClass->classProperties = $properties;
            $namespaceClause           = "namespace ".$this->namespaceToPhp($docBlock['xmlNamespace']).";\n";
            $sourceCode[$docBlock['xmlName']."|".$phpClass->namespace] = "<?php\n".
                $namespaceClause.
                $phpClass->getPhpCode();
        }         
        return $sourceCode; 
     }

    /**
     * Resolve short namespace 
     * @param string $ns Short namespace 
     * 
     * @return string
     */    
    private function expandNS($ns) {
        foreach($this->shortNamespaces as $shortNs => $longNs) {
           if ($ns == $shortNs) {
               $ns = $longNs;
           }
        }
        return $ns;  
    }
     
     /**
      * Convert XML URI to PHP complient namespace
      * 
      * @param string $xmlNS XML URI
      * 
      * @return string
      */
     private function namespaceToPhp($xmlNS) {
         $ns = $xmlNS;
         $ns = $this->expandNS($ns);
         if (preg_match('/urn:/',$ns)) {
            //@todo check if there are any components of namespace which are
            $ns = preg_replace('/-/', '_',$ns);
            $ns = preg_replace('/urn:/', '', $ns);
            $ns = preg_replace('/:/','\\', $ns);
         }
         
         $ns = explode('\\', $ns);
         $i = 0;
         foreach($ns as $elem) {
            if (preg_match('/^[0-9]$/', $elem)) {
                $ns[$i] = "_".$elem;
            }
            
            if (in_array($elem, $this->reservedWords)) {
                $ns[$i] = "_".$elem;
            } 
            $i++;
         }
        
         $ns = implode('\\', $ns);
         
         return $ns; 
     }
     
     /**
      * Convert XML URI to Path
      * @param string $xmlNS XML URI
      * 
      * @return string
      */
     private function namespaceToPath($xmlNS) {
        $ns = $xmlNS;
        $ns = $this->expandNS($ns);
        
        if (preg_match('/urn:/', $ns)) {
            $ns = preg_replace('/-/', '_', $ns);
            $ns = preg_replace('/urn:/', '', $ns);
            $ns = preg_replace('/:/', DIRECTORY_SEPARATOR, $ns);
        }
        $ns = explode(DIRECTORY_SEPARATOR, $ns);
        $i = 0;
        foreach($ns as $elem) {
            if (preg_match('/^[0-9]$/', $elem)) {
                $ns[$i] = "_".$elem;
            }
            if (in_array($elem, $this->reservedWords)) {
                $ns[$i] = "_".$elem;
            } 
            $i++;
        }
        $ns = implode(DIRECTORY_SEPARATOR, $ns);
        return $ns;
     }
}