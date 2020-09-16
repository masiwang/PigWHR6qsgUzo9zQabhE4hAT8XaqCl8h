<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

use App\FundCheckout;
use App\Bank;
use App\FundPayment;
use App\User;

class PaymentController extends Controller
{
    public function fund($invoice_code){
        $checkout = FundCheckout::where('invoice_code', 'INV957969799225')
            ->where('invoice_code', $invoice_code)
            ->get();
        if($checkout){
            $banks = Bank::all();
            return view('payment.fund', ['invoice_code' => $invoice_code, 'banks' => $banks, 'user' => Auth::user()]);
        }else{
            return '404';
        }
    }

    public function fund_pay(Request $request){
        $validation = $request->validate([
            'file'  =>  'required|file|image|mimes:jpeg,png,gif,jpg|max:2048'
        ]);

        $invoice_code = $request->invoice_code;
        $bank_type = Bank::where('name', $request->bankType)->first();
        $bank_code = $request->bankAcc;
        $fund_checkout = FundCheckout::where('user_id', Auth::id())
            ->where('invoice_code', $invoice_code)->first();

        $file = $validation['file'];
        $file_name = Storage::put('public/payment', $file);
        $file_path = Storage::url($file_name);

        $query = [
            'user_id' => Auth::id(),
            'bank_type_id' => $bank_type->id,
            'bank_code' => $bank_code,
            'image' => $file_path,
            'fund_checkout_id' => $fund_checkout->id,
            'invoice_code' => $invoice_code,
            'created_at' => Carbon::now()
        ];
        
        if(FundPayment::insert($query)){
            $fund_checkout->update([
                'fund_checkout_status_id' => 2,
                'updated_at' => Carbon::now()
            ]);
            return redirect('portofolio')->with('success', 'Pembayaran sedang diproses, mohon tunggu. Apabila pembayaran belum terkonfirmasi dalam 1x24jam, mohon hubungi Admin.');
        }else{
            return back();
        }
    }
}
