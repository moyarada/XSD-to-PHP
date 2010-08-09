<?php
namespace oasis\names\specification\ubl\schema\xsd\CommonAggregateComponents_2;

/**
 * @xmlNamespace urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2
 * @xmlType 
 * @xmlName SignatureType
 * @xmlComponentType ABIE
 * @xmlDictionaryEntryName Signature. Details
 * @xmlDefinition Information about signature. A placeholder for signature.
 * @xmlObjectClass Signature
 */
class SignatureType
	{

	
	/**
	 * @ComponentType BBIE
	 * @DictionaryEntryName Signature. Identifier
	 * @Definition An identifier for the Signature.
	 * @Cardinality 1
	 * @ObjectClass Signature
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
	 * @DictionaryEntryName Signature. Note. Text
	 * @Definition Free form text about the signature or the circumstances where the signature has been used.
	 * @Cardinality 0..1
	 * @ObjectClass Signature
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
	 * @DictionaryEntryName Signature. Validation Date. Date
	 * @Definition Specifies the date when the signature was approved.
	 * @Cardinality 0..1
	 * @ObjectClass Signature
	 * @PropertyTerm Validation Date
	 * @RepresentationTerm Date
	 * @DataType Date. Type
	 * @xmlType element
	 * @xmlNamespace urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2
	 * @xmlMinOccurs 0
	 * @xmlMaxOccurs 1
	 * @xmlName ValidationDate
	 * @var ValidationDate
	 */
	public $ValidationDate;
	/**
	 * @ComponentType BBIE
	 * @DictionaryEntryName Signature. Validation Time. Time
	 * @Definition Specifies the time when the signature was approved.
	 * @Cardinality 0..1
	 * @ObjectClass Signature
	 * @PropertyTerm Validation Time
	 * @RepresentationTerm Time
	 * @DataType Time. Type
	 * @xmlType element
	 * @xmlNamespace urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2
	 * @xmlMinOccurs 0
	 * @xmlMaxOccurs 1
	 * @xmlName ValidationTime
	 * @var ValidationTime
	 */
	public $ValidationTime;
	/**
	 * @ComponentType BBIE
	 * @DictionaryEntryName Signature. Validator Identifier. Identifier
	 * @Definition Identifies the organization, person, service or server that has validated the signature.
	 * @Cardinality 0..1
	 * @ObjectClass Signature
	 * @PropertyTerm Validator Identifier
	 * @RepresentationTerm Identifier
	 * @DataType Identifier. Type
	 * @xmlType element
	 * @xmlNamespace urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2
	 * @xmlMinOccurs 0
	 * @xmlMaxOccurs 1
	 * @xmlName ValidatorID
	 * @var ValidatorID
	 */
	public $ValidatorID;
	/**
	 * @ComponentType BBIE
	 * @DictionaryEntryName Signature. Canonicalization Method. Text
	 * @Definition The mathematical logic method used by the Signature.
	 * @Cardinality 0..1
	 * @ObjectClass Signature
	 * @PropertyTerm Canonicalization Method
	 * @RepresentationTerm Text
	 * @DataType Text. Type
	 * @xmlType element
	 * @xmlNamespace urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2
	 * @xmlMinOccurs 0
	 * @xmlMaxOccurs 1
	 * @xmlName CanonicalizationMethod
	 * @var CanonicalizationMethod
	 */
	public $CanonicalizationMethod;
	/**
	 * @ComponentType BBIE
	 * @DictionaryEntryName Signature. Signature Method. Text
	 * @Definition The method of signature.
	 * @Cardinality 0..1
	 * @ObjectClass Signature
	 * @PropertyTerm Signature Method
	 * @RepresentationTerm Text
	 * @DataType Text. Type
	 * @xmlType element
	 * @xmlNamespace urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2
	 * @xmlMinOccurs 0
	 * @xmlMaxOccurs 1
	 * @xmlName SignatureMethod
	 * @var SignatureMethod
	 */
	public $SignatureMethod;
	/**
	 * @ComponentType ASBIE
	 * @DictionaryEntryName Signature. Signatory_ Party. Party
	 * @Definition An association to the signing Party.
	 * @Cardinality 1
	 * @ObjectClass Signature
	 * @PropertyTermQualifier Signatory
	 * @PropertyTerm Party
	 * @AssociatedObjectClass Party
	 * @xmlType element
	 * @xmlNamespace 
	 * @xmlMinOccurs 1
	 * @xmlMaxOccurs 1
	 * @xmlName SignatoryParty
	 * @var SignatoryParty
	 */
	public $SignatoryParty;
	/**
	 * @ComponentType ASBIE
	 * @DictionaryEntryName Signature. Digital Signature_ Attachment. Attachment
	 * @Definition Refers to the actual encoded signature (e.g., in XMLDSIG format).
	 * @Cardinality 0..1
	 * @ObjectClass Signature
	 * @PropertyTermQualifier Digital Signature
	 * @PropertyTerm Attachment
	 * @AssociatedObjectClass Attachment
	 * @xmlType element
	 * @xmlNamespace 
	 * @xmlMinOccurs 0
	 * @xmlMaxOccurs 1
	 * @xmlName DigitalSignatureAttachment
	 * @var DigitalSignatureAttachment
	 */
	public $DigitalSignatureAttachment;
	/**
	 * @ComponentType ASBIE
	 * @DictionaryEntryName Signature. Original_ Document Reference. Document Reference
	 * @Definition A reference to the actual document that the signature applies to. For evidentiary purposes, this may be the document image that the signatory party saw when applying their signature.
	 * @Cardinality 0..1
	 * @ObjectClass Signature
	 * @PropertyTermQualifier Original
	 * @PropertyTerm Document Reference
	 * @AssociatedObjectClass Document Reference
	 * @xmlType element
	 * @xmlNamespace 
	 * @xmlMinOccurs 0
	 * @xmlMaxOccurs 1
	 * @xmlName OriginalDocumentReference
	 * @var OriginalDocumentReference
	 */
	public $OriginalDocumentReference;


} // end class SignatureType
