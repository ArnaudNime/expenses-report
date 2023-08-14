<?php
declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Entity\Enum\ExpenseReportsType;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Context;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Validator\Constraints as Assert;

#[ApiResource(
    operations: [
        new Get(
            uriTemplate: '/expense-report/{id}',
            requirements: ['id' => '\d+'],
            normalizationContext: ['groups' => ['expense']],
        ),
        new GetCollection(
            uriTemplate: '/expense-reports',
            normalizationContext: ['groups' => ['expense']],
        ),
        new Post(
            uriTemplate: '/expense-report',
            requirements: ['id' => '\d+'],
        ),
        new Put(
            uriTemplate: '/expense-report/{id}',
            requirements: ['id' => '\d+'],
        ),
        new Patch(
            uriTemplate: '/expense-report/{id}',
            requirements: ['id' => '\d+'],
        ),
        new Delete(
            uriTemplate: '/expense-report/{id}',
            requirements: ['id' => '\d+'],
        ),
    ],

)]
#[ORM\Entity]
class ExpenseReport
{
    use EntityTechnicalTrait;

    #[ORM\Id, ORM\Column, ORM\GeneratedValue]
    #[Groups('expense')]
    private int $id;

    #[Groups('expense')]
    #[ORM\Column]
    #[Assert\NotBlank]
    #[Assert\GreaterThan(0)]
    private float $amount;

    #[Groups('expense')]
    #[ORM\Column]
    #[Assert\NotBlank]
    #[Assert\Length(max: 80)]
    #[Assert\Choice(callback: 'getTypes')]
    private string $type;

    #[Groups('expense')]
    #[ORM\OneToOne]
    #[Assert\NotBlank]
    private Company $company;

    #[Groups('expense')]
    #[ORM\OneToOne]
    #[Assert\NotBlank]
    private Commercial $commercial;

    #[Groups('expense')]
    #[ORM\Column]
    #[Assert\NotBlank]
    #[Assert\LessThan('today')]
    #[Context(normalizationContext: [DateTimeNormalizer::FORMAT_KEY => 'Y-m-d'])]
    private DateTimeImmutable $paymentDate;

    public function __construct()
    {
        $this->setCreationDate();
    }

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

    public function getCompany(): Company
    {
        return $this->company;
    }

    public function getCommercial(): Commercial
    {
        return $this->commercial;
    }

    public function getPaymentDate(): DateTimeImmutable
    {
        return $this->paymentDate;
    }

    public function setAmount(float $amount): void
    {
        $this->amount = $amount;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function setCompany(Company $company): void
    {
        $this->company = $company;
    }

    public function setCommercial(Commercial $commercial): void
    {
        $this->commercial = $commercial;
    }

    public function setPaymentDate(DateTimeImmutable $paymentDate): void
    {
        $this->paymentDate = $paymentDate;
    }

    public static function getTypes(): array
    {
        return array_column(ExpenseReportsType::cases(), 'value');
    }
}
