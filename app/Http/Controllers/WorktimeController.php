<?php

namespace App\Http\Controllers;

use App\Contracts\WorktimeControllerInterface;
use App\Models\Worktime;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class WorktimeController extends Controller
{
    private $worktimeService;

    public function __construct(WorktimeControllerInterface $worktimeService)
    {
        $this->worktimeService = $worktimeService;
    }

    public function create(Request $req) {

        return $this->worktimeService->create($req);
    }
}
