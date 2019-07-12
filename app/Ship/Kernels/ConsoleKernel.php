<?php


namespace App\Ship\Kernels;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as LaravelConsoleKernel;

class ConsoleKernel extends LaravelConsoleKernel
{
    protected $commands = [];

    protected function schedule(Schedule $schedule) {
    }

    protected function commands() {

    }
}