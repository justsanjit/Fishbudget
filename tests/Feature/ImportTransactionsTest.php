<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Http\UploadedFile as IlluminateUploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ImportTransactionsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_import_transactions_in_csv_format()
    {
        Storage::fake('local');
        $file = IlluminateUploadedFile::fake()->create('transactions.csv', 250);

        $response = $this->post('transactions/import', ['file' => $file]);

        Storage::disk('local')->assertExists('imports/' . $file->hashName());
        $this->assertDatabaseHas('imports', ['file' => $file->hashName()]);
        $response->assertSessionHas('success');
    }

    /** @test */
    public function file_is_required_for_import()
    {
        $response = $this->post('transactions/import', ['file' => null]);

        $response->assertSessionHasErrors('file');
    }

    /** @test */
    public function file_must_have_csv_or_txt_extension_for_import()
    {
        $file = IlluminateUploadedFile::fake()->create('transactions.notcsv', 250);

        $response = $this->post('transactions/import', ['file' => $file]);

        $response->assertSessionHasErrors('file');
    }
}
