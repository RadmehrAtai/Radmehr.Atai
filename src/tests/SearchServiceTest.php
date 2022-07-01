<?php

namespace App\Tests;

use App\Search\SearchService;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class SearchServiceTest extends KernelTestCase
{

    public function testSearch(): void
    {
        self::bootKernel();

        $container = static::getContainer();

        /** @var SearchService $searchService */
        $searchService = $container->get(SearchService::class);

        $result = $searchService->search("Parsian");
        $this->assertEmpty($result);
    }
}
