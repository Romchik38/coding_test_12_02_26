<?php

declare(strict_types=1);

namespace App\Tests\Unit\Domain\VO;

use App\Domain\Carrier\VO\Slug;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class SlugTest extends TestCase
{
    public function testEmptyString(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new Slug('');
    }
}
