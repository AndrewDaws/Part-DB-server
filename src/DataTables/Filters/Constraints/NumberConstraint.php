<?php

namespace App\DataTables\Filters\Constraints;

use Doctrine\ORM\QueryBuilder;
use \RuntimeException;

class NumberConstraint extends AbstractConstraint
{
    public const ALLOWED_OPERATOR_VALUES = ['=', '!=', '<', '>', '<=', '>=', 'BETWEEN'];


    /**
     * The value1 used for comparison (this is the main one used for all mono-value comparisons)
     * @var float|null|int|\DateTimeInterface
     */
    protected $value1;

    /**
     * The second value used when operator is RANGE; this is the upper bound of the range
     * @var float|null|int|\DateTimeInterface
     */
    protected $value2;

    /**
     * @var string The operator to use
     */
    protected $operator;

    /**
     * @return float|int|null|\DateTimeInterface
     */
    public function getValue1()
    {
        return $this->value1;
    }

    /**
     * @param  float|int|\DateTimeInterface|null  $value1
     */
    public function setValue1($value1): void
    {
        $this->value1 = $value1;
    }

    /**
     * @return float|int|null
     */
    public function getValue2()
    {
        return $this->value2;
    }

    /**
     * @param  float|int|null  $value2
     */
    public function setValue2($value2): void
    {
        $this->value2 = $value2;
    }

    /**
     * @return string
     */
    public function getOperator(): string
    {
        return $this->operator;
    }

    /**
     * @param  string  $operator
     */
    public function setOperator(?string $operator): void
    {
        $this->operator = $operator;
    }


    public function __construct(string $property, string $identifier = null, $value1 = null, $operator = '>', $value2 = null)
    {
        parent::__construct($property, $identifier);
        $this->value1 = $value1;
        $this->value2 = $value2;
        $this->operator = $operator;
    }

    public function isEnabled(): bool
    {
        return $this->value1 !== null
            && !empty($this->operator);
    }

    public function apply(QueryBuilder $queryBuilder): void
    {
        //If no value is provided then we do not apply a filter
        if ($this->value1 === null) {
            return;
        }

        //Ensure we have an valid operator
        if(!in_array($this->operator, self::ALLOWED_OPERATOR_VALUES, true)) {
            throw new \RuntimeException('Invalid operator '. $this->operator . ' provided. Valid operators are '. implode(', ', self::ALLOWED_OPERATOR_VALUES));
        }

        if ($this->operator !== 'BETWEEN') {
            $this->addSimpleAndConstraint($queryBuilder, $this->property, $this->identifier, $this->operator, $this->value1);
        }  else {
            if ($this->value2 === null) {
                throw new RuntimeException("Cannot use operator BETWEEN without value2!");
            }

            $this->addSimpleAndConstraint($queryBuilder, $this->property, $this->identifier . '1', '>=', $this->value1);
            $this->addSimpleAndConstraint($queryBuilder, $this->property, $this->identifier . '2', '<=', $this->value2);
        }
    }
}