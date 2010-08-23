<?php
namespace dk\nordsign\schema\ContactCompany;

/**
 * @xmlNamespace urn:dk:nordsign:schema:ContactCompany
 * @xmlType 
 * @xmlName AddressType
 * @var dk\nordsign\schema\ContactCompany\AddressType
 */
class AddressType
	{

	
	/**
	 * @xmlType element
	 * @xmlNamespace urn:dk:nordsign:schema:ContactCompany
	 * @xmlMinOccurs 1
	 * @xmlMaxOccurs 1
	 * @xmlName Address
	 * @var dk\nordsign\schema\ContactCompany\AddressLineType
	 */
	public $Address;
	/**
	 * @xmlType element
	 * @xmlNamespace urn:dk:nordsign:schema:ContactCompany
	 * @xmlMinOccurs 1
	 * @xmlMaxOccurs 1
	 * @xmlName Address2
	 * @var dk\nordsign\schema\ContactCompany\AddressLineType
	 */
	public $Address2;
	/**
	 * @xmlType element
	 * @xmlNamespace urn:dk:nordsign:schema:ContactCompany
	 * @xmlMinOccurs 1
	 * @xmlMaxOccurs 1
	 * @xmlName PostBox
	 * @var dk\nordsign\schema\ContactCompany\PostboxType
	 */
	public $PostBox;
	/**
	 * @xmlType element
	 * @xmlNamespace urn:dk:nordsign:schema:ContactCompany
	 * @xmlMinOccurs 1
	 * @xmlMaxOccurs 1
	 * @xmlName PostalCode
	 * @var dk\nordsign\schema\ContactCompany\PostalZoneType
	 */
	public $PostalCode;
	/**
	 * @xmlType element
	 * @xmlNamespace urn:dk:nordsign:schema:ContactCompany
	 * @xmlMinOccurs 1
	 * @xmlMaxOccurs 1
	 * @xmlName City
	 * @var dk\nordsign\schema\ContactCompany\CityNameType
	 */
	public $City;
	/**
	 * @xmlType element
	 * @xmlNamespace urn:dk:nordsign:schema:ContactCompany
	 * @xmlMinOccurs 1
	 * @xmlMaxOccurs 1
	 * @xmlName State
	 * @var dk\nordsign\schema\ContactCompany\RegionType
	 */
	public $State;
	/**
	 * @xmlType element
	 * @xmlNamespace urn:dk:nordsign:schema:ContactCompany
	 * @xmlMinOccurs 1
	 * @xmlMaxOccurs 1
	 * @xmlName Country
	 * @var dk\nordsign\schema\ContactCompany\NameType
	 */
	public $Country;
	/**
	 * @xmlType element
	 * @xmlNamespace urn:dk:nordsign:schema:ContactCompany
	 * @xmlMinOccurs 1
	 * @xmlMaxOccurs 1
	 * @xmlName ContactPerson
	 * @var dk\nordsign\schema\ContactCompany\ContactType
	 */
	public $ContactPerson;


} // end class AddressType
