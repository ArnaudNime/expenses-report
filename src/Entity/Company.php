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
final class Company
{
    #[ORM\Id, ORM\Column, ORM\GeneratedValue]
    private int $id;
    #[ORM\Column]
    #[Assert\NotBlank]
    private string $name;
    #[ORM\Column]
    #[Assert\NotBlank]
    private string $email;
    #[ORM\Column]
    #[Assert\NotBlank]
    private DateTime $creationDate;

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

    public function getCreationDate(): DateTime
    {
        return $this->creationDate;
    }
}
