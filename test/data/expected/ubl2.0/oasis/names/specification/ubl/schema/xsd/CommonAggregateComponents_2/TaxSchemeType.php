<?php
namespace oasis\names\specification\ubl\schema\xsd\CommonAggregateComponents_2;

/**
 * @xmlNamespace urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2
 * @xmlType 
 * @xmlName TaxSchemeType
 * @xmlComponentType ABIE
 * @xmlDictionaryEntryName Tax Scheme. Details
 * @xmlDefinition Information about a tax scheme.
 * @xmlObjectClass Tax Scheme
 */
class TaxSchemeType
	{

	
	/**
	 * @ComponentType BBIE
	 * @DictionaryEntryName Tax Scheme. Identifier
	 * @Definition Identifies the tax scheme.
	 * @Cardinality 0..1
	 * @ObjectClass Tax Scheme
	 * @PropertyTerm Identifier
	 * @RepresentationTerm Identifier
	 * @DataType Identifier. Type
	 * @Examples "VAT", "GST"
	 * @xmlType element
	 * @xmlNamespace urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2
	 * @xmlMinOccurs 0
	 * @xmlMaxOccurs 1
	 * @xmlName ID
	 * @var ID
	 */
	public $ID;
	/**
	 * @ComponentType BBIE
	 * @DictionaryEntryName Tax Scheme. Name
	 * @Definition The name of the tax scheme.
	 * @Cardinality 0..1
	 * @ObjectClass Tax Scheme
	 * @PropertyTerm Name
	 * @RepresentationTerm Name
	 * @DataType Name. Type
	 * @Examples "Value Added Tax", "Wholesale Tax", "Sales Tax", "State Tax"
	 * @xmlType element
	 * @xmlNamespace urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2
	 * @xmlMinOccurs 0
	 * @xmlMaxOccurs 1
	 * @xmlName Name
	 * @var Name
	 */
	public $Name;
	/**
	 * @ComponentType BBIE
	 * @DictionaryEntryName Tax Scheme. Tax Type Code. Code
	 * @Definition An identifier for the tax type.
	 * @Cardinality 0..1
	 * @ObjectClass Tax Scheme
	 * @PropertyTerm Tax Type Code
	 * @RepresentationTerm Code
	 * @DataType Code. Type
	 * @Examples "Consumption", "Sales"
	 * @xmlType element
	 * @xmlNamespace urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2
	 * @xmlMinOccurs 0
	 * @xmlMaxOccurs 1
	 * @xmlName TaxTypeCode
	 * @var TaxTypeCode
	 */
	public $TaxTypeCode;
	/**
	 * @ComponentType BBIE
	 * @DictionaryEntryName Tax Scheme. Currency Code. Code
	 * @Definition The currency in which the tax is collected and reported, expressed as a code.
	 * @Cardinality 0..1
	 * @ObjectClass Tax Scheme
	 * @PropertyTerm Currency Code
	 * @RepresentationTerm Code
	 * @DataType Currency_ Code. Type
	 * @xmlType element
	 * @xmlNamespace urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2
	 * @xmlMinOccurs 0
	 * @xmlMaxOccurs 1
	 * @xmlName CurrencyCode
	 * @var CurrencyCode
	 */
	public $CurrencyCode;
	/**
	 * @ComponentType ASBIE
	 * @DictionaryEntryName Tax Scheme. Jurisdiction Region_ Address. Address
	 * @Definition An association with Address (of taxation jurisdiction).
	 * @Cardinality 0..n
	 * @ObjectClass Tax Scheme
	 * @PropertyTermQualifier Jurisdiction Region
	 * @PropertyTerm Address
	 * @AssociatedObjectClass Address
	 * @xmlType element
	 * @xmlNamespace 
	 * @xmlMinOccurs 0
	 * @xmlMaxOccurs unbounded
	 * @xmlName JurisdictionRegionAddress
	 * @var JurisdictionRegionAddress
	 */
	public $JurisdictionRegionAddress;


} // end class TaxSchemeType
