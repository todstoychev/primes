<?php

namespace Tests\Todstoychev\PrimesBundle\Generator;

use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
use Todstoychev\PrimesBundle\Exception\AttributeNotSetException;
use Todstoychev\PrimesBundle\Generator\TableGenerator;

class TableGeneratorTest extends TestCase
{
    /**
     * @var \Todstoychev\PrimesBundle\Generator\TableGenerator
     */
    private $tableGenerator;

    /**
     * @var array
     */
    private $columns;

    protected function setUp()
    {
        $this->tableGenerator = new TableGenerator();
        $this->columns = [2, 3, 5, 7, 11, 13, 17, 19, 23, 29];;
    }

    public function testTableGeneration()
    {
        $expected = file_get_contents(__DIR__.'/../../../fixtures/table_output.txt');
        $result = $this->tableGenerator->setColumns($this->columns)
                                       ->generate()
        ;

        static::assertEquals($expected, $result);
    }

    public function testTableGenerationWithNoColumnsSet()
    {
        static::expectException(AttributeNotSetException::class);
        $this->tableGenerator->generate();
    }

    public function testSetColumns()
    {
        $result = $this->tableGenerator->setColumns($this->columns);
        static::assertInstanceOf(TableGenerator::class, $result);
        static::assertAttributeEquals($this->columns, 'columns', $this->tableGenerator);
    }

    public function testGenerateRowsData()
    {
        $expected = [
            2 => [
                2 => 4,
                3 => 6,
                5 => 10,
                7 => 14,
                11 => 22,
                13 => 26,
                17 => 34,
                19 => 38,
                23 => 46,
                29 => 58,
            ],
            3 => [
                2 => 6,
                3 => 9,
                5 => 15,
                7 => 21,
                11 => 33,
                13 => 39,
                17 => 51,
                19 => 57,
                23 => 69,
                29 => 87,
            ],
            5 => [
                2 => 10,
                3 => 15,
                5 => 25,
                7 => 35,
                11 => 55,
                13 => 65,
                17 => 85,
                19 => 95,
                23 => 115,
                29 => 145,
            ],
            7 => [
                2 => 14,
                3 => 21,
                5 => 35,
                7 => 49,
                11 => 77,
                13 => 91,
                17 => 119,
                19 => 133,
                23 => 161,
                29 => 203,
            ],
            11 => [
                2 => 22,
                3 => 33,
                5 => 55,
                7 => 77,
                11 => 121,
                13 => 143,
                17 => 187,
                19 => 209,
                23 => 253,
                29 => 319,
            ],
            13 => [
                2 => 26,
                3 => 39,
                5 => 65,
                7 => 91,
                11 => 143,
                13 => 169,
                17 => 221,
                19 => 247,
                23 => 299,
                29 => 377,
            ],
            17 => [
                2 => 34,
                3 => 51,
                5 => 85,
                7 => 119,
                11 => 187,
                13 => 221,
                17 => 289,
                19 => 323,
                23 => 391,
                29 => 493,
            ],
            19 => [
                2 => 38,
                3 => 57,
                5 => 95,
                7 => 133,
                11 => 209,
                13 => 247,
                17 => 323,
                19 => 361,
                23 => 437,
                29 => 551,
            ],
            23 => [
                2 => 46,
                3 => 69,
                5 => 115,
                7 => 161,
                11 => 253,
                13 => 299,
                17 => 391,
                19 => 437,
                23 => 529,
                29 => 667,
            ],
            29 => [
                2 => 58,
                3 => 87,
                5 => 145,
                7 => 203,
                11 => 319,
                13 => 377,
                17 => 493,
                19 => 551,
                23 => 667,
                29 => 841,
            ],
        ];
        $this->tableGenerator->setColumns($this->columns);
        $class = new \ReflectionClass($this->tableGenerator);
        $method = $class->getMethod('generateRowsData');
        $method->setAccessible(true);
        $result = $method->invokeArgs($this->tableGenerator, []);
        static::assertEquals($expected, $result);
    }

    public function testGenerateBorder()
    {
        $expected = '-----------------------------------------------------------------------------------------------------------------------------------------------';
        $this->tableGenerator->setColumns($this->columns);
        $class = new \ReflectionClass($this->tableGenerator);
        $method = $class->getMethod('generateBorder');
        $method->setAccessible(true);
        $result = $method->invokeArgs($this->tableGenerator, [10]);

        static::assertEquals($expected, $result);
    }

    public function testGenerateSpaces()
    {
        $expected = '          ';
        $this->tableGenerator->setColumns($this->columns);
        $class = new \ReflectionClass($this->tableGenerator);
        $method = $class->getMethod('generateSpaces');
        $method->setAccessible(true);
        $result = $method->invokeArgs($this->tableGenerator, [10]);

        static::assertEquals($expected, $result);
    }
}
