<?php
/**
 * Generate PHP classes based on XSD schema
 * 
 * @author Mike Bevz <myb@mikebevz.com>
 * @version 0.0.1
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
            LIBXML_DTDLOAD | LIBXML_DTDATTR |
                 LIBXML_NOENT |
                 LIBXML_XINCLUDE);
                 
        $this->xpath = new DOMXPath($this->dom);         
        
        $query = "//namespace::*";
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
       
        
        // Read file
        // Apply XSLT
        // Generate XML
        // Generate classes from XML
    }
    
    /**
     * Recursive method adding imports and includes
     * 
     * @param string $xsdFile
     * @param DOMDocument $domNode
     * @param $domRef 
     */
    public function loadImports($xsdFile, $domNode, $domRef = null) {
        
        print_r("Start: \n xsdFileName=". $xsdFile."\n");
        //print_r("domNode:".is_object($domNode)."\n"); 
        // load includes
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
                
                //print_r("xsdFileName=". $xsdFileName."\n");
                //print_r("domNode:".is_object($domNode)."\n");
                //print_r("xsd:".is_object($xsd)."\n");         
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
              // print_r("Length:".$imports->length." ".$xsdFileName." \n");
                        
                if ($imports->length != 0) {
                    
                   $domRef = $this->loadImports($xsdFileName, $xsd, $domRef);
                } 
                
            }
            
            print_r("Return node $xsdFile\n");
            return $domRef;
    }
    
    public function importIncludes($xsdFile, $domNode, $domRef = null) {
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
            print_r('Import include '.$xsdFileName."\n");
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
              // print_r("Length:".$imports->length." ".$xsdFileName." \n");
                        
                if ($imports->length != 0) {
                    
                   $domRef = $this->importIncludes($xsdFileName, $xsd, $domRef);
                }
            
        }
        print_r("Return node $xsdFile\n");
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
     * @param $xmlForPhp the $xmlForPhp to set
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
            $xsl = new XSLTProcessor();
            $xslDom = new DOMDocument();
            $xslDom->load(dirname(__FILE__) . "/xsd2php2.xsl");
            $xsl->registerPHPFunctions();
            $xsl->importStyleSheet($xslDom);
            $this->dom = $xsl->transformToDoc($this->dom);
            $this->dom->formatOutput = true;
            
            //@todo expand short namespace to long ones
            return $this->dom;
            
        } catch (Exception $e) {
            throw new Exception(
                "Error interpreting XSD document (" .
                     $e->getMessage() .
                     ")");
        }
    }
    
    /**
     * Save PHP files to directory structure 
     * 
     * @param string $dir Directory to save files to
     * 
     * @return void
     * 
     * @throws RuntimeException if given directory is not exist
     */
    public function savePhpFiles($dir) {
        if (!file_exists($dir)) {
            throw new RuntimeException($dir." does not exist");
        }
        
        $classes = $this->getPHP();
        
        foreach ($classes as $fullkey => $value) {
            // @todo save file to directories according to namespace
            
            $keys = explode("|", $fullkey);
            
            $key = $keys[0];
            
            $namespace = $this->namespaceToPath($keys[1]);//$this->namespaceToPath($this->namespaces[$key]); //@todo Parse namespace and create directories iteratively 
            
            $targetDir = $dir.DIRECTORY_SEPARATOR.$namespace;
            if (!file_exists($targetDir)) {
                mkdir($targetDir, 0777, true);
            }
            print_r($targetDir."\n");
            file_put_contents($targetDir.DIRECTORY_SEPARATOR.$key.'.php', $value);
        }
    }
    
    /**
     * Return generated PHP source code
     * 
     * @return string
     */
    public function getPHP() {
        $phpfile = $this->getXmlForPhp();
        if ($phpfile == '') {
            throw new RuntimeException('There is no XML file generated');
        }
        
        $dom = new DOMDocument();
        $dom->load($phpfile, LIBXML_DTDLOAD | LIBXML_DTDATTR |
                 LIBXML_NOENT | LIBXML_XINCLUDE);
        
                 
        $xPath = new DOMXPath($dom);         
                 
        $classes = $xPath->query('//classes/class');
        
        $sourceCode = array();//"<?php \n";
        //print_r($classes);
        foreach ($classes as $class) {
            
            $phpClass = new PHPClass();
            $phpClass->name = $class->getAttribute('name');
            if ($phpClass->name == 'QuantityType') {
                print('Type='.$class->getAttribute('type'));
                print('Namespace='.$class->getAttribute('namespace'));
            }
            
            if ($class->getAttribute('type') != '') {
                $phpClass->type = $class->getAttribute('type');
            }
            
            if ($class->getAttribute('simpleType') != '') {
                $phpClass->type = $class->getAttribute('simpleType');
            }
            
            $phpClass->namespace = $class->getAttribute('namespace');
            
            if ($class->getElementsByTagName('extends')->length > 0) {
                $phpClass->extends = $class->getElementsByTagName('extends')->item(0)->getAttribute('name');
                $phpClass->type = $class->getElementsByTagName('extends')->item(0)->getAttribute('name');
                $phpClass->extendsNamespace = $this->namespaceToPhp($class->getElementsByTagName('extends')->item(0)->getAttribute('namespace'));
                //($phpClass->extendsNamespace."\n");
                
            }
            
            $docs = $xPath->query('docs/doc', $class);
            $docBlock = array();
            $docBlock['xmlNamespace'] = $this->expandNS($phpClass->namespace);
            $docBlock['xmlType'] = $phpClass->type;
            $docBlock['xmlName'] = $phpClass->name;
            //@todo What is we have two classes with equal name?
            $this->namespaces[$phpClass->name] = $phpClass->namespace;
            
            foreach ($docs as $doc) {
                if ($doc->nodeValue != '') {
                    $docBlock["xml".$doc->getAttribute('name')] = $doc->nodeValue;
                } elseif ($doc->getAttribute('value') != '') {
                    $docBlock["xml".$doc->getAttribute('name')] = $doc->getAttribute('value');
                }    
            }
            
            $phpClass->classDocBlock = $docBlock;
            
            $props = $xPath->query('property', $class);
            $properties = array();
            $i = 0;
            foreach($props as $prop) {
                $properties[$i]['name'] = $prop->getAttribute('name');
                //$properties[$i]['docs'] = ;
               $docs = $xPath->query('docs/doc', $prop);
               foreach ($docs as $doc) {
                    $properties[$i]["docs"][$doc->getAttribute('name')] = $doc->nodeValue;
               } 
               $properties[$i]["docs"]['xmlType'] = $prop->getAttribute('xmlType');
               $properties[$i]["docs"]['xmlNamespace'] = $this->expandNS($prop->getAttribute('namespace'));
               $properties[$i]["docs"]['xmlMinOccurs'] = $prop->getAttribute('minOccurs');
               $properties[$i]["docs"]['xmlMaxOccurs'] = $prop->getAttribute('maxOccurs');
               $properties[$i]["docs"]['xmlName'] = $prop->getAttribute('name');
               $properties[$i]["docs"]['var'] = $prop->getAttribute('type');
               $i++;
            }
            
            $phpClass->classProperties = $properties;
            $namespaceClause = "namespace ".$this->namespaceToPhp($docBlock['xmlNamespace']).";\n";
            $sourceCode[$docBlock['xmlName']."|".$phpClass->namespace] = "<?php\n".
                $namespaceClause.
                $phpClass->getPhpCode();
            
            // type="RelatedItemType" namespace="urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2"
            
        // For each class - generate class
        // Generate docBlocks
        //   -- generate properties
        //   -- generate restrictions  
        }         
                 
        return $sourceCode; 
     }
     
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
      * @param string $xmlNS XML URI
      */
     public function namespaceToPhp($xmlNS) {
         $ns = $xmlNS;
         
         $ns = $this->expandNS($ns);
         
         
         if (preg_match('/urn:/',$ns)) {
            //@todo check if there are any components of namespace which are
            // - php keywords
            // - numbers
            // - special symbols 
            $ns = preg_replace('/-/', '_',$ns);
            $ns = preg_replace('/urn:/', '', $ns);
            $ns = preg_replace('/:/','\\', $ns);
         }
         
         $ns = explode('\\', $ns);
         $i = 0;
         foreach($ns as $elem) {
            //@todo check if elem is only a number of a keyword
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
     public function namespaceToPath($xmlNS) {
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
            //@todo check if elem is only a number of a keyword
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

/**
 * PHP Class representation
 * 
 * @author Mike Bevz <myb@mikebevz.com>
 *
 */
class PHPClass {
    /**
     * 
     * @var class name
     */
    public $name;
    
    /**
     * Array of class level documentation
     * @var array
     */
    public $classDocBlock;
    
    public $type;
    
    public $namespace;
    
    public $classProperties;
    
    public $extends;
    
    public $extendsNamespace;
    
    /**
     * Array of class properties  arry(array('name'=>'propertyName', 'docs' => array('property'=>'value')))
     * @var array
     */
    public $properties;
    
    private $basicTypes = array('decimal', 'base64Binary', 'normalizedString', 'dateTime', 'date', 'boolean',
                            'string', 'time');
    
    
    public function getPhpCode() {
        $code = "\n";
        //$code .= 'if (!class_exists("'.$this->name.'")) {'."\n";
        if ($this->extendsNamespace != '') {
            $code .= "use ".$this->extendsNamespace.";\n";
            //print($this->extendsNamespace."\n");
        }
        
        if (!empty($this->classDocBlock)) {
            $code .= $this->getDocBlock($this->classDocBlock);
        }
        
        $code .= 'class '.$this->name."\n";
        if ($this->extends != '') {
            if ($this->extendsNamespace != '') {
                $nsLastName = array_reverse(explode('\\', $this->extendsNamespace));
                $code .= "\t".'extends '.$nsLastName[0].'\\'.$this->extends."\n";
            
            } else {
                $code .= "\t".'extends '.$this->extends."\n";
            }
        }
        $code .= "\t".'{'."\n";
        $code .= ''."\n";
        if (in_array($this->type, $this->basicTypes)) {
            $code .= "\t\t".$this->getDocBlock(array('xmlType'=>'value', 'var' => $this->type), "\t\t");
            $code .= "\t\tpublic ".'$value;';
        }
        
        if (!empty($this->classProperties)) {
            $code .= $this->getClassProperties($this->classProperties);
        }
        
        $code .= ''."\n";
        $code .= ''."\n";
        $code .= '} // end class '.$this->name."\n";
        
        //$code .= ''."\n";    
        //$code .= '}'."\n";
        
        return $code;
    }   
    
    public function getClassProperties($props, $indent = "\t") {
        $code = $indent."\n";
        
        foreach ($props as $prop) {
            
            if (!empty($prop['docs'])) {
                $code .= $indent.$this->getDocBlock($prop['docs'], $indent);
            }
            $code .= $indent.'public $'.$prop['name'].";\n";
        
        }
        
        return $code;
        
    }
    
    /**
     * Return docBlock
     * 
     * @param array  $docs  
     * @param string $indent 
     */
    public function getDocBlock($docs, $indent = "") {
        
        $code  = '/**'."\n";
        
        foreach ($docs as $key => $value) {
            $code .= $indent.' * @'.$key.' '.$value."\n";
        }
        
        $code .= $indent.' */'."\n";
        
        return $code; 
    }
        
}