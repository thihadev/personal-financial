<?php 

namespace App\Enums;

enum TransactionType : int
{
	// case PAY = 1;
	// case RECEIVED = 2;
	// case EXCHANGE = 3;
	case INCOME = 1;
	case EXPENSE = 2;
	case LEND = 3;
	case BORROW = 4;
	case CREDIT = 5;

	public function color(): string
    {
        return match ($this) {
            self::INCOME => 'success',
            self::EXPENSE => 'danger',
            self::LEND => 'danger',
            self::BORROW => 'success',
            self::CREDIT => 'primary',
        };
    }
}
