<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Controller;
use Omnipay\Omnipay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Carbon\Carbon;
use App\user_addons_subscriptions;
use App\User_spotlight;
use App\Package;
use Laravel\Cashier\Cashier;
use Laravel\Cashier\Subscription;
use Laravel\Cashier\SubscriptionItem;
use App\PromoCode;
use App\user_subscriptions;


class SubcribtionsController extends Controller
{

    public $gateway;
    public $completePaymentUrl;
    
    
    public function __construct()
    {
        $this->gateway = Omnipay::create('Stripe\PaymentIntents');
        $this->gateway->setApiKey("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");
        $this->stripe = new \Stripe\StripeClient("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");

    }

    public function get_payment_mehtod()
    {
       $intent = Auth::user()->createSetupIntent();
       return response()->json(["status" => true , "intent" => $intent], 200);
    }
    public function buy_packages(request $request)
    {
        
        if($request->stripe_token)
        {
            $package = $request->all();
            $User = Auth::user();
            $token = $request->stripe_token;
            $response = $this->gateway->authorize([
                'amount' => $request->price,
                'currency' =>"USD",
                'description' => $request->type . " " . $request->title,
                'token' => $token["token"]["id"],
                'returnUrl' => "http://localhost:8080/",
                'confirm' => true,
            ])->send();
            if($response->isSuccessful())
            {
                $response = $this->gateway->capture([
                    'amount' => $request->price,
                    'currency' => 'USD',
                    'paymentIntentReference' => $response->getPaymentIntentReference(),
                ])->send();
                $arr_payment_data = $response->getData();
                $response = $this->gateway->authorize([
                    'amount' => $request->price,
                    'currency' =>"USD",
                    'description' => $request->type . " " . $request->title,
                    'token' => $token["token"]["id"],
                    'returnUrl' => "http://localhost:8080/",
                    'confirm' => true,
                ])->send();
                $this->create_payment($package,$User,$arr_payment_data,$merchant ="stripe");
                $subsciption = $this->create_subscriptions($User,$package);
                $this->send_notifications(array("title"=> "Purchase subscription" ,"body" => "your subscription has been successfull"));
                $resp =  array("status" => true , "message" => "payment successfully complete","package_datail" => $subsciption  , "response" => $arr_payment_data);
                return response()->json($resp,200);
            }
            else
            {
                $resp =  array("status" => false , "message" => $response->getMessage());
                return response()->json($resp,200);
            }
        }
        else
        {
            $response =  array("status" => false , "message" => "somthing went wrong","post_data" => $request->all());
            return response()->json($response,200);
        }
    }
    private function create_payment($package,$user,$arr_payment_data,$merchant ="")
    {
        $response = User::find($user->id)->User_payments()->create(
            array(
                "pkg_id" => $package["id"],
                "payment_id" => $arr_payment_data['id'],
                "currency" => 'USD',
                "amount" =>  $arr_payment_data['amount']/100,
                "payment_status" => $arr_payment_data['status'],
                "merchant" => $merchant,
            )  
        );
        return $response;
    }
  
    public function buy_packages_with_paypal(request $request)
    {
        $User = Auth::user();
        $arr_payment_data = $request->details;
        $package = $request->package_detail;
        $this->create_paypal_payment($package,$User,$arr_payment_data,$merchant ="paypal");
        $this->create_subscriptions($User,$package);
        return response()->json(["status" => true , "response" => $request->all()], 200);
    }

