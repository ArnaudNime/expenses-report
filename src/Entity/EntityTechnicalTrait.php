<?php
declare(strict_types=1);

namespace App\Entity;

use DateTimeImmutable;
use DateTimeZone;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Exception\InvalidArgumentException;
use Throwable;

trait EntityTechnicalTrait
{

    #[ORM\Column]
    #[Assert\NotBlank]
    private DateTimeImmutable $creationDate;

    public function getCreationDate(): DateTimeImmutable
    {
        return $this->creationDate;
    }

    public function setCreationDate(): void
    {
        try {
            $this->creationDate = new DateTimeImmutable('now', new DateTimeZone('Z'));
        } catch (Throwable $e) {
            throw new InvalidArgumentException(sprintf('creation_date was not generated (%s)', $e->getMessage()));
        }
    }

    public function formatString(string $data) : string
    {
        return strtolower(trim($data));
    }
}
