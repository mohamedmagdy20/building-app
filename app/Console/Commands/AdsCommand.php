<?php

namespace App\Console\Commands;

use App\Models\Advertisment;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class AdsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ads.cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $today = Carbon::today();
        $advertisments = Advertisment::where('abroved',true)->where('is_expire',false)->where('ads_type','!=','draft')->get();
        foreach($advertisments as $item)
        {
            $updated_at = Carbon::parse($item->updated_at);
            $expiration = $updated_at->addDays(30);
            if($today->gte($expiration))
            {
                $item->update(['is_expire'=>true]);
                Log::info("Cron is working fine!");
            }
        }
        // return Command::SUCCESS;
    }
}
