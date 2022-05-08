<?php

namespace App\Http\Controllers;

use App\Contracts\PauseControllerInterface;
use App\Models\Pause;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PauseController extends Controller
{
    private $pauseService;

    public function __construct(PauseControllerInterface $pauseService)
    {
        $this->pauseService = $pauseService;
    }

    public function create(Request $req) {

        return $this->pauseService->create($req);

    }
}
