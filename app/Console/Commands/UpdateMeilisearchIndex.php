<?php

namespace App\Console\Commands;

use MeiliSearch\Client;
use Illuminate\Console\Command;

class UpdateMeilisearchIndex extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'meilisearch:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Update Meilisearch's index and filterable attributes";

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $client = new Client(config('scout.meilisearch.host'), config('scout.meilisearch.key'));

        $this->updateSortableAttributes($client);

        $this->updateFilterableAttributes($client);

        return Command::SUCCESS;
    }

    protected function updateSortableAttributes(Client $client): void
    {
        $client->index('properties')->updateSortableAttributes([
            'id',
            'rent',
        ]);

        $this->info('Updated sortable attributes...');
    }

    protected function updateFilterableAttributes(Client $client): void
    {
        $client->index('properties')->updateFilterableAttributes([
            'bhk_id',
            'property_type_id',
            'flooring_id',
            'furnishing_id',
            'locality_id',
            'Lift', 'Parking', 'Power Backup', 'Security', 'Swimming Pool', "Pets Friendly", "Bachelor Friendly", "Student Friendly", "Couples Friendly", "Family Friendly"
        ]);

        $this->info('Updated filterable attributes...');
    }
}
