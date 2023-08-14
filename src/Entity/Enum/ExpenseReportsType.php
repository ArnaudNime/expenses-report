<?php
declare(strict_types=1);

namespace App\Entity\Enum;

enum ExpenseReportsType:string
{
    case Conference = 'conference';
    case Gazoline = 'gazoline';
    case Meat = 'meat';
    case Toll = 'toll';
}
