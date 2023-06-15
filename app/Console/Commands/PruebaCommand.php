<?php

namespace App\Console\Commands;

use App\Models\IaimCierreInventario;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class PruebaCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'prueba:prueba';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Esta es una prueba para validar el funcionamiento de losn comandos en laravel checkmas';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {

            $data = DB::table("iaim_movimiento_inventarios")
            ->select(DB::raw("SUM(entrada) as total_mov_ent"),
                    DB::raw("SUM(salida) as total_mov_sal"), 
                    DB::raw("now() as fecha_cierre"), 
                    DB::raw("codigo as codigo"), 'descripcion',
                    DB::raw("now() as updated_at"),
                    DB::raw("SUM(entrada) - SUM(salida) as Total_existencia"))
            ->groupBy(['codigo', 'descripcion'])
            ->get();

            $data= json_decode( json_encode($data), true);

            IaimCierreInventario::insert($data);

        } catch (\Throwable $th) {
            dd($th);
        }

    }
}