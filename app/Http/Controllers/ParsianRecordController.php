<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\ParsianRecord;
use App\Models\UserPackage;
use App\Models\PackageType;
use Carbon\Carbon;


class ParsianRecordController extends Controller
{


    public function checkout(Package $package)
    {
        //check if user can purchase this package!
        // return $package;
        try {

            $gateway = \Gateway::make('parsian');
         
            $gateway->setCallback(url('api/bank/response')); // You can also change the callback
            $gateway->price($package->price)
                    ->ready();
         
            $refId =  $gateway->refId(); // شماره ارجاع بانک
            $transID = $gateway->transactionId(); // شماره تراکنش

            
            // در اینجا
            //  شماره تراکنش  بانک را با توجه به نوع ساختار دیتابیس تان 
            //  در جداول مورد نیاز و بسته به نیاز سیستم تان
            // ذخیره کنید .

            ParsianRecord::create([
                'package_id' => $package->id,
                'user_id' => Auth()->user()->id,
                'sale_order_id' => $refId, 
                'price' => $package->price,
                'token' => $transID,
            ]);

         
            return response()->json(['refId'=> $refId , 'transactionId' => $transID]);
            // return $gateway->redirect();
         
         } catch (\Exception $e) {
         
            // echo $e->getMessage();
            return response()->json($e->getMessage());
         }
    }

    public function response()
    {
        try { 

            $gateway = \Gateway::verify();
            // $trackingCode = 802260897039;
            // $refId = "201250540569203";
            // $cardNumber =  "603799******0634";
            $trackingCode = $gateway->trackingCode();
            $refId = $gateway->refId();
            $cardNumber = $gateway->cardNumber();

            // dd([
            //     'trackingcode' => $trackingCode,
            //     'refID' => $refId,
            //     'cardnumber' => $cardNumber
            // ]);
         
            // تراکنش با موفقیت سمت بانک تایید گردید
            // در این مرحله عملیات خرید کاربر را تکمیل میکنیم

            $purchase = ParsianRecord::where('sale_order_id', $refId)->first();
            $package = Package::where('id', $purchase->package_id)->first();
            $packageType = PackageType::find($package->package_type_id);

            UserPackage::create([
                'package_id' => $package->id,
                'user_id' => $purchase->user_id,
                'purchase_date' => Carbon::now(),
                'expiration_date' => Carbon::now()->addDays($package->duration),
                'remaining_megabyte' => $package->size,
                'priority' => $packageType->priority,
                'price' => $purchase->price,
                'duration' => $package->duration,
                'size' => $package->size,
                'receipt_number' => $trackingCode,
                'payment_type' => 'online',
                'name' => $package->name, 
            ]);

            return redirect('http://localhost:3000/dashboard/response/0');
         
         } catch (\Larabookir\Gateway\Exceptions\RetryException $e) {
         
             // تراکنش قبلا سمت بانک تاییده شده است و
             // کاربر احتمالا صفحه را مجددا رفرش کرده است
             // لذا تنها فاکتور خرید قبل را مجدد به کاربر نمایش میدهیم
         
             echo $e->getMessage() . "<br>";
             return redirect('http://localhost:3000/dashboard/response/1');
         
         } catch (\Exception $e) {
         
             // نمایش خطای بانک
             echo $e->getMessage();
             return redirect('http://localhost:3000/dashboard/response/2');
         }
    }



}
