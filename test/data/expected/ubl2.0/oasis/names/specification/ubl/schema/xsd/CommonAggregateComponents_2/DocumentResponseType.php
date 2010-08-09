<?php
namespace oasis\names\specification\ubl\schema\xsd\CommonAggregateComponents_2;

/**
 * @xmlNamespace urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2
 * @xmlType 
 * @xmlName DocumentResponseType
 * @xmlComponentType ABIE
 * @xmlDictionaryEntryName Document Response. Details
 * @xmlDefinition Information about responses to a document (at the application level).
 * @xmlObjectClass Document Response
 */
class DocumentResponseType
	{

	
	/**
	 * @ComponentType ASBIE
	 * @DictionaryEntryName Document Response. Response
	 * @Definition The response to the document.
	 * @Cardinality 1
	 * @ObjectClass Document Response
	 * @PropertyTerm Response
	 * @AssociatedObjectClass Response
	 * @xmlType element
	 * @xmlNamespace 
	 * @xmlMinOccurs 1
	 * @xmlMaxOccurs 1
	 * @xmlName Response
	 * @var Response
	 */
	public $Response;
	/**
	 * @ComponentType ASBIE
	 * @DictionaryEntryName Document Response. Document Reference
	 * @Definition An association to Document Reference.
	 * @Cardinality 1
	 * @ObjectClass Document Response
	 * @PropertyTerm Document Reference
	 * @AssociatedObjectClass Document Reference
	 * @xmlType element
	 * @xmlNamespace 
	 * @xmlMinOccurs 1
	 * @xmlMaxOccurs 1
	 * @xmlName DocumentReference
	 * @var DocumentReference
	 */
	public $DocumentReference;
	/**
	 * @ComponentType ASBIE
	 * @DictionaryEntryName Document Response. Issuer_ Party. Party
	 * @Definition The party who issued a document.
	 * @Cardinality 0..1
	 * @ObjectClass Document Response
	 * @PropertyTermQualifier Issuer
	 * @PropertyTerm Party
	 * @AssociatedObjectClass Party
	 * @xmlType element
	 * @xmlNamespace 
	 * @xmlMinOccurs 0
	 * @xmlMaxOccurs 1
	 * @xmlName IssuerParty
	 * @var IssuerParty
	 */
	public $IssuerParty;
	/**
	 * @ComponentType ASBIE
	 * @DictionaryEntryName Document Response. Recipient_ Party. Party
	 * @Definition The party for whom the document is intended.
	 * @Cardinality 0..1
	 * @ObjectClass Document Response
	 * @PropertyTermQualifier Recipient
	 * @PropertyTerm Party
	 * @AssociatedObjectClass Party
	 * @xmlType element
	 * @xmlNamespace 
	 * @xmlMinOccurs 0
	 * @xmlMaxOccurs 1
	 * @xmlName RecipientParty
	 * @var RecipientParty
	 */
	public $RecipientParty;
	/**
	 * @ComponentType ASBIE
	 * @DictionaryEntryName Document Response. Line Response
	 * @Definition Response to various lines in the document.
	 * @Cardinality 0..n
	 * @ObjectClass Document Response
	 * @PropertyTerm Line Response
	 * @AssociatedObjectClass Line Response
	 * @xmlType element
	 * @xmlNamespace 
	 * @xmlMinOccurs 0
	 * @xmlMaxOccurs unbounded
	 * @xmlName LineResponse
	 * @var LineResponse
	 */
	public $LineResponse;


} // end class DocumentResponseType
