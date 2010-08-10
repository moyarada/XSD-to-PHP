<?php

/**
 * @xmlNamespace 
 * @xmlType 
 * @xmlName 
 */
class 
	{

	
	/**
	 * @xmlType element
	 * @xmlName orderperson
	 * @var orderperson
	 */
	public $orderperson;
	/**
	 * @xmlType element
	 * @xmlName shipto
	 * @var shipto
	 */
	public $shipto;
	/**
	 * @xmlType element
	 * @xmlMaxOccurs unbounded
	 * @xmlName item
	 * @var item
	 */
	public $item;
	/**
	 * @xmlType attribute
	 * @xmlName orderid
	 * @var orderid
	 */
	public $orderid;


} // end class 
