<?php

namespace App\Http\Controllers;
use App\User;
use Stripe;
use Illuminate\Http\Request;

class StripeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        return view('stripe.index',['id' => $id]);
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
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $customer = Stripe\Customer::create ([
                "name" => $request->card_name,
                "source" => $request->stripeToken
        ]);

        $user = User::find($id);
        $user->stripe_customer_id = $customer->id;
        $user->stripe_card_id = $customer->sources->data[0]->id;
        $user->last_4_digits = $customer->sources->data[0]->last4;
        $user->exp_month = $customer->sources->data[0]->exp_month;
        $user->exp_year = $customer->sources->data[0]->exp_year;        
        $user->save();

        return redirect()->route('home')
            ->with('success','Stripe Account created successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function delete_card($id){
        $user = User::find($id);
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $card = Stripe\Customer::deleteSource(
            $user->stripe_customer_id,
            $user->stripe_card_id
        );
        
        $user = User::find($id);
        $user->stripe_customer_id = null;
        $user->stripe_card_id = null;
        $user->last_4_digits = null;
        $user->exp_month = null;
        $user->exp_year = null;        
        $user->save();

        return redirect()->route('home')
            ->with('success','User card deleted successfully');
    }
}
