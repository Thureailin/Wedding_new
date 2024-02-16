<?php

namespace App\Http\Controllers;

use App\Http\Resources\BookingResource;
use App\Models\Booking;
use App\Models\Condition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $frontData = $request->input('date');
//        $frontTime = $request->input('time');
//        $condition = Condition::where('date',$frontData)->where('count')
        $condition = Condition::where('date', $frontData)
            ->where('date', $frontData)
            ->first();
        if($condition === null ){
            return response()->json([
                "message"=>'Booking is Available',
               "time"=>[],
            ]);
        }elseif($condition->date !== $frontData ) {
            return response()->json([
                "message" => "This Day is Available"
            ]);
        }

        if ($condition) {
            $date = $condition->date;
            $time = $condition->time;
            $count = $condition->count;
            $status = $condition->status;
            // You can then use $date in your logic
            if ($date == $frontData ) {
                if ($status == 'available') {
                    return response()->json([
                        "message" => "Booking is Available",
                        "time"=>[$time,$count],

                    ]);
                } elseif ($status == 'full') {
                    return response()->json([
                        "message" => "Booking is Disable"
                    ]);
                }
            }
        }
    }
    public function bookingList()

    {
        $booking = Booking::all();
        return response()->json([
            "error"=>false,
            "message"=>$booking,
        ]);
    }
    public function store(Request $request)
    {

            $booking = new Booking();
            $booking->customer_name = $request->customer_name;
            $booking->customer_phone = $request->customer_phone;
            $booking->customer_address = $request->customer_address;
            $booking->recommendation = $request->recommendation;
            $booking->customer_email = $request->customer_email;
            $booking->package_id = $request->package_id;
            $booking->dress_id = $request->dress_id;
            $booking->theme_id = $request->theme_id;
            $booking->date = $request->date;
            $booking->time = $request->time;
            $booking->status = 'pending';
            $booking->save();

            return response()->json([
                'error' => false,
                "message" => 'Booking created is successfully',
                "data" => $booking
            ]);
        }

    public function destroy($id)
    {
        $booking = Booking::find($id);
        $booking->delete();
        return response()->json([
            'data'=>'Booking Deleted Successfully!',
        ]);
    }
    public function update(Request $request, $id)
    {

        $validatedData = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|string|max:255',
            'customer_phone' => 'required|string',
            'customer_address' => 'required|string',
            'recommendation' => 'required|string',
            'package_id' => 'required|integer',
            'dress_id' => 'required|integer',
            'theme_id' => 'required|integer',
            'date' => 'required|string',
            'time' => 'required|string',
            'status' => 'required|string'
            // Add other validation rules here
        ]);
        $booking = Booking::find($id);
        $booking->update($validatedData);

        if($booking->status == 'done'){
                $bookingId = $booking->id;
            $array = Condition::where('date', $booking->date)->where('time', $booking->time)->get();

            foreach($array as $ar){
                $existingRecord =Condition::where('date', $ar->date)
                    ->where('time', $ar->time)
                    ->where('booking_id', $ar->booking_id)
                    ->first();
                if($existingRecord->count >= 2){
                    $existingRecord->status = 'full';
                    $existingRecord->update();
                    return response()->json([
                        "message"=>"Booking is Full"
                    ]);

                }
                elseif ($existingRecord) {
                    // Update the count for the existing record
                    $existingRecord->booking_id += 1;
                    $existingRecord->count += 1;
                    $existingRecord->save();
                    $arrayId [] =$bookingId ;


                    return response()->json([
                        "message"=>"update is successfully",
                        "booking_id "=>$arrayId

                    ]);
                }
                elseif($booking->status === 'cancel'){
                    $existingRecord->count -= 1;
                    $existingRecord->status = 'available';
                    $existingRecord->save();
                    return response()->json([
                        "message"=>"update existing cancel is finished"
                    ]);
                }
            }

            $condition = new Condition();
            $condition->id =$request->id;
            $condition->date = $booking->date;
            $condition->time =$booking->time;
            $condition->status = 'available';
            $condition->count = 1;
            $condition->booking_id =$booking->id;
            $condition->save();
            return response()->json([

            "message"=>"Update is Successfully"

            ]);
        }elseif ($booking->status == 'cancel') {
            // Assuming you have a way to identify the existing condition related to the booking
            $existingCondition = Condition::where('booking_id', $booking->id)->first();

            if ($existingCondition) {
                $existingCondition->count -= 1; // Decrement count by 1
                $existingCondition->status = 'available';
                $existingCondition->save();
                return response()->json([
                    "message"=>$existingCondition
                ]);
            }
        }
    }
}
