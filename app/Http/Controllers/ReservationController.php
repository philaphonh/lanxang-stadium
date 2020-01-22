<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;
use App\Schedule;
use App\Stadium;
use App\Reservation;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ReservationController extends Controller
{
    //
    public function stadiumInfo()
    {
        $data = Stadium::all();
        return $data;
    }

    public function timeInfo()
    {
        $data = Schedule::all();
        return $data;
    }

    public function reservationInfo()
    {
        $data = DB::table('tbl_reservation')
            ->select()
            ->join('tbl_stadium', 'tbl_reservation.stadium_id', '=', 'tbl_stadium.stadium_id')
            ->join('tbl_schedule', 'tbl_reservation.selected_time_id', '=', 'tbl_schedule.time_id')
            ->get();
        return response()->json(['info' => $data], 200);
    }

    public function reservationInfoByDate(Request $request)
    {
        $date = $request->query('selecteddate', '');
        $data = DB::table('tbl_reservation')
            ->select()
            ->join('tbl_stadium', 'tbl_reservation.stadium_id', '=', 'tbl_stadium.stadium_id')
            ->join('tbl_schedule', 'tbl_reservation.selected_time_id', '=', 'tbl_schedule.time_id')
            ->where('tbl_reservation.selected_date', '=', $date)
            ->get();
        return response()->json(['info' => $data], 200);
    }

    public function reservationInfoByDateAndStadium(Request $request)
    {
        $date = $request->query('selecteddate', '');
        $stadium = $request->query('stadium', '');
        $data = Reservation::where([['selected_date', '=', $date], ['stadium_id', '=', $stadium]])->get();
        return response()->json(['info' => $data], 200);
    }

    public function reserve(Request $request)
    {
        $reservation = new Reservation;
        $reservation->customer_name = $request->input('name', '');
        $reservation->stadium_id = $request->input('stadium', null);
        $reservation->reserve_date = Carbon::now();
        $reservation->selected_date = $request->input('selecteddate', '');
        $reservation->selected_time_id = $request->input('time', null);
        $result = $reservation->save();
        if ($result) {
            return response()->json(['message' => 'Successful'], 201);
        } else {
            return response()->json(['message' => 'Failed'], 500);
        }
    }

    public function checkin($id)
    {
        $reservation = Reservation::find($id);
        $reservation->is_checked_in = !$reservation->is_checked_in;
        $result = $reservation->save();
        if ($result) {
            return response()->json(['message' => 'Successful'], 200);
        } else {
            return response()->json(['message' => 'Failed'], 500);
        }
    }

    public function deleteReservation($id)
    {
        $reservation = Reservation::find($id);
        $result = $reservation->delete();
        if ($result) {
            return response()->json(['message' => 'Successful'], 200);
        } else {
            return response()->json(['message' => 'Failed'], 500);
        }
    }
}
