<?php

namespace SilverStripe\Search\Query\Facet;

use Exception;
use SilverStripe\Core\Injector\Injectable;

/**
 * Class properties need to be public, so that they can be searched within an ArrayList. Getters are also provided, as
 * those still work within SS templates
 */
class Facet
{

    use Injectable;

    public const TYPE_VALUE = 'VALUE';
    public const TYPE_RANGE = 'RANGE';

    public const TYPES = [
        self::TYPE_VALUE,
        self::TYPE_RANGE,
    ];

    private ?int $limit = null;

    private ?FacetLocation $location = null;

    private ?string $name = null;

    private ?string $property = null;

    /**
     * @var FacetRange[]
     */
    private array $ranges = [];

    private ?string $type = null;

    public function getLimit(): ?int
    {
        return $this->limit;
    }

    public function setLimit(?int $limit): self
    {
        $this->limit = $limit;

        return $this;
    }

    public function getLocation(): ?FacetLocation
    {
        return $this->location;
    }

    public function setLocation(
        ?string $unit = null,
        ?float $latitude = null,
        ?float $longitude = null
    ): Facet {
        $location = FacetLocation::create($unit, $latitude, $longitude);

        $this->location = $location;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getProperty(): ?string
    {
        return $this->property;
    }

    public function setProperty(?string $property): self
    {
        $this->property = $property;

        return $this;
    }

    public function getRanges(): array
    {
        return $this->ranges;
    }

    public function addRange(
        string|int|float|null $from = null,
        string|int|float|null $to = null,
        string $name = null
    ): self {
        $range = FacetRange::create($from, $to, $name);

        $this->ranges[] = $range;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @throws Exception
     */
    public function setType(?string $type): self
    {
        if (!in_array($type, self::TYPES)) {
            throw new Exception(sprintf('Invalid type "%s" provided', $type));
        }

        $this->type = $type;

        return $this;
    }

}