    private function create_paypal_payment($package,$user,$arr_payment_data,$merchant ="")
    {
        $response = User::find($user->id)->User_payments()->create(
            array(
                "pkg_id" => $package["id"],
                "payment_id" => $arr_payment_data['id'],
                "currency" => $arr_payment_data['purchase_units'][0]['amount']['currency_code'],
                "amount" =>  $arr_payment_data['purchase_units'][0]['amount']['value'],
                "payment_status" => $arr_payment_data['status'],
                "merchant" => $merchant,
            )  
        );
        return $response;
    }


    
    private function create_subscriptions($user,$package)
    {
        $date = Carbon::now();
        $start_date = Carbon::now();
        $pkg_addons = json_decode($package["options"]);
        $expire_date = $date->addDays($package["duration"]);
        $response = User::find($user->id)->user_subcribtion()->create(
            array(
                "pkg_id" => $package["id"],
                "pkg_name" => $package["title"],
                "stripe_sub_id" => $user["sub_id"],
                "pkg_catogery" => $package["packages_categery"]["slug"],
                "spotlights" => $package["spotlights"],
                "lovenotes" => $package["lovenotes"],
                "staring" =>  $start_date,
                "ending" => $expire_date,
                "status" => 1,
                "auto_renew" =>$user['auto_renew'],
            )
        );
        if(!empty($response)){
            if(!empty($pkg_addons)){
                foreach($pkg_addons as $pkg)
                {
                $addon_repsonse[] = user_addons_subscriptions::create(
                    array(
                            "subscribe_id" => $response->id,
                            "addon_name" => $pkg,
                            "status" => true
                        )
                );
                }
            }
        }
        if(!empty($response)  && $response->spotlights > 0 ){
           $spotlight_months =  $response->spotlights/4;
           $month = 0;
           $endmonth = 0;
           for($i = 0; $i<$spotlight_months; $i++)
           {
                $endmonth += 1;
                User_spotlight::create([
                    "subsciption_id" => $response->id,
                    "spotlight" => 4,
                    "assign_date" =>  Carbon::now()->addmonths($month),
                    "end_date" =>  Carbon::now()->addmonths($endmonth),
                ]);
                $month += 1;
            } 
         }
         else if(!empty($response)  && $response->spotlights > 0)
         {
               User_spotlight::create([
                   "subsciption_id" => $response->id,
                    "spotlight" => $response->spotlights,
                    "assign_date" =>  Carbon::now(),
                    "end_date" =>  Carbon::now()->addYear(1),
                ]);
         }
        return array($user,$response);
    }

