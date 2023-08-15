<?php
declare(strict_types=1);

namespace App\Entity\ExpenseReport;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;

#[ApiResource(
    operations: [
        new GetCollection(
            uriTemplate: '/expense-reports-type',
            provider: ExpenseReportsType::class . '::getCases'
        ),
    ],
)]
enum ExpenseReportsType: string
{
    case Conference = 'conference';
    case Gazoline = 'gazoline';
    case Meat = 'meat';
    case Toll = 'toll';

    public static function getCases(): array
    {
        return array_column(self::cases(), 'value');
    }
}
