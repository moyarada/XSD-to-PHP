<?php
namespace oasis\names\specification\ubl\schema\xsd\CommonExtensionComponents_2;

/**
 * @xmlNamespace urn:oasis:names:specification:ubl:schema:xsd:CommonExtensionComponents-2
 * @xmlType 
 * @xmlName UBLExtensionsType
 * @xmlDefinition 
        A container for all extensions present in the document.
      
 */
class UBLExtensionsType
	{

	
	/**
	 * @Definition 
            A single extension for private use.
          
	 * @xmlType element
	 * @xmlNamespace 
	 * @xmlMinOccurs 1
	 * @xmlMaxOccurs unbounded
	 * @xmlName UBLExtension
	 * @var UBLExtension
	 */
	public $UBLExtension;


} // end class UBLExtensionsType
