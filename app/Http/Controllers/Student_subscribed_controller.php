<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Enrolled_course;
use App\Models\Invite_student;

use Illuminate\Http\Request;
use Omnipay\Omnipay;

class Student_subscribed_controller extends Controller
{
    private $gateway;

    public function __construct()
    {
        $this->gateway = Omnipay::create('PayPal_Rest');
        $this->gateway->setClientId(env('PAYPAL_CLIENT_ID'));
        $this->gateway->setSecret(env('PAYPAL_CLIENT_SECRET'));
        $this->gateway->setTestMode(true);
    }

    public function student_subscribed_course(Request $request)
    {
        //return $request->input();
        try {
            // $invitation_id = $request->input('invitation_id');

            // if (isset($invitation_id)) {
                
                Invite_student::where('id', $request->input('invitation_id'))
                    ->update(['status' => 'Accepted']);

                $new_enrolled = new Enrolled_course([
                    'course_id' => $request->input('course_id'),
                    'student_id' => auth()->user()->id,
                    'instructor_id' => $request->input('instructor_id'),
                    'amount' => 0,
                    'course_type' => 'Free',
                ]);

                $new_enrolled->save();
            // }

            $new_payment = new Payment([
                'course_id' => $request->input('course_id'),
                'student_id' => auth()->user()->id,
                'instructor_id' => $request->input('instructor_id'),
                'amount' => $request->input('amount'),
            ]);

            $new_payment->save();

            // $new_enrolled = new Enrolled_course([
            //     'course_id' => $request->input('course_id'),
            //     'student_id' => auth()->user()->id,
            //     'instructor_id' => $request->input('instructor_id'),
            //     'amount' => $request->input('amount'),
            //     'course_type' => 'Subscribed',
            // ]);

            // $new_enrolled->save();

            $response = $this->gateway->purchase(array(
                'amount' => $request->input('amount'),
                'currency' => env('PAYPAL_CURRENCY'),
                'returnUrl' => url('success'),
                'cancelUrl' => url('error'),
            ))->send();

            if ($response->isRedirect()) {
                $response->redirect();
            } else {
                return $response->getMessage();
            }
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function success(Request $request)
    {
        if ($request->input('paymentId') && $request->input('PayerID')) {
            $transaction = $this->gateway->completePurchase(array(
                'payer_id' => $request->input('PayerID'),
                'transactionReference' => $request->input('paymentId'),
            ));

            $response = $transaction->send();

            if ($response->isSuccessful()) {

                // $arr = $response->getData();

                // return $arr['id'];

                return view('payment_success');
            } else {
                return $response->getMessage();
            }
        } else {
            return 'Payment declined!';
        }
    }

    public function error()
    {
        return 'Payment declined';
    }
}
