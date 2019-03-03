<?php

namespace Tests\Feature\Import;

use App\Import;
use Illuminate\Filesystem\FilesystemAdapter;
use App\User;

trait ImportHelper
{
    /**
     * Creates csv import file at provided path in given storage
     *
     * @param $storage \Illuminate\Filesystem\FilesystemAdapter
     * @param $path String
     *
     * @return void
     */
    private function createTestCsv(FilesystemAdapter $storage, String $path) : void
    {
        $content = [
            ['3/1/2019', -833.33, '-', 'Customer Transfer Dr.', ''],
            ['2/28/2019', -223.27, '-', 'Bill Payment', 'MB-BEST BUY DESJARDINS'],
            ['2/28/2019', 0, '-', 'Service Charge', 'MB-FREE EMAIL MONEY TRF'],
            ['2/28/2019', -450, '-', 'WITHDRAWAL', 'MB-EMAIL MONEY TRF'],
        ];

        $file = fopen('php://temp', 'w');

        foreach ($content as $row) {
            fputcsv($file, $row);
        }

        $storage->put($path, $file);

        fclose($file);
    }

    /**
     * Create import in the application with submit status for a given user
     *
     * @param $user App\User
     * @param $path String
     * @param \Illuminate\Filesystem\FilesystemAdapter
     *
     * @return App\Import
     */
    private function submitTestImportFor(User $user, String $path, FilesystemAdapter $storage) : Import
    {
        $this->createTestCsv($storage, $path);

        // Create import record in database
        $attributes = [
            'file' => 'testimport.csv',
            'status' => 'submitted',
            'user_id' => $user->id,
        ];

        return factory(Import::class)->create($attributes);
    }
}
