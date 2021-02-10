<?php declare(strict_types = 1);

namespace Tests\Test;

use PHPUnit\Framework\TestCase;

final class Test extends TestCase
{
    /**
     * @test
     */
    public function dummyPassingTest()
    {
        $this->assertTrue(true);
    }

    public function blank()
    {
        $this->markTestIncomplete('TODO');
    }
}