    public function recurring(request $request)
    {
        try{
        $re = $request->all();
        $package = Package::findorfail($request->package_detail["id"]);
        $data["slug"] = strtolower($request->package_detail["packages_categery"]["title"] ." ".$request->package_detail["title"]);
        $price = $package->price *100;
     
        if(empty($package->stripe_plan)){ 
            $stripeProduct = $this->stripe->products->create([
                'name' => $data["slug"],
            ]);
           //Stripe Plan Creations
            $stripePlanCreation = $this->stripe->plans->create([
                'amount' => $price,
                'currency' => 'USD',
                'interval' => 'day', //  it can be day,week,month or year
                'interval_count' => $package->duration, 
                'product' => $stripeProduct->id,
            ]);
          $data['stripe_plan'] = $stripePlanCreation->id;
          $package->update(["stripe_plan" =>  $data['stripe_plan']]);
        }

        $user = Auth::user();
        $paymentMethod = $request->payment_method;
        $user->createOrGetStripeCustomer();
        $user->updateDefaultPaymentMethod($paymentMethod);
        $create =  $user->newSubscription('default',  $package->stripe_plan);
        if(!empty($request->voucher))
        {
            $create->withCoupon($request->voucher);
        }
        $response =  $create->create($paymentMethod, [
            'email' => $user->email,
        ]);
        if($response['stripe_status']=='active'){
             if($request->auto_renew == true){
                    $status = true;
            }else{
                $status = false;
                $duration = Carbon::now()->addDays($package->duration);
                $response->cancel();
            }
            $arr_payment_data['id']=  $response['stripe_id'];
            $arr_payment_data['status']=   $response['status'];
            $arr_payment_data['amount']= $price;
            $user['auto_renew']= $status;            
            $user['sub_id'] = $response['stripe_id'];
            $this->create_payment($package,$user,$arr_payment_data,$merchant ="stripe");
            $subsciption = $this->create_subscriptions($user,$package);
            $this->send_notifications(array("title"=> "Purchase subscription" ,"body" => "your subscription has been successfull"));   
             $user->subscriptions()->where('stripe_plan',$package->stripe_plan)->update(
                [
                    'trial_ends_at'=> Carbon::now()->addDays($package->duration),
                    'ends_at' => $duration ?? null
               
                ]
            );  
            return response()->json(['status'=>true, "message" => "subscription successfully purchased" ,'response'=>$response]);
          }  
        }
        catch(\Exception $e){
        return response()->json(['status'=>true, 'Exception' => $e]);
      }
    }
    public function getcoupon(request $request)
    {
        if(!empty($request->voucher))
        {
            $promo = PromoCode::where('code',$request->voucher)->first();
            if(!empty($promo))
            {
                return response()->json(['status'=>true,'promo'=>$promo], 200);
            }else{
                $error ='No Voucher found';
                 return response()->json( ['status'=>false, 'error'=>$error], 200);
            }
        }else{
                $error ='No Voucher found';
                 return response()->json(['status'=>false, 'error'=>$error], 200);
        }
    }
    public function pkg_info(request $request)
    {
      
       try{
            $response  = Subscription::where(["stripe_status" => "active"])->get();
            if(!empty($response))
            {
                foreach($response as $k => $v)
                {
                    $user = User::find($v->user_id);
                    $package = Package::where('stripe_plan',$v->stripe_plan)->first();
                    $data = $this->stripe->subscriptions->retrieve(
                      $v->stripe_id,
                      []
                    );
                    if(!empty($v->ends_at))
                    {
                        if($v->ends_at == Carbon::now())
                        {
                            $this->stripe->subscriptions->cancel(
                            $stripe_subscriptions->stripe_id,
                            []
                            );  
                            $stripe_subscriptions->update([
                                "ends_at" => Carbon::now() , "stripe_status" => "canceled"
                            ]); 
                        }
                       
                    }else{
                        if($v->trial_ends_at == Carbon::now())
                        {
                                $upcoming =  $this->stripe->invoices->upcoming([
                                            'customer' => $user->stripe_id,
                                            ]);
                               if(!empty($upcoming))
                               {
                                        $sub = Subscription::create([
                                        'stripe_id' => $upcoming['subscription'],
                                        'stripe_status' =>'active',
                                        'stripe_plan'=>$upcoming['lines']->data[0]->plan['id'],
                                        'quantity'=>$upcoming['lines']->data[0]->quantity,
                                        'trial_ends_at'=> Carbon::now()->addDays($package->duration),
                                        'ends_at'=>null
                                        ]);

                                        $sub_item = SubscriptionItem::create([
                                        'subscription_id'=>$sub->id,
                                        'stripe_id'=>$upcoming['lines']->data[0]->subscription_item,
                                        'stripe_plan'=>$package->stripe_plan,
                                        'quantity'=>$upcoming['lines']->data[0]->quantity,
                                        ]);

                                        $arr_payment_data['id']=  $sub['stripe_id'];
                                        $arr_payment_data['status']=   $sub['stripe_status'];
                                        $arr_payment_data['amount']= $upcoming['amount_remaining'];
                                        $user['auto_renew']= true;            
                                        $user['sub_id'] = $sub['stripe_id'];
                                        $this->create_payment($package,$user,$arr_payment_data,$merchant ="stripe");
                                        $subsciption = $this->create_subscriptions($user,$package);
                               }
                             
                        }
                    }

                }
          
            }           
            
        }
       catch(\Exception $e)
       {
        return $e->getMessage();
       }

      
       
    }
    public function cancel_subscription(request $request)
    {
        try{
        $user = Cashier::findBillable(auth::user()->stripe_id);
           $sub_id =  $user->subscriptions()->where('stripe_plan',$request->stripe_plan)->first();
   
       if(!empty($sub_id)){
              $response= $this->stripe->subscriptions->cancel(
                $sub_id->stripe_id,
                []
                );
              return $response;
         }
        }catch(\Exception $e){
         return response()->json(['success'=>false, 'error'=>$e->getMessage()]);

        }
    }


    public function trail_package()
    {
       $subsciption =  user_subscriptions::all();
       
    }




}
