<?php

namespace App\Http\Controllers;

use App\Models\Pause;
use App\Models\Worktime;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TimeController extends Controller
{
    public function get_status() {
        # Добавляем 3 часа и получаем московское время, GMT+3
        $today = Carbon::now()->addHours(4)->toDateString();
        $worktime = Worktime::where('user_id', Auth::user()->id)
            ->where('date', $today)
            ->sum('duration');

        $worktimeMins = intdiv($worktime, 60) % 60;

        $worktimeHours = intdiv($worktime, 3600);

        $worktime = $worktimeMins . ' мин';

        if ($worktimeHours) {
            $worktime = $worktimeHours . ' ч ' . $worktimeMins . ' мин';
        }

        $pauses = Pause::where('user_id', Auth::user()->id)
            ->where('date', $today)
            ->sum('duration');

        $pausesMins = intdiv($pauses, 60) % 60;

        $pausesHours = intdiv($pauses, 3600);

        $pauses = $pausesMins . ' мин';

        if ($pausesHours) {
            $pauses = $pausesHours . ' ч ' . $pausesMins . ' мин';
        }

        $startAt = Worktime::where('user_id', Auth::user()->id)
            ->where('date', $today)
            ->orderBy('created_at', 'asc')
            ->first()
            ->time_start;

        $startAt = explode(':', explode(' ', $startAt)[1])[0] . ':' . explode(':', explode(' ', $startAt)[1])[1];

        $finishAt = Worktime::where('user_id', Auth::user()->id)
            ->where('date', $today)
            ->orderBy('created_at', 'desc')
            ->first()
            ->time_end;

        $finishAt = explode(':', explode(' ', $finishAt)[1])[0] . ':' . explode(':', explode(' ', $finishAt)[1])[1];

        return response()->json(['status' => 'ok', 'worktime' => $worktime, 'pauses' => $pauses, 'start' => $startAt, 'finish' => $finishAt]);
    }
}
