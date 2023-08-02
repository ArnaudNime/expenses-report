<?php
declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ApiResource(
    operations: [
        new Get(),
        new GetCollection(),
    ],
)]
#[ORM\Entity]
final class Expense_report
{
    #[ORM\Id, ORM\Column, ORM\GeneratedValue]
    private int $id;

    #[ORM\Column]
    #[Assert\NotBlank]
    private float $amount;

    #[ORM\Column]
    #[Assert\NotBlank]
    private string $type;

    #[ORM\Column]
    #[Assert\NotBlank]
    private DateTime $paymentDate;

    #[ORM\Column]
    #[Assert\NotBlank]
    private DateTime $creationDate;

    public function getId(): int
    {
        return $this->id;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getPaymentDate(): DateTime
    {
        return $this->paymentDate;
    }

    public function getCreationDate(): DateTime
    {
        return $this->creationDate;
    }
}
