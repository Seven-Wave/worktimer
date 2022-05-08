<?php


namespace App\Services;

use App\Contracts\PauseControllerInterface;
use App\Models\Pause;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PauseService implements PauseControllerInterface {

    public function create(Request $req) {
        $newPause = new Pause;
        $newPause->user_id = Auth::user()->id;
        $newPause->date = explode(' ', $req->time_start)[0];
        $newPause->duration = Carbon::parse($req->time_end)->diff(Carbon::parse($req->time_start))->s;
        $newPause->time_start = $req->time_start;
        $newPause->time_end = $req->time_end;
        $newPause->save();

        return response()->json(['status' => 'ok', 'message' => 'Пауза окончена, с возвращением!']);
    }
}
