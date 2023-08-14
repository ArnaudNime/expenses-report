<?php
declare(strict_types=1);

namespace App\Tests\tu\entity;

use App\Entity\EntityTechnicalTrait;
use PHPUnit\Framework\TestCase;

class EntityTechnicalTraitTest extends TestCase
{
    use EntityTechnicalTrait;

    private const DATA = 'data';

    public function testFormatStringToLower(): void
    {
        $this->assertEquals(self::DATA, $this->formatString('DAta'));
    }

    public function testFormatStringWithTrim(): void
    {
        $this->assertEquals(self::DATA, $this->formatString(' data   '));
    }

    public function testFormatStringWithBoth(): void
    {
        $this->assertEquals(self::DATA, $this->formatString(' dAta   '));
    }

    public function testSetCreationDate(): void
    {
        $this->assertFalse(isset($this->creationDate));
        $this->setCreationDate();
        $this->assertTrue(isset($this->creationDate));
    }
}
