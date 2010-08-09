<?php
namespace oasis\names\specification\ubl\schema\xsd\CommonAggregateComponents_2;

/**
 * @xmlNamespace urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2
 * @xmlType 
 * @xmlName ClassificationSchemeType
 * @xmlComponentType ABIE
 * @xmlDictionaryEntryName Classification Scheme. Details
 * @xmlDefinition Information about Classification Scheme; a scheme that defines a taxonomy for classifying goods or services.
 * @xmlObjectClass Classification Scheme
 */
class ClassificationSchemeType
	{

	
	/**
	 * @ComponentType BBIE
	 * @DictionaryEntryName Classification Scheme. Identifier
	 * @Definition An identifier for the classification scheme.
	 * @Cardinality 1
	 * @ObjectClass Classification Scheme
	 * @PropertyTerm Identifier
	 * @RepresentationTerm Identifier
	 * @DataType Identifier. Type
	 * @xmlType element
	 * @xmlNamespace urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2
	 * @xmlMinOccurs 1
	 * @xmlMaxOccurs 1
	 * @xmlName ID
	 * @var ID
	 */
	public $ID;
	/**
	 * @ComponentType BBIE
	 * @DictionaryEntryName Classification Scheme. UUID. Identifier
	 * @Definition A universally unique identifier for an instance of this ABIE.
	 * @Cardinality 0..1
	 * @ObjectClass Classification Scheme
	 * @PropertyTerm UUID
	 * @RepresentationTerm Identifier
	 * @DataType Identifier. Type
	 * @xmlType element
	 * @xmlNamespace urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2
	 * @xmlMinOccurs 0
	 * @xmlMaxOccurs 1
	 * @xmlName UUID
	 * @var UUID
	 */
	public $UUID;
	/**
	 * @ComponentType BBIE
	 * @DictionaryEntryName Classification Scheme. Last_ Revision Date. Date
	 * @Definition The date at which the classification scheme was last revised.
	 * @Cardinality 0..1
	 * @ObjectClass Classification Scheme
	 * @PropertyTermQualifier Last
	 * @PropertyTerm Revision Date
	 * @RepresentationTerm Date
	 * @DataType Date. Type
	 * @xmlType element
	 * @xmlNamespace urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2
	 * @xmlMinOccurs 0
	 * @xmlMaxOccurs 1
	 * @xmlName LastRevisionDate
	 * @var LastRevisionDate
	 */
	public $LastRevisionDate;
	/**
	 * @ComponentType BBIE
	 * @DictionaryEntryName Classification Scheme. Last_ Revision Time. Time
	 * @Definition The time at which the classification scheme was last revised.
	 * @Cardinality 0..1
	 * @ObjectClass Classification Scheme
	 * @PropertyTermQualifier Last
	 * @PropertyTerm Revision Time
	 * @RepresentationTerm Time
	 * @DataType Time. Type
	 * @xmlType element
	 * @xmlNamespace urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2
	 * @xmlMinOccurs 0
	 * @xmlMaxOccurs 1
	 * @xmlName LastRevisionTime
	 * @var LastRevisionTime
	 */
	public $LastRevisionTime;
	/**
	 * @ComponentType BBIE
	 * @DictionaryEntryName Classification Scheme. Note. Text
	 * @Definition Free-form text applying to the Classification Scheme. This element may contain notes or any other similar information that is not contained explicitly in another structure.
	 * @Cardinality 0..1
	 * @ObjectClass Classification Scheme
	 * @PropertyTerm Note
	 * @RepresentationTerm Text
	 * @DataType Text. Type
	 * @xmlType element
	 * @xmlNamespace urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2
	 * @xmlMinOccurs 0
	 * @xmlMaxOccurs 1
	 * @xmlName Note
	 * @var Note
	 */
	public $Note;
	/**
	 * @ComponentType BBIE
	 * @DictionaryEntryName Classification Scheme. Name
	 * @Definition The name of the Classification Scheme.
	 * @Cardinality 0..1
	 * @ObjectClass Classification Scheme
	 * @PropertyTerm Name
	 * @RepresentationTerm Name
	 * @DataType Name. Type
	 * @Examples "UNSPSC"
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
	 * @DictionaryEntryName Classification Scheme. Description. Text
	 * @Definition A description of the Classification Scheme.
	 * @Cardinality 0..n
	 * @ObjectClass Classification Scheme
	 * @PropertyTerm Description
	 * @RepresentationTerm Text
	 * @DataType Text. Type
	 * @Examples "an open, global multi-sector standard for classification of products and services"
	 * @xmlType element
	 * @xmlNamespace urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2
	 * @xmlMinOccurs 0
	 * @xmlMaxOccurs unbounded
	 * @xmlName Description
	 * @var Description
	 */
	public $Description;
	/**
	 * @ComponentType BBIE
	 * @DictionaryEntryName Classification Scheme. Agency Identifier. Identifier
	 * @Definition Identifies the agency that maintains the Classification Scheme.
	 * @Cardinality 0..1
	 * @ObjectClass Classification Scheme
	 * @PropertyTerm Agency Identifier
	 * @RepresentationTerm Identifier
	 * @DataType Identifier. Type
	 * @Examples Defaults to the UN/EDIFACT data element 3055 code list.
	 * @xmlType element
	 * @xmlNamespace urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2
	 * @xmlMinOccurs 0
	 * @xmlMaxOccurs 1
	 * @xmlName AgencyID
	 * @var AgencyID
	 */
	public $AgencyID;
	/**
	 * @ComponentType BBIE
	 * @DictionaryEntryName Classification Scheme. Agency Name. Text
	 * @Definition The name of the agency that maintains the Classification Scheme.
	 * @Cardinality 0..1
	 * @ObjectClass Classification Scheme
	 * @PropertyTerm Agency Name
	 * @RepresentationTerm Text
	 * @DataType Text. Type
	 * @xmlType element
	 * @xmlNamespace urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2
	 * @xmlMinOccurs 0
	 * @xmlMaxOccurs 1
	 * @xmlName AgencyName
	 * @var AgencyName
	 */
	public $AgencyName;
	/**
	 * @ComponentType BBIE
	 * @DictionaryEntryName Classification Scheme. Version. Identifier
	 * @Definition Identifies the version of the Classification Scheme.
	 * @Cardinality 0..1
	 * @ObjectClass Classification Scheme
	 * @PropertyTerm Version
	 * @RepresentationTerm Identifier
	 * @DataType Identifier. Type
	 * @xmlType element
	 * @xmlNamespace urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2
	 * @xmlMinOccurs 0
	 * @xmlMaxOccurs 1
	 * @xmlName VersionID
	 * @var VersionID
	 */
	public $VersionID;
	/**
	 * @ComponentType BBIE
	 * @DictionaryEntryName Classification Scheme. URI. Identifier
	 * @Definition The Uniform Resource Identifier (URI) that identifies where the Classification is located.
	 * @Cardinality 0..1
	 * @ObjectClass Classification Scheme
	 * @PropertyTerm URI
	 * @RepresentationTerm Identifier
	 * @DataType Identifier. Type
	 * @xmlType element
	 * @xmlNamespace urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2
	 * @xmlMinOccurs 0
	 * @xmlMaxOccurs 1
	 * @xmlName URI
	 * @var URI
	 */
	public $URI;
	/**
	 * @ComponentType BBIE
	 * @DictionaryEntryName Classification Scheme. Scheme_ URI. Identifier
	 * @Definition The Uniform Resource Identifier (URI) that identifies where the Classification Scheme is located.
	 * @Cardinality 0..1
	 * @ObjectClass Classification Scheme
	 * @PropertyTermQualifier Scheme
	 * @PropertyTerm URI
	 * @RepresentationTerm Identifier
	 * @DataType Identifier. Type
	 * @xmlType element
	 * @xmlNamespace urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2
	 * @xmlMinOccurs 0
	 * @xmlMaxOccurs 1
	 * @xmlName SchemeURI
	 * @var SchemeURI
	 */
	public $SchemeURI;
	/**
	 * @ComponentType BBIE
	 * @DictionaryEntryName Classification Scheme. Language. Identifier
	 * @Definition Identifies the language of the Classification Scheme.
	 * @Cardinality 0..1
	 * @ObjectClass Classification Scheme
	 * @PropertyTerm Language
	 * @RepresentationTerm Identifier
	 * @DataType Identifier. Type
	 * @xmlType element
	 * @xmlNamespace urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2
	 * @xmlMinOccurs 0
	 * @xmlMaxOccurs 1
	 * @xmlName LanguageID
	 * @var LanguageID
	 */
	public $LanguageID;
	/**
	 * @ComponentType ASBIE
	 * @DictionaryEntryName Classification Scheme. Classification Category
	 * @Definition An association to Classification Category.
	 * @Cardinality 1..n
	 * @ObjectClass Classification Scheme
	 * @PropertyTerm Classification Category
	 * @AssociatedObjectClass Classification Category
	 * @xmlType element
	 * @xmlNamespace 
	 * @xmlMinOccurs 1
	 * @xmlMaxOccurs unbounded
	 * @xmlName ClassificationCategory
	 * @var ClassificationCategory
	 */
	public $ClassificationCategory;


} // end class ClassificationSchemeType
