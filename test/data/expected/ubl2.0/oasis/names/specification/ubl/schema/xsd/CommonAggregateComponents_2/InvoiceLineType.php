<?php
namespace oasis\names\specification\ubl\schema\xsd\CommonAggregateComponents_2;

/**
 * @xmlNamespace urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2
 * @xmlType 
 * @xmlName InvoiceLineType
 * @xmlComponentType ABIE
 * @xmlDictionaryEntryName Invoice Line. Details
 * @xmlDefinition Information about an Invoice Line.
 * @xmlObjectClass Invoice Line
 */
class InvoiceLineType
	{

	
	/**
	 * @ComponentType BBIE
	 * @DictionaryEntryName Invoice Line. Identifier
	 * @Definition Identifies the Invoice Line.
	 * @Cardinality 1
	 * @ObjectClass Invoice Line
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
	 * @DictionaryEntryName Invoice Line. UUID. Identifier
	 * @Definition A universally unique identifier for an instance of this ABIE.
	 * @Cardinality 0..1
	 * @ObjectClass Invoice Line
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
	 * @DictionaryEntryName Invoice Line. Note. Text
	 * @Definition Free-form text applying to the Invoice Line. This element may contain notes or any other similar information that is not contained explicitly in another structure.
	 * @Cardinality 0..1
	 * @ObjectClass Invoice Line
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
	 * @DictionaryEntryName Invoice Line. Invoiced_ Quantity. Quantity
	 * @Definition The quantity (of Items) on the Invoice Line.
	 * @Cardinality 0..1
	 * @ObjectClass Invoice Line
	 * @PropertyTermQualifier Invoiced
	 * @PropertyTerm Quantity
	 * @RepresentationTerm Quantity
	 * @DataType Quantity. Type
	 * @xmlType element
	 * @xmlNamespace urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2
	 * @xmlMinOccurs 0
	 * @xmlMaxOccurs 1
	 * @xmlName InvoicedQuantity
	 * @var InvoicedQuantity
	 */
	public $InvoicedQuantity;
	/**
	 * @ComponentType BBIE
	 * @DictionaryEntryName Invoice Line. Line Extension Amount. Amount
	 * @Definition The total amount for the Invoice Line, including Allowance Charges but net of taxes.
	 * @Cardinality 1
	 * @ObjectClass Invoice Line
	 * @PropertyTerm Line Extension Amount
	 * @RepresentationTerm Amount
	 * @DataType Amount. Type
	 * @xmlType element
	 * @xmlNamespace urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2
	 * @xmlMinOccurs 1
	 * @xmlMaxOccurs 1
	 * @xmlName LineExtensionAmount
	 * @var LineExtensionAmount
	 */
	public $LineExtensionAmount;
	/**
	 * @ComponentType BBIE
	 * @DictionaryEntryName Invoice Line. Tax Point Date. Date
	 * @Definition The date of the Invoice Line, used to indicate the point at which tax becomes applicable.
	 * @Cardinality 0..1
	 * @ObjectClass Invoice Line
	 * @PropertyTerm Tax Point Date
	 * @RepresentationTerm Date
	 * @DataType Date. Type
	 * @xmlType element
	 * @xmlNamespace urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2
	 * @xmlMinOccurs 0
	 * @xmlMaxOccurs 1
	 * @xmlName TaxPointDate
	 * @var TaxPointDate
	 */
	public $TaxPointDate;
	/**
	 * @ComponentType BBIE
	 * @DictionaryEntryName Invoice Line. Accounting Cost Code. Code
	 * @Definition The buyer's accounting code applied to the Invoice Line.
	 * @Cardinality 0..1
	 * @ObjectClass Invoice Line
	 * @PropertyTerm Accounting Cost Code
	 * @RepresentationTerm Code
	 * @DataType Code. Type
	 * @xmlType element
	 * @xmlNamespace urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2
	 * @xmlMinOccurs 0
	 * @xmlMaxOccurs 1
	 * @xmlName AccountingCostCode
	 * @var AccountingCostCode
	 */
	public $AccountingCostCode;
	/**
	 * @ComponentType BBIE
	 * @DictionaryEntryName Invoice Line. Accounting Cost. Text
	 * @Definition The buyer's accounting code applied to the Invoice Line, expressed as text.
	 * @Cardinality 0..1
	 * @ObjectClass Invoice Line
	 * @PropertyTerm Accounting Cost
	 * @RepresentationTerm Text
	 * @DataType Text. Type
	 * @xmlType element
	 * @xmlNamespace urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2
	 * @xmlMinOccurs 0
	 * @xmlMaxOccurs 1
	 * @xmlName AccountingCost
	 * @var AccountingCost
	 */
	public $AccountingCost;
	/**
	 * @ComponentType BBIE
	 * @DictionaryEntryName Invoice Line. Free Of Charge_ Indicator. Indicator
	 * @Definition Indicates whether the Invoice Line is Free Of Charge (default = false).
	 * @Cardinality 0..1
	 * @ObjectClass Invoice Line
	 * @PropertyTermQualifier Free Of Charge
	 * @PropertyTerm Indicator
	 * @RepresentationTerm Indicator
	 * @DataType Indicator. Type
	 * @xmlType element
	 * @xmlNamespace urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2
	 * @xmlMinOccurs 0
	 * @xmlMaxOccurs 1
	 * @xmlName FreeOfChargeIndicator
	 * @var FreeOfChargeIndicator
	 */
	public $FreeOfChargeIndicator;
	/**
	 * @ComponentType ASBIE
	 * @DictionaryEntryName Invoice Line. Order Line Reference
	 * @Definition An association to Order Line Reference.
	 * @Cardinality 0..n
	 * @ObjectClass Invoice Line
	 * @PropertyTerm Order Line Reference
	 * @AssociatedObjectClass Order Line Reference
	 * @xmlType element
	 * @xmlNamespace 
	 * @xmlMinOccurs 0
	 * @xmlMaxOccurs unbounded
	 * @xmlName OrderLineReference
	 * @var OrderLineReference
	 */
	public $OrderLineReference;
	/**
	 * @ComponentType ASBIE
	 * @DictionaryEntryName Invoice Line. Despatch_ Line Reference. Line Reference
	 * @Definition An associative reference to Despatch Line.
	 * @Cardinality 0..n
	 * @ObjectClass Invoice Line
	 * @PropertyTermQualifier Despatch
	 * @PropertyTerm Line Reference
	 * @AssociatedObjectClass Line Reference
	 * @xmlType element
	 * @xmlNamespace 
	 * @xmlMinOccurs 0
	 * @xmlMaxOccurs unbounded
	 * @xmlName DespatchLineReference
	 * @var DespatchLineReference
	 */
	public $DespatchLineReference;
	/**
	 * @ComponentType ASBIE
	 * @DictionaryEntryName Invoice Line. Receipt_ Line Reference. Line Reference
	 * @Definition An associative reference to Receipt Line.
	 * @Cardinality 0..n
	 * @ObjectClass Invoice Line
	 * @PropertyTermQualifier Receipt
	 * @PropertyTerm Line Reference
	 * @AssociatedObjectClass Line Reference
	 * @xmlType element
	 * @xmlNamespace 
	 * @xmlMinOccurs 0
	 * @xmlMaxOccurs unbounded
	 * @xmlName ReceiptLineReference
	 * @var ReceiptLineReference
	 */
	public $ReceiptLineReference;
	/**
	 * @ComponentType ASBIE
	 * @DictionaryEntryName Invoice Line. Billing Reference
	 * @Definition An association to Billing Reference.
	 * @Cardinality 0..n
	 * @ObjectClass Invoice Line
	 * @PropertyTerm Billing Reference
	 * @AssociatedObjectClass Billing Reference
	 * @xmlType element
	 * @xmlNamespace 
	 * @xmlMinOccurs 0
	 * @xmlMaxOccurs unbounded
	 * @xmlName BillingReference
	 * @var BillingReference
	 */
	public $BillingReference;
	/**
	 * @ComponentType ASBIE
	 * @DictionaryEntryName Invoice Line. Document Reference
	 * @Definition An association to Document Reference.
	 * @Cardinality 0..n
	 * @ObjectClass Invoice Line
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
	 * @DictionaryEntryName Invoice Line. Pricing Reference
	 * @Definition An association to Pricing Reference.
	 * @Cardinality 0..1
	 * @ObjectClass Invoice Line
	 * @PropertyTerm Pricing Reference
	 * @AssociatedObjectClass Pricing Reference
	 * @xmlType element
	 * @xmlNamespace 
	 * @xmlMinOccurs 0
	 * @xmlMaxOccurs 1
	 * @xmlName PricingReference
	 * @var PricingReference
	 */
	public $PricingReference;
	/**
	 * @ComponentType ASBIE
	 * @DictionaryEntryName Invoice Line. Originator_ Party. Party
	 * @Definition The party who originated the Order to which the Invoice is related.
	 * @Cardinality 0..1
	 * @ObjectClass Invoice Line
	 * @PropertyTermQualifier Originator
	 * @PropertyTerm Party
	 * @AssociatedObjectClass Party
	 * @xmlType element
	 * @xmlNamespace 
	 * @xmlMinOccurs 0
	 * @xmlMaxOccurs 1
	 * @xmlName OriginatorParty
	 * @var OriginatorParty
	 */
	public $OriginatorParty;
	/**
	 * @ComponentType ASBIE
	 * @DictionaryEntryName Invoice Line. Delivery
	 * @Definition An association to Delivery.
	 * @Cardinality 0..n
	 * @ObjectClass Invoice Line
	 * @PropertyTerm Delivery
	 * @AssociatedObjectClass Delivery
	 * @xmlType element
	 * @xmlNamespace 
	 * @xmlMinOccurs 0
	 * @xmlMaxOccurs unbounded
	 * @xmlName Delivery
	 * @var Delivery
	 */
	public $Delivery;
	/**
	 * @ComponentType ASBIE
	 * @DictionaryEntryName Invoice Line. Payment Terms
	 * @Definition An association to Payment Terms.
	 * @Cardinality 0..n
	 * @ObjectClass Invoice Line
	 * @PropertyTerm Payment Terms
	 * @AssociatedObjectClass Payment Terms
	 * @xmlType element
	 * @xmlNamespace 
	 * @xmlMinOccurs 0
	 * @xmlMaxOccurs unbounded
	 * @xmlName PaymentTerms
	 * @var PaymentTerms
	 */
	public $PaymentTerms;
	/**
	 * @ComponentType ASBIE
	 * @DictionaryEntryName Invoice Line. Allowance Charge
	 * @Definition An association to Allowance Charge.
	 * @Cardinality 0..n
	 * @ObjectClass Invoice Line
	 * @PropertyTerm Allowance Charge
	 * @AssociatedObjectClass Allowance Charge
	 * @xmlType element
	 * @xmlNamespace 
	 * @xmlMinOccurs 0
	 * @xmlMaxOccurs unbounded
	 * @xmlName AllowanceCharge
	 * @var AllowanceCharge
	 */
	public $AllowanceCharge;
	/**
	 * @ComponentType ASBIE
	 * @DictionaryEntryName Invoice Line. Tax Total
	 * @Definition An association to Tax Total.
	 * @Cardinality 0..n
	 * @ObjectClass Invoice Line
	 * @PropertyTerm Tax Total
	 * @AssociatedObjectClass Tax Total
	 * @xmlType element
	 * @xmlNamespace 
	 * @xmlMinOccurs 0
	 * @xmlMaxOccurs unbounded
	 * @xmlName TaxTotal
	 * @var TaxTotal
	 */
	public $TaxTotal;
	/**
	 * @ComponentType ASBIE
	 * @DictionaryEntryName Invoice Line. Item
	 * @Definition An association to Item.
	 * @Cardinality 1
	 * @ObjectClass Invoice Line
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
	 * @DictionaryEntryName Invoice Line. Price
	 * @Definition An association to Price.
	 * @Cardinality 0..1
	 * @ObjectClass Invoice Line
	 * @PropertyTerm Price
	 * @AssociatedObjectClass Price
	 * @xmlType element
	 * @xmlNamespace 
	 * @xmlMinOccurs 0
	 * @xmlMaxOccurs 1
	 * @xmlName Price
	 * @var Price
	 */
	public $Price;
	/**
	 * @ComponentType ASBIE
	 * @DictionaryEntryName Invoice Line. Delivery Terms
	 * @Definition An association to Delivery Terms.
	 * @Cardinality 0..1
	 * @ObjectClass Invoice Line
	 * @PropertyTerm Delivery Terms
	 * @AssociatedObjectClass Delivery Terms
	 * @xmlType element
	 * @xmlNamespace 
	 * @xmlMinOccurs 0
	 * @xmlMaxOccurs 1
	 * @xmlName DeliveryTerms
	 * @var DeliveryTerms
	 */
	public $DeliveryTerms;


} // end class InvoiceLineType
