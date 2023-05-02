<?php

namespace App\Filters;

class TransactionFilter extends Filter
{
	/**
	* Register filter properties
	*/
	protected $filters = [
		'wallet_id', 'date'
	];


	public function wallet_id($value)
	{
		$this->builder->where('wallet_id', $value);
	}	

	public function date($value)
	{
		$this->builder->whereDate('date',$value);
	}
}