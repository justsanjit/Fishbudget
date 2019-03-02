<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Transaction;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TransactionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function belongs_to_user()
    {
        $transaction = factory(Transaction::class)->create();

        $this->assertInstanceOf(User::class, $transaction->user);
    }
}
