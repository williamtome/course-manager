<?php

use PHPUnit\Framework\TestCase;

class CursosControllerTest extends TestCase
{
    private $data;

    protected function setUp(): void
    {
        $this->data = [
            'Symfony 1',
            'Symfony 2',
            'Doctrine',
            'Primeiros passos com PHP',
        ];
    }

    /**
     * @test
     */
    public function showAllCourses()
    {
        $this->assertEquals('Symfony 1', $this->data[0]);
        $this->assertEquals('Symfony 2', $this->data[1]);
        $this->assertEquals('Doctrine', $this->data[2]);
        $this->assertEquals('Primeiros passos com PHP', $this->data[3]);
    }

    /**
     * @test
     */
    public function countCourses()
    {
        $this->assertCount(4, $this->data);
    }
}