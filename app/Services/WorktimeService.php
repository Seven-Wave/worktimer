<?php


namespace App\Services;

use App\Contracts\WorktimeControllerInterface;
use App\Models\Payment;
use App\Models\Worktime;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorktimeService implements WorktimeControllerInterface {

    public function create(Request $req) {
        $dur = (60 * 60 * intval(explode(':', explode(' ', $req->worktime)[1])[0])) + (60 * intval(explode(':', explode(' ', $req->worktime)[1])[1])) + intval(explode(':', explode(' ', $req->worktime)[1])[2]);

        $newTime = new Worktime;
        $newTime->user_id = Auth::user()->id;
        $newTime->date = explode(' ', $req->worktime)[0];
        $newTime->duration = $dur;
        $newTime->time_start = $req->worktime_start;
        $newTime->time_end = Carbon::createFromDate($req->worktime_start)->addSeconds($dur)->toDateTimeString();
        $newTime->save();

        return response()->json(['status' => 'ok', 'message' => 'Хорошего дня!']);
    }
}
