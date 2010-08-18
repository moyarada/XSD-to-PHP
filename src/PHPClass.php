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
 * PHP Class representation
 * 
 * @author Mike Bevz <myb@mikebevz.com>
 * @version 0.0.1
 * 
 */
class PHPClass extends Common {
    /**
     * Class name
     * 
     * @var class name
     */
    public $name;
    
    /**
     * Array of class level documentation
     * 
     * @var array
     */
    public $classDocBlock;
    
    /**
     * Class type
     * 
     * @var string
     */
    public $type;
    
    /**
     * Class namespace
     * @var string
     */
    public $namespace;
    
    /**
     * Class properties
     * 
     * @var array
     */
    public $classProperties;
    
    /**
     * Class to extend
     * @var string
     */
    public $extends;
    
    /**
     * Namespace of parent class
     * @var string
     */
    public $extendsNamespace;
    
    /**
     * Array of class properties  array(array('name'=>'propertyName', 'docs' => array('property'=>'value')))
     * @var array
     */
    public $properties;
    
    /**
     * Show debug info
     * @var boolean
     */
    public $debug = false;
    /**
     * Returns array of PHP classes
     * 
     * @return array 
     */
    public function getPhpCode() {
        $code = "\n";
        if ($this->extendsNamespace != '') {
            $code .= "use ".$this->extendsNamespace.";\n";
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
        return $code;
    }   

    /**
     * Return class properties from array with indent specified
     * 
     * @param array $props  Properties array
     * @param array $indent Indentation in tabs
     * 
     * @return string
     */
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
     * @param array  $docs   Array of docs
     * @param string $indent Indentation
     * 
     * return string
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