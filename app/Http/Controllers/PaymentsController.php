<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Payment;
use App\House;
use App\MessageNotification\SmsMessages;
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
        $payments = Payment::leftJoin('houses', 'houses.id', 'payments.house_id')
         ->select('payments.id', 'payments.amount', 'payments.created_at', 'payments.payer', 'houses.house')
         ->paginate(25);
                

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
        
        return view('payment.paymentcreate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'house' => 'required',
            'name' => 'required',
            'amount' => 'required|numeric']);
        $house = House::where('house', $request->house)->first();
        if($house==null){
            return back()->with('message', 'house '.$request->house.' does not exist try again');
        } else if($house->status=='pending'){
            return back()->with('message', 'house '.$request->house.' has not been activated by the admin');   
        } else{
            $payment = new Payment;            
            $payment->house_id = House::where('house', $request->house)->first()->id;
            $payment->amount = $request->amount;
            $payment->payer = $request->name;
            $payment->save();
            //update house balance
            $balance = House::where('house', $request->house)->first()->balance - $payment->amount;
            House::where('house', $request->house)->update(['balance'=> $balance]);

            //get the telephone number
            $tel = House::where('houses.id', $payment->house_id)->leftJoin('telephones', 'telephones.user_id', 'houses.user_id')->first()->telephoneNumber;
            //text messages serve as receipts
            $message = new SmsMessages();
            $message->send('Green System has received '.$payment->amount.' for house '.$request->house.'. It has been paid by '.$payment->payer.' and the new balance is '.$balance, $tel);

            return back()->with('message', 'payment successifully added'); 
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
        //
       
        $payment = Payment::findOrFail($id)
            ->leftJoin('houses', 'houses.id', 'payments.house_id')
            ->select('payments.id', 'payments.amount', 'payments.created_at', 'payments.payer', 'houses.house')->first();
            
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
         $this->validate($request,[
            'house' => 'required',
            'name' => 'required',
            'amount' => 'required|numeric',
            'oldAmount'=> 'required|numeric']);

        $house = House::where('house', $request->house)->first();
        if($house==null){
            return back()->with('message', 'house '.$request->house.' does not exist try again');
        } else if($house->status=='pending'){
            return back()->with('message', 'house '.$request->house.' has not been activated by the admin');   
        } else{
            $payment = Payment::findOrFail($id);;            
            $payment->house_id = House::where('house', $request->house)->first()->id;
            $payment->amount = $request->amount;
            $payment->payer = $request->name;
            $payment->save();
            //update house balance
            $balance = House::where('house', $request->house)->first()->balance - $payment->amount +$request->oldAmount;
            House::where('house', $request->house)->update(['balance'=> $balance]);
            //print a receipt
            $message = new SmsMessages();
            $message->send('Green System has received '.$payment->amount.' for house '.$request->house.'. It has been paid by '.$payment->payer.' and the new balance is '.$balance, $tel);

            return back()->with('message', 'payment successifully added'); 
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
        //
        
        $payment  = Payment::findOrFail($id);
        $payment->delete();
        return redirect('/payments');
    }
}
