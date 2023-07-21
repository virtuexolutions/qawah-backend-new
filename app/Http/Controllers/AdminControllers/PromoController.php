<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\PromoCode;
use Str;
class PromoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->stripe = new \Stripe\StripeClient("sk_test_51JIdZVJehHGbCsaCtO53jxO0sNp5ENohIDu08KlDU7Xh5AroEdegLfy0bnjOd3rtfsAhJA19TiE2mEspXsFwGjdr00lF3TxhRG");


    }
    public function index()
    {
        $promos = PromoCode::all();
     return view('admin.views.promos.index',compact('promos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
     return view('admin.views.promos.add');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {try{
        $validator = Validator::make($request->all(),[
            'code'=>'required|string',
            'percent'=>'required|numeric|min:1|max:100',
        ]);
        if($validator->fails())
        {
            return redirect()->back()->with(['error'=>$validator->errors()]);
        }
         $promos = PromoCode::create(
            [
                'code' =>$request->code,
                'percent'=>$request->percent,
            ]
            );
            $this->stripe->coupons->create(
                ['duration' => 'once', 'id' => $promos->code, 'percent_off' =>$promos->percent]
                );
      return redirect()->route('promos.index')->with(['success'=>'Record Stored Successfully']);
	}catch(\Exception $e)
	{
		      return redirect()->back()->with(['error'=>$e->getMessage()]);

	}
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		try{
         $promo = PromoCode::find($id);
        return view('admin.views.promos.edit',compact('promo'));
}catch(\Exception $e)
	{
		      return redirect()->back()->with(['error'=>$e->getMessage()]);

	}
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
try{
	$validator = Validator::make($request->all(),[
            'code'=>'string',
            'percent'=>'numeric|min:1|max:100',
        ]);
        if($validator->fails())
        {
            return redirect()->back()->with(['error'=>$validator->errors()]);
        }
         $promos = PromoCode::where('id',$id)->update(
            [
                'code' =>$request->code,
                'percent'=>$request->percent,
            ]
            );
        return redirect()->route('promos.index')->with(['success'=>'Record Updated Successfully']);
}catch(\Exception $e)
	{
		      return redirect()->back()->with(['error'=>$e->getMessage()]);

	}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		
         $promo = PromoCode::find($id);
         $this->stripe->coupons->delete($promo->code, []);
         $promo->delete();
         return back()->with(['success'=>'Record deleted Successfully']);
			
    }
}
