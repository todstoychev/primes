<?php

namespace Todstoychev\PrimesBundle\Generator;

use Todstoychev\PrimesBundle\Exception\AttributeNotSetException;

class TableGenerator
{
    /**
     * @var array
     */
    protected $columns;

    /**
     * @var array
     */
    protected $rows;

    /**
     * @var int
     */
    protected $maxCellWidth;

    /**
     * @param array $columns
     *
     * @return \Todstoychev\PrimesBundle\Generator\TableGenerator
     */
    public function setColumns(array $columns)
    {
        $this->columns = $columns;

        return $this;
    }

    /**
     * @return array
     */
    public function getColumns(): array
    {
        if (empty($this->columns)) {
            throw new AttributeNotSetException('No data set for "columns" attribute!');
        }

        return $this->columns;
    }

    /**
     * @return array
     */
    protected function generateRowsData()
    {
        foreach ($this->getColumns() as $row) {
            foreach ($this->getColumns() as $col) {
                $result = $row * $col;
                $this->rows[$row][$col] = $row * $col;

                if (strlen($result) > $this->maxCellWidth) {
                    $this->maxCellWidth = strlen($result);
                }
            }
        }

        return $this->rows;
    }

    /**
     * @param int $maxCellWidth
     *
     * @return string
     */
    protected function generateBorder(int $maxCellWidth): string
    {
        $cellWidth = $maxCellWidth + 3;
        $cellsInRow = count($this->getColumns()) + 1;
        $border = '';

        for ($i = 0; $i < $cellWidth * $cellsInRow; $i++) {
            $border .= '-';
        }

        return $border;
    }

    /**
     * @param int $count
     *
     * @return string
     */
    protected function generateSpaces(int $count): string
    {
        $string = '';

        for ($i = 0; $i < $count; $i++) {
            $string .= ' ';
        }

        return $string;
    }

    /**
     * @return string
     */
    public function generate(): string
    {
        $this->generateRowsData();
        $border = $this->generateBorder($this->maxCellWidth);

        // Table header
        $table = ' '.$border." \n";
        $table .= '| ';
        $table .= $this->generateSpaces($this->maxCellWidth);
        $table .= ' |';

        foreach ($this->getColumns() as $column) {
            $table .= ' '.$column.$this->generateSpaces($this->maxCellWidth - strlen($column)).' |';
        }

        $table .= "\n";
        $table .= ' '.$border." \n";

        // Table body
        foreach ($this->rows as $header => $row) {
            $table .= '| '.$header.$this->generateSpaces($this->maxCellWidth - strlen($header)).' |';

            foreach ($row as $data) {
                $table .= ' '.$data.$this->generateSpaces($this->maxCellWidth - strlen($data)).' |';
            }

            $table .= "\n ".$border." \n";
        }

        return $table;
    }
}