<?php

namespace App\Console\Commands;

use App\Jobs\SendSubscriptionExpireMessageJob;
use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SubscriptionExpiryNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscription:SubscriptionExpiryNotification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check which subscribed user have been expired';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $expired_customers = Customer::where('subscription_end_date', '<', now())->get();
        foreach ($expired_customers as $customer){
            $expiredDate = Carbon::createFromFormat('Y-m-d', $customer->subscription_end_date)->toDateString();
        }

        //dispatch(new SendSubscriptionExpireMessageJob($customer, $expiredDate));
        return Command::SUCCESS;
    }
}
