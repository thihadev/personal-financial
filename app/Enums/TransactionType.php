<?php 

namespace App\Enums;

enum TransactionType : int
{
	// case PAY = 1;
	// case RECEIVED = 2;
	// case EXCHANGE = 3;
	// case LEND = 4;
	// case BORROW = 5;
	case INCOME = 1;
	case EXPENSE = 2;

	public function color(): string
    {
        return match ($this) {
            self::INCOME => 'success',
            self::EXPENSE => 'danger',
        };
    }
}
