<?php
namespace oasis\names\specification\ubl\schema\xsd\QualifiedDatatypes_2;

use un\unece\uncefact\data\specification\UnqualifiedDataTypesSchemaModule\_2;
/**
 * @xmlNamespace urn:oasis:names:specification:ubl:schema:xsd:QualifiedDatatypes-2
 * @xmlType CodeType
 * @xmlName LatitudeDirectionCodeType
 * @xmlDictionaryEntryName Latitude Direction_ Code. Type
 * @xmlVersion 2.0
 * @xmlDefinition The possible directions of latitude
 * @xmlRepresentationTerm Code
 * @xmlQualifierTerm Latitude Direction
 */
class LatitudeDirectionCodeType
	extends _2\CodeType
	{

	
	/**
	 * @Name Latitude Direction_ Code List. Identifier
	 * @Definition 
	 * @PrimitiveType String
	 * @xmlType attribute
	 * @xmlNamespace 
	 * @xmlMinOccurs 
	 * @xmlMaxOccurs 
	 * @xmlName listID
	 * @var xsd:normalizedString
	 */
	public $listID;
	/**
	 * @Name Latitude Direction_ Code List. Agency. Identifier
	 * @Definition 
	 * @PrimitiveType String
	 * @xmlType attribute
	 * @xmlNamespace 
	 * @xmlMinOccurs 
	 * @xmlMaxOccurs 
	 * @xmlName listAgencyID
	 * @var xsd:normalizedString
	 */
	public $listAgencyID;
	/**
	 * @Name Latitude Direction_ Code List. Agency Name. Text
	 * @Definition 
	 * @PrimitiveType String
	 * @xmlType attribute
	 * @xmlNamespace 
	 * @xmlMinOccurs 
	 * @xmlMaxOccurs 
	 * @xmlName listAgencyName
	 * @var xsd:string
	 */
	public $listAgencyName;
	/**
	 * @Name Latitude Direction_ Code List. Name. Text
	 * @Definition 
	 * @PrimitiveType String
	 * @xmlType attribute
	 * @xmlNamespace 
	 * @xmlMinOccurs 
	 * @xmlMaxOccurs 
	 * @xmlName listName
	 * @var xsd:string
	 */
	public $listName;
	/**
	 * @Name Latitude Direction_ Code List. Version. Identifier
	 * @Definition 
	 * @PrimitiveType String
	 * @xmlType attribute
	 * @xmlNamespace 
	 * @xmlMinOccurs 
	 * @xmlMaxOccurs 
	 * @xmlName listVersionID
	 * @var xsd:normalizedString
	 */
	public $listVersionID;
	/**
	 * @Name Latitude Direction_ Code. Name. Text
	 * @Definition 
	 * @PrimitiveType String
	 * @xmlType attribute
	 * @xmlNamespace 
	 * @xmlMinOccurs 
	 * @xmlMaxOccurs 
	 * @xmlName name
	 * @var xsd:string
	 */
	public $name;
	/**
	 * @Name Latitude Direction_ Language. Identifier
	 * @Definition 
	 * @PrimitiveType String
	 * @xmlType attribute
	 * @xmlNamespace 
	 * @xmlMinOccurs 
	 * @xmlMaxOccurs 
	 * @xmlName languageID
	 * @var xsd:language
	 */
	public $languageID;
	/**
	 * @Name Latitude Direction_ Code List. Uniform Resource. Identifier
	 * @Definition 
	 * @PrimitiveType String
	 * @xmlType attribute
	 * @xmlNamespace 
	 * @xmlMinOccurs 
	 * @xmlMaxOccurs 
	 * @xmlName listURI
	 * @var xsd:anyURI
	 */
	public $listURI;
	/**
	 * @Name Latitude Direction_ Code List Scheme. Uniform Resource. Identifier
	 * @Definition 
	 * @PrimitiveType String
	 * @xmlType attribute
	 * @xmlNamespace 
	 * @xmlMinOccurs 
	 * @xmlMaxOccurs 
	 * @xmlName listSchemeURI
	 * @var xsd:anyURI
	 */
	public $listSchemeURI;


} // end class LatitudeDirectionCodeType
