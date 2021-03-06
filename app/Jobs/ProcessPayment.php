<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Bus\Batchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Customer;
use Carbon\Carbon;

class ProcessPayment implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $phone;
    public function __construct($phone)
    {
        $this->phone = $phone;
    }


    public function handle()
    {
        // send sop request with customers phone number
        // if customer pays {

        // }else{

        // }
        
        $today = Carbon::now();
        // this is if customer pays
        $customer = Customer::where('phone',$this->phone)->get();
        if(!$customer->isEmpty()){
            foreach($customer as $custom){
                $custom->payingDate = $today->addDays(1);
                $custom->save();
            }
        }
        

    }

    // invoked if a given job has failed
    public function failed(Throwable $exception)
    {
        // Send user notification of failure, etc...
    }
}
