<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Import;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function has_transactions()
    {
        $user = factory(User::class)->create();

        $this->assertInstanceOf(Collection::class, $user->transactions);
    }

    /** @test */
    public function has_imports()
    {
        $user = factory(User::class)->create();

        $this->assertInstanceOf(Collection::class, $user->imports);
    }

    /** @test */
    public function can_have_inprogress_imports()
    {
        $user = factory(User::class)->create();

        $user->imports()->saveMany([
            factory(Import::class)->state('submitted')->create(),
            factory(Import::class)->state('mapped')->create(),
            factory(Import::class)->state('completed')->create(),
        ]);

        $this->assertCount(2, $user->inProgressImports);
    }
}
