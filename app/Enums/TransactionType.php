<?php 

namespace App\Enums;

enum TransactionType : int
{
	case PAY = 1;
	case RECEIVED = 2;
	case EXCHANGE = 3;
	case LEND = 4;
	case BORROW = 5;
}
