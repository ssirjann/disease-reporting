<?php

namespace App\Console\Commands;

use App\Disease;
use Illuminate\Console\Command;

class LoadData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dr:load-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Load the data of diseases into the database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info("Inserting: diseases");
        $diseases = config('diseases');

        foreach ($diseases as $disease) {
            Disease::create(['name' => $disease]);
        }

        $this->info("Inserted: diseases");
        $this->info("Dataload complete");
    }
}
