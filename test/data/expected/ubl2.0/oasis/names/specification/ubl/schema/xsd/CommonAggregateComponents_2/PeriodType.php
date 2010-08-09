<?php
namespace oasis\names\specification\ubl\schema\xsd\CommonAggregateComponents_2;

/**
 * @xmlNamespace urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2
 * @xmlType 
 * @xmlName PeriodType
 * @xmlComponentType ABIE
 * @xmlDictionaryEntryName Period. Details
 * @xmlDefinition Information about a period of time.
 * @xmlObjectClass Period
 */
class PeriodType
	{

	
	/**
	 * @ComponentType BBIE
	 * @DictionaryEntryName Period. Start Date. Date
	 * @Definition The start date of the period.
	 * @Cardinality 0..1
	 * @ObjectClass Period
	 * @PropertyTerm Start Date
	 * @RepresentationTerm Date
	 * @DataType Date. Type
	 * @xmlType element
	 * @xmlNamespace urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2
	 * @xmlMinOccurs 0
	 * @xmlMaxOccurs 1
	 * @xmlName StartDate
	 * @var StartDate
	 */
	public $StartDate;
	/**
	 * @ComponentType BBIE
	 * @DictionaryEntryName Period. Start Time. Time
	 * @Definition The start time of the period.
	 * @Cardinality 0..1
	 * @ObjectClass Period
	 * @PropertyTerm Start Time
	 * @RepresentationTerm Time
	 * @DataType Time. Type
	 * @xmlType element
	 * @xmlNamespace urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2
	 * @xmlMinOccurs 0
	 * @xmlMaxOccurs 1
	 * @xmlName StartTime
	 * @var StartTime
	 */
	public $StartTime;
	/**
	 * @ComponentType BBIE
	 * @DictionaryEntryName Period. End Date. Date
	 * @Definition The end date of the period.
	 * @Cardinality 0..1
	 * @ObjectClass Period
	 * @PropertyTerm End Date
	 * @RepresentationTerm Date
	 * @DataType Date. Type
	 * @xmlType element
	 * @xmlNamespace urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2
	 * @xmlMinOccurs 0
	 * @xmlMaxOccurs 1
	 * @xmlName EndDate
	 * @var EndDate
	 */
	public $EndDate;
	/**
	 * @ComponentType BBIE
	 * @DictionaryEntryName Period. End Time. Time
	 * @Definition The end time of the period.
	 * @Cardinality 0..1
	 * @ObjectClass Period
	 * @PropertyTerm End Time
	 * @RepresentationTerm Time
	 * @DataType Time. Type
	 * @xmlType element
	 * @xmlNamespace urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2
	 * @xmlMinOccurs 0
	 * @xmlMaxOccurs 1
	 * @xmlName EndTime
	 * @var EndTime
	 */
	public $EndTime;
	/**
	 * @ComponentType BBIE
	 * @DictionaryEntryName Period. Duration. Measure
	 * @Definition The duration of a period, expressed as a code; ISO 8601.
	 * @Cardinality 0..1
	 * @ObjectClass Period
	 * @PropertyTerm Duration
	 * @RepresentationTerm Measure
	 * @DataType Measure. Type
	 * @xmlType element
	 * @xmlNamespace urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2
	 * @xmlMinOccurs 0
	 * @xmlMaxOccurs 1
	 * @xmlName DurationMeasure
	 * @var DurationMeasure
	 */
	public $DurationMeasure;
	/**
	 * @ComponentType BBIE
	 * @DictionaryEntryName Period. Description Code. Code
	 * @Definition A description of the period, expressed as a code.
	 * @Cardinality 0..n
	 * @ObjectClass Period
	 * @PropertyTerm Description Code
	 * @RepresentationTerm Code
	 * @DataType Code. Type
	 * @xmlType element
	 * @xmlNamespace urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2
	 * @xmlMinOccurs 0
	 * @xmlMaxOccurs unbounded
	 * @xmlName DescriptionCode
	 * @var DescriptionCode
	 */
	public $DescriptionCode;
	/**
	 * @ComponentType BBIE
	 * @DictionaryEntryName Period. Description. Text
	 * @Definition A description of the period.
	 * @Cardinality 0..n
	 * @ObjectClass Period
	 * @PropertyTerm Description
	 * @RepresentationTerm Text
	 * @DataType Text. Type
	 * @xmlType element
	 * @xmlNamespace urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2
	 * @xmlMinOccurs 0
	 * @xmlMaxOccurs unbounded
	 * @xmlName Description
	 * @var Description
	 */
	public $Description;


} // end class PeriodType
