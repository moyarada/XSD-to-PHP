<?php
namespace oasis\names\specification\ubl\schema\xsd\CommonAggregateComponents_2;

/**
 * @xmlNamespace urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2
 * @xmlType 
 * @xmlName CertificateOfOriginApplicationType
 * @xmlComponentType ABIE
 * @xmlDictionaryEntryName Certificate Of Origin Application. Details
 * @xmlDefinition A document that contains information of CO application.
 * @xmlObjectClass Certificate Of Origin Application
 */
class CertificateOfOriginApplicationType
	{

	
	/**
	 * @ComponentType BBIE
	 * @DictionaryEntryName Certificate Of Origin Application. Reference. Identifier
	 * @Definition Holds the unique number that identifies the Despatch Advice, typically according to the seller's system that generated the Despatch Advice.
	 * @Cardinality 1
	 * @ObjectClass Certificate Of Origin Application
	 * @PropertyTerm Reference
	 * @RepresentationTerm Identifier
	 * @DataType Identifier. Type
	 * @xmlType element
	 * @xmlNamespace urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2
	 * @xmlMinOccurs 1
	 * @xmlMaxOccurs 1
	 * @xmlName ReferenceID
	 * @var ReferenceID
	 */
	public $ReferenceID;
	/**
	 * @ComponentType BBIE
	 * @DictionaryEntryName Certificate Of Origin Application. Certificate Type. Text
	 * @Definition Type of CO. Type could be Ordinary, Re-export, Commonwealth Preferential etc.
	 * @Cardinality 1
	 * @ObjectClass Certificate Of Origin Application
	 * @PropertyTerm Certificate Type
	 * @RepresentationTerm Text
	 * @DataType Text. Type
	 * @xmlType element
	 * @xmlNamespace urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2
	 * @xmlMinOccurs 1
	 * @xmlMaxOccurs 1
	 * @xmlName CertificateType
	 * @var CertificateType
	 */
	public $CertificateType;
	/**
	 * @ComponentType BBIE
	 * @DictionaryEntryName Certificate Of Origin Application. Application Status Code. Code
	 * @Definition Indicates the status of the application (revision, replacement, etc.).
	 * @Cardinality 0..1
	 * @ObjectClass Certificate Of Origin Application
	 * @PropertyTerm Application Status Code
	 * @RepresentationTerm Code
	 * @DataType Code. Type
	 * @xmlType element
	 * @xmlNamespace urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2
	 * @xmlMinOccurs 0
	 * @xmlMaxOccurs 1
	 * @xmlName ApplicationStatusCode
	 * @var ApplicationStatusCode
	 */
	public $ApplicationStatusCode;
	/**
	 * @ComponentType BBIE
	 * @DictionaryEntryName Certificate Of Origin Application. Original_ Job Identifier. Identifier
	 * @Definition The latest Job Number given to the Origin application. This is used by the system to keep track of the amendments or cancellation of the origin application applied earlier.
	 * @Cardinality 1
	 * @ObjectClass Certificate Of Origin Application
	 * @PropertyTermQualifier Original
	 * @PropertyTerm Job Identifier
	 * @RepresentationTerm Identifier
	 * @DataType Identifier. Type
	 * @xmlType element
	 * @xmlNamespace urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2
	 * @xmlMinOccurs 1
	 * @xmlMaxOccurs 1
	 * @xmlName OriginalJobID
	 * @var OriginalJobID
	 */
	public $OriginalJobID;
	/**
	 * @ComponentType BBIE
	 * @DictionaryEntryName Certificate Of Origin Application. Previous_ Job Identifier. Identifier
	 * @Definition The previous Job Number assigned in case the application undergoes query or change. This is used by the system to keep track of the amendments or cancellation of the origin application applied earlier.
	 * @Cardinality 0..1
	 * @ObjectClass Certificate Of Origin Application
	 * @PropertyTermQualifier Previous
	 * @PropertyTerm Job Identifier
	 * @RepresentationTerm Identifier
	 * @DataType Identifier. Type
	 * @xmlType element
	 * @xmlNamespace urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2
	 * @xmlMinOccurs 0
	 * @xmlMaxOccurs 1
	 * @xmlName PreviousJobID
	 * @var PreviousJobID
	 */
	public $PreviousJobID;
	/**
	 * @ComponentType BBIE
	 * @DictionaryEntryName Certificate Of Origin Application. Remarks. Text
	 * @Definition Remarks by the applicant for the Certificate of Origin Application.
	 * @Cardinality 0..1
	 * @ObjectClass Certificate Of Origin Application
	 * @PropertyTerm Remarks
	 * @RepresentationTerm Text
	 * @DataType Text. Type
	 * @xmlType element
	 * @xmlNamespace urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2
	 * @xmlMinOccurs 0
	 * @xmlMaxOccurs 1
	 * @xmlName Remarks
	 * @var Remarks
	 */
	public $Remarks;
	/**
	 * @ComponentType ASBIE
	 * @DictionaryEntryName Certificate Of Origin Application. Shipment
	 * @Definition Information about the separately identifiable collection of goods items (available to be) transported from one consignor to one consignee via one or more modes of transport.
	 * @Cardinality 1
	 * @ObjectClass Certificate Of Origin Application
	 * @PropertyTerm Shipment
	 * @AssociatedObjectClass Shipment
	 * @xmlType element
	 * @xmlNamespace 
	 * @xmlMinOccurs 1
	 * @xmlMaxOccurs 1
	 * @xmlName Shipment
	 * @var Shipment
	 */
	public $Shipment;
	/**
	 * @ComponentType ASBIE
	 * @DictionaryEntryName Certificate Of Origin Application. Endorser Party
	 * @Definition The party providing the endorsement.
	 * @Cardinality 1..n
	 * @ObjectClass Certificate Of Origin Application
	 * @PropertyTerm Endorser Party
	 * @AssociatedObjectClass Endorser Party
	 * @xmlType element
	 * @xmlNamespace 
	 * @xmlMinOccurs 1
	 * @xmlMaxOccurs unbounded
	 * @xmlName EndorserParty
	 * @var EndorserParty
	 */
	public $EndorserParty;
	/**
	 * @ComponentType ASBIE
	 * @DictionaryEntryName Certificate Of Origin Application. Preparation_ Party. Party
	 * @Definition Details of an individual, a group, or a body that prepares the Certificate of Origin application.
	 * @Cardinality 1
	 * @ObjectClass Certificate Of Origin Application
	 * @PropertyTermQualifier Preparation
	 * @PropertyTerm Party
	 * @AssociatedObjectClass Party
	 * @xmlType element
	 * @xmlNamespace 
	 * @xmlMinOccurs 1
	 * @xmlMaxOccurs 1
	 * @xmlName PreparationParty
	 * @var PreparationParty
	 */
	public $PreparationParty;
	/**
	 * @ComponentType ASBIE
	 * @DictionaryEntryName Certificate Of Origin Application. Issuer_ Party. Party
	 * @Definition Details of the authorized organization that issued the Certificate of Origin.
	 * @Cardinality 1
	 * @ObjectClass Certificate Of Origin Application
	 * @PropertyTermQualifier Issuer
	 * @PropertyTerm Party
	 * @AssociatedObjectClass Party
	 * @xmlType element
	 * @xmlNamespace 
	 * @xmlMinOccurs 1
	 * @xmlMaxOccurs 1
	 * @xmlName IssuerParty
	 * @var IssuerParty
	 */
	public $IssuerParty;
	/**
	 * @ComponentType ASBIE
	 * @DictionaryEntryName Certificate Of Origin Application. Issuing_ Country. Country
	 * @Definition The country for which the Certificate of Origin is issued.
	 * @Cardinality 1
	 * @ObjectClass Certificate Of Origin Application
	 * @PropertyTermQualifier Issuing
	 * @PropertyTerm Country
	 * @AssociatedObjectClass Country
	 * @xmlType element
	 * @xmlNamespace 
	 * @xmlMinOccurs 1
	 * @xmlMaxOccurs 1
	 * @xmlName IssuingCountry
	 * @var IssuingCountry
	 */
	public $IssuingCountry;
	/**
	 * @ComponentType ASBIE
	 * @DictionaryEntryName Certificate Of Origin Application. Document Distribution
	 * @Definition The distribution of the Certificate of Origin to interested parties.
	 * @Cardinality 0..n
	 * @ObjectClass Certificate Of Origin Application
	 * @PropertyTerm Document Distribution
	 * @AssociatedObjectClass Document Distribution
	 * @xmlType element
	 * @xmlNamespace 
	 * @xmlMinOccurs 0
	 * @xmlMaxOccurs unbounded
	 * @xmlName DocumentDistribution
	 * @var DocumentDistribution
	 */
	public $DocumentDistribution;
	/**
	 * @ComponentType ASBIE
	 * @DictionaryEntryName Certificate Of Origin Application. Supporting_ Document Reference. Document Reference
	 * @Definition An associative reference to a supporting document.
	 * @Cardinality 0..n
	 * @ObjectClass Certificate Of Origin Application
	 * @PropertyTermQualifier Supporting
	 * @PropertyTerm Document Reference
	 * @AssociatedObjectClass Document Reference
	 * @xmlType element
	 * @xmlNamespace 
	 * @xmlMinOccurs 0
	 * @xmlMaxOccurs unbounded
	 * @xmlName SupportingDocumentReference
	 * @var SupportingDocumentReference
	 */
	public $SupportingDocumentReference;
	/**
	 * @ComponentType ASBIE
	 * @DictionaryEntryName Certificate Of Origin Application. Signature
	 * @Definition One or more signatures applied to the document instance.
	 * @Cardinality 0..n
	 * @ObjectClass Certificate Of Origin Application
	 * @PropertyTerm Signature
	 * @AssociatedObjectClass Signature
	 * @xmlType element
	 * @xmlNamespace 
	 * @xmlMinOccurs 0
	 * @xmlMaxOccurs unbounded
	 * @xmlName Signature
	 * @var Signature
	 */
	public $Signature;


} // end class CertificateOfOriginApplicationType
