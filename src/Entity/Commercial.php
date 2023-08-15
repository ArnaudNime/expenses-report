<?php
declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Entity\ExpenseReport\ExpenseReport;
use DateTimeImmutable;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Context;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Validator\Constraints as Assert;

#[ApiResource(
    operations: [
        new Get(
            uriTemplate: '/commercial/{id}',
            requirements: ['id' => '\d+'],
        ),
        new GetCollection(),
        new Post(
            uriTemplate: '/commercial',
        ),
        new Put(
            uriTemplate: '/commercial/{id}',
            requirements: ['id' => '\d+'],
        ),
        new Delete(
            uriTemplate: '/commercial/{id}',
            requirements: ['id' => '\d+'],
        ),
    ],
)]
#[ORM\Entity]
class Commercial
{
    use EntityTechnicalTrait;

    #[ORM\Id, ORM\Column, ORM\GeneratedValue]
    #[Groups('expense')]
    private int $id;

    #[ORM\Column]
    #[Assert\NotBlank]
    #[Assert\Length(max: 80)]
    #[Groups('expense')]
    private string $firstname;

    #[ORM\Column]
    #[Assert\NotBlank]
    #[Assert\Length(max: 80)]
    #[Groups('expense')]
    private string $lastname;

    #[ORM\Column]
    #[Assert\LessThan('today')]
    #[Assert\NotBlank]
    #[Context([DateTimeNormalizer::FORMAT_KEY => 'Y-m-d'])]
    private DateTimeImmutable $birthdate;

    #[ORM\Column]
    #[Assert\NotBlank]
    #[Assert\Email]
    #[Assert\Length(max: 80)]
    #[Groups('expense')]
    private string $email;

    #[ORM\OneToMany(mappedBy: 'commercial', targetEntity: ExpenseReport::class)]
    private Collection $expenseReports;

    public function __construct()
    {
        $this->setCreationDate();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getFirstname(): string
    {
        return $this->firstname;
    }

    public function getLastname(): string
    {
        return $this->lastname;
    }

    public function getBirthdate(): DateTimeImmutable
    {
        return $this->birthdate;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setFirstname(string $firstname): void
    {
        $this->firstname = $this->formatString($firstname);
    }

    public function setLastname(string $lastname): void
    {
        $this->lastname = $this->formatString($lastname);
    }

    public function setBirthdate(DateTimeImmutable $birthdate): void
    {
        $this->birthdate = $birthdate;
    }

    public function setEmail(string $email): void
    {
        $this->email = $this->formatString($email);
    }
}
