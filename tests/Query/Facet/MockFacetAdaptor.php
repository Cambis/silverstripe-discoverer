<?php

namespace SilverStripe\Search\Tests\Query\Facet;

use SilverStripe\Search\Query\Facet\FacetAdaptor;
use SilverStripe\Search\Query\Facet\FacetCollection;

class MockFacetAdaptor implements FacetAdaptor
{

    public function prepareFacets(FacetCollection $facetCollection): mixed
    {
        $preparedFacets = [];

        foreach ($facetCollection->getFacets() as $facet) {
            $preparedFacet = [
                'limit' => $facet->getLimit(),
                'name' => $facet->getName(),
                'property' => $facet->getProperty(),
                'type' => $facet->getType(),
                'locationUnit' => $facet->getLocation()?->getUnit(),
                'locationLatitude' => $facet->getLocation()?->getLatitude(),
                'locationLongitude' => $facet->getLocation()?->getLongitude(),
                'ranges' => [],
            ];

            foreach ($facet->getRanges() as $range) {
                $preparedFacet['ranges'][] = [
                    'from' => $range->getFrom(),
                    'to' => $range->getTo(),
                    'name' => $range->getName(),
                ];
            }

            $preparedFacets[] = $preparedFacet;
        }

        return $preparedFacets;
    }

}
