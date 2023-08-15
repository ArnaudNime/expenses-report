<?php
declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ApiResource(
    operations: [
        new Get(
            uriTemplate: '/company/{id}',
            requirements: ['id' => '\d+'],
        ),
        new GetCollection(),
        new Post(
            uriTemplate: '/company',
        ),
        new Put(
            uriTemplate: '/company/{id}',
            requirements: ['id' => '\d+'],
        ),
        new Delete(
            uriTemplate: '/company/{id}',
            requirements: ['id' => '\d+'],
        ),
    ],
)]
#[ORM\Entity]
class Company
{
    use EntityTechnicalTrait;

    #[ORM\Id, ORM\Column, ORM\GeneratedValue]
    #[Groups('expense')]
    private int $id;

    #[ORM\Column]
    #[Assert\NotBlank]
    #[Assert\Length(max: 80)]
    #[Groups('expense')]
    private string $name;

    #[ORM\Column]
    #[Assert\NotBlank]
    #[Assert\Email]
    #[Assert\Length(max: 80)]
    #[Groups('expense')]
    private string $email;

    #[ORM\OneToMany(mappedBy: 'company', targetEntity: ExpenseReport::class)]
    private Collection $expenseReports;

    public function __construct()
    {
        $this->setCreationDate();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setName(string $name): void
    {
        $this->name = $this->formatString($name);
    }

    public function setEmail(string $email): void
    {
        $this->email = $this->formatString($email);
    }
}
