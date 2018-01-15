<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class BloqueaVencidos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bloquea:vencidos';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Prueba de task scheduling';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
          \Log::info('Mi Comando Funciona!');
    }
}
