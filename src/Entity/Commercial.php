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
final class Commercial
{
    #[ORM\Id, ORM\Column, ORM\GeneratedValue]
    private int $id;


    public function getId(): int
    {
        return $this->id;
    }


}
