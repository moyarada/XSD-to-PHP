<?php
namespace oasis\names\specification\ubl\schema\xsd\CommonAggregateComponents_2;

/**
 * @xmlNamespace urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2
 * @xmlType 
 * @xmlName DespatchLineType
 * @xmlComponentType ABIE
 * @xmlDictionaryEntryName Despatch Line. Details
 * @xmlDefinition Information about a Despatch Line.
 * @xmlObjectClass Despatch Line
 */
class DespatchLineType
	{

	
	/**
	 * @ComponentType BBIE
	 * @DictionaryEntryName Despatch Line. Identifier
	 * @Definition Identifies the Despatch Line.
	 * @Cardinality 1
	 * @ObjectClass Despatch Line
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
	 * @DictionaryEntryName Despatch Line. UUID. Identifier
	 * @Definition A universally unique identifier for an instance of this ABIE.
	 * @Cardinality 0..1
	 * @ObjectClass Despatch Line
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
	 * @DictionaryEntryName Despatch Line. Note. Text
	 * @Definition Free-form text applying to the Despatch Line. This element may contain notes or any other similar information that is not contained explicitly in another structure.
	 * @Cardinality 0..1
	 * @ObjectClass Despatch Line
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
	 * @DictionaryEntryName Despatch Line. Line Status Code. Code
	 * @Definition Identifies the status of the Despatch Line with respect to its original state.
	 * @Cardinality 0..1
	 * @ObjectClass Despatch Line
	 * @PropertyTerm Line Status Code
	 * @RepresentationTerm Code
	 * @DataType Line Status_ Code. Type
	 * @xmlType element
	 * @xmlNamespace urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2
	 * @xmlMinOccurs 0
	 * @xmlMaxOccurs 1
	 * @xmlName LineStatusCode
	 * @var LineStatusCode
	 */
	public $LineStatusCode;
	/**
	 * @ComponentType BBIE
	 * @DictionaryEntryName Despatch Line. Delivered_ Quantity. Quantity
	 * @Definition The quantity despatched.
	 * @Cardinality 0..1
	 * @ObjectClass Despatch Line
	 * @PropertyTermQualifier Delivered
	 * @PropertyTerm Quantity
	 * @RepresentationTerm Quantity
	 * @DataType Quantity. Type
	 * @xmlType element
	 * @xmlNamespace urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2
	 * @xmlMinOccurs 0
	 * @xmlMaxOccurs 1
	 * @xmlName DeliveredQuantity
	 * @var DeliveredQuantity
	 */
	public $DeliveredQuantity;
	/**
	 * @ComponentType BBIE
	 * @DictionaryEntryName Despatch Line. Backorder_ Quantity. Quantity
	 * @Definition The quantity on Back Order at the Supplier.
	 * @Cardinality 0..1
	 * @ObjectClass Despatch Line
	 * @PropertyTermQualifier Backorder
	 * @PropertyTerm Quantity
	 * @RepresentationTerm Quantity
	 * @DataType Quantity. Type
	 * @xmlType element
	 * @xmlNamespace urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2
	 * @xmlMinOccurs 0
	 * @xmlMaxOccurs 1
	 * @xmlName BackorderQuantity
	 * @var BackorderQuantity
	 */
	public $BackorderQuantity;
	/**
	 * @ComponentType BBIE
	 * @DictionaryEntryName Despatch Line. Backorder_ Reason. Text
	 * @Definition The reason for the Back Order.
	 * @Cardinality 0..1
	 * @ObjectClass Despatch Line
	 * @PropertyTermQualifier Backorder
	 * @PropertyTerm Reason
	 * @RepresentationTerm Text
	 * @DataType Text. Type
	 * @xmlType element
	 * @xmlNamespace urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2
	 * @xmlMinOccurs 0
	 * @xmlMaxOccurs 1
	 * @xmlName BackorderReason
	 * @var BackorderReason
	 */
	public $BackorderReason;
	/**
	 * @ComponentType BBIE
	 * @DictionaryEntryName Despatch Line. Outstanding_ Quantity. Quantity
	 * @Definition The quantity outstanding (which will follow in a later despatch).
	 * @Cardinality 0..1
	 * @ObjectClass Despatch Line
	 * @PropertyTermQualifier Outstanding
	 * @PropertyTerm Quantity
	 * @RepresentationTerm Quantity
	 * @DataType Quantity. Type
	 * @xmlType element
	 * @xmlNamespace urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2
	 * @xmlMinOccurs 0
	 * @xmlMaxOccurs 1
	 * @xmlName OutstandingQuantity
	 * @var OutstandingQuantity
	 */
	public $OutstandingQuantity;
	/**
	 * @ComponentType BBIE
	 * @DictionaryEntryName Despatch Line. Outstanding_ Reason. Text
	 * @Definition The reason for the Outstanding Quantity.
	 * @Cardinality 0..1
	 * @ObjectClass Despatch Line
	 * @PropertyTermQualifier Outstanding
	 * @PropertyTerm Reason
	 * @RepresentationTerm Text
	 * @DataType Text. Type
	 * @xmlType element
	 * @xmlNamespace urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2
	 * @xmlMinOccurs 0
	 * @xmlMaxOccurs 1
	 * @xmlName OutstandingReason
	 * @var OutstandingReason
	 */
	public $OutstandingReason;
	/**
	 * @ComponentType BBIE
	 * @DictionaryEntryName Despatch Line. Oversupply_ Quantity. Quantity
	 * @Definition The quantity over-supplied.
	 * @Cardinality 0..1
	 * @ObjectClass Despatch Line
	 * @PropertyTermQualifier Oversupply
	 * @PropertyTerm Quantity
	 * @RepresentationTerm Quantity
	 * @DataType Quantity. Type
	 * @xmlType element
	 * @xmlNamespace urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2
	 * @xmlMinOccurs 0
	 * @xmlMaxOccurs 1
	 * @xmlName OversupplyQuantity
	 * @var OversupplyQuantity
	 */
	public $OversupplyQuantity;
	/**
	 * @ComponentType ASBIE
	 * @DictionaryEntryName Despatch Line. Order Line Reference
	 * @Definition An association to Order Line Reference.
	 * @Cardinality 1..n
	 * @ObjectClass Despatch Line
	 * @PropertyTerm Order Line Reference
	 * @AssociatedObjectClass Order Line Reference
	 * @xmlType element
	 * @xmlNamespace 
	 * @xmlMinOccurs 1
	 * @xmlMaxOccurs unbounded
	 * @xmlName OrderLineReference
	 * @var OrderLineReference
	 */
	public $OrderLineReference;
	/**
	 * @ComponentType ASBIE
	 * @DictionaryEntryName Despatch Line. Document Reference
	 * @Definition An association to Document Reference.
	 * @Cardinality 0..n
	 * @ObjectClass Despatch Line
	 * @PropertyTerm Document Reference
	 * @AssociatedObjectClass Document Reference
	 * @xmlType element
	 * @xmlNamespace 
	 * @xmlMinOccurs 0
	 * @xmlMaxOccurs unbounded
	 * @xmlName DocumentReference
	 * @var DocumentReference
	 */
	public $DocumentReference;
	/**
	 * @ComponentType ASBIE
	 * @DictionaryEntryName Despatch Line. Item
	 * @Definition An association to Item.
	 * @Cardinality 1
	 * @ObjectClass Despatch Line
	 * @PropertyTerm Item
	 * @AssociatedObjectClass Item
	 * @xmlType element
	 * @xmlNamespace 
	 * @xmlMinOccurs 1
	 * @xmlMaxOccurs 1
	 * @xmlName Item
	 * @var Item
	 */
	public $Item;
	/**
	 * @ComponentType ASBIE
	 * @DictionaryEntryName Despatch Line. Shipment
	 * @Definition An association to Shipment.
	 * @Cardinality 0..n
	 * @ObjectClass Despatch Line
	 * @PropertyTerm Shipment
	 * @AssociatedObjectClass Shipment
	 * @xmlType element
	 * @xmlNamespace 
	 * @xmlMinOccurs 0
	 * @xmlMaxOccurs unbounded
	 * @xmlName Shipment
	 * @var Shipment
	 */
	public $Shipment;


} // end class DespatchLineType
