<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Laravel\Cashier\Cashier;
use App\User;
use Auth;
use Carbon\Carbon;
class StripecashierCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stripe:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return int
     */
    public function handle()
    {
    //    if(Auth::check())
    //    {
    //         $stripe =  new \Stripe\StripeClient("sk_test_51JIdZVJehHGbCsaCtO53jxO0sNp5ENohIDu08KlDU7Xh5AroEdegLfy0bnjOd3rtfsAhJA19TiE2mEspXsFwGjdr00lF3TxhRG");
    //         $user = Auth::user();
    //         $loca_sub = $user->subscriptions()->get();
                
    //                 foreach( $loca_sub as $key=> $val)
    //                 {
    //                         if(!empty($val->stripe_id))
    //                         {
    //                                 $response =  $this->stripe->subscriptions->retrieve( $val->stripe_id ,  []  );
    //                                if($val->stripe_status == 'active')
    //                                 {
    //                                     if($response['status'] == 'canceled')
    //                                     {
    //                                         $user->subscriptions()->where('stripe_id',$val->stripe_id)->update([
    //                                             'stripe_status' => "canceled",
    //                                             "ends_at" => Carbon::now()
    //                                         ]);                                        
    //                                     }
    //                                 }
    //                         }
                    
    //                 }
          
    //    }
    }
}
