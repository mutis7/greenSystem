<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Payment;
use App\User;

class PaymentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function __construct(){
        $this->middleware('admin');
    }

    public function index()
    {
        //get all the records of the payments
        $payments = Payment::paginate(15);
        // return $payments;

        return view('payment.payments', [
            'payments'=> $payments
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::where('status','active')
        ->where('role','user')->get();
        return view('payment.paymentcreate',[
           'users'=>$users
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //get user from the table who meets the form submitted conditions
        $user = User::where([
            ['last_name',"$request->last_name"],
            ['first_name', "$request->first_name"],
            ['email',"$request->email"],
            ])->first();
        
        $status = $user->status;
        if($status=="inactive"){
            echo "the user is not activated";

        } else{

            $userId = $user->id;
            $payment = new Payment;
            $payment->amount = $request->amount;
            $payment->user_id = $userId;
            $payment->save();
        }

         return redirect('/payments');
        
               

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
        //
        $payment = Payment::findOrFail($id);
        return view('payment.paymentedit', ['payment'=>$payment]);
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
        //
        $payment  = Payment::findOrFail($id);

        $payment->update($request->all());

        return redirect('/payments');
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
        $payment  = Payment::findOrFail($id);
        $payment->delete();
        return redirect('/payments');
    }
}
