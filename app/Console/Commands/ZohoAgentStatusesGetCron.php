<?php

namespace App\Console\Commands;

use App\Models\AgentStatus;
use Illuminate\Console\Command;

class ZohoAgentStatusesGetCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'zoho:agent-statuses-get';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get agents statuses data in pull it in database.';

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
        (new AgentStatus())->fillTable();
    }
}
