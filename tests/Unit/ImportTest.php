<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Import;

class ImportTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function scope_in_progress_imports()
    {
        factory('App\Import')->state('submitted')->create();
        factory('App\Import')->state('mapped')->create();
        factory('App\Import')->state('completed')->create();

        $this->assertCount(2, Import::inProgress()->get());
    }
}
