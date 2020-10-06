<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Helpers\Resizer;
use App\Producto;
use App\Marca;
use App\Trabajo;
use App\Catalogo;

class ResizeImages implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $productos = Producto::select(['imagen'])->whereNotNull('imagen')->get()->toArray();
        foreach ($productos as $producto) {
            foreach ($producto as $key => $imagen) {
                if ( ! $imagen) {
                    continue;
                }

                try {
                    Resizer::resize($imagen);
                } catch (\Exception $exception) {
                    report($exception);
                    continue;
                }
            }
        }

        $marcas = Marca::select(['imagen'])->whereNotNull('imagen')->get()->toArray();
        foreach ($marcas as $marca) {
            foreach ($marca as $key => $imagen) {
                if ( ! $imagen) {
                    continue;
                }

                try {
                    Resizer::resizeMarca($imagen);
                } catch (\Exception $exception) {
                    report($exception);
                    continue;
                }
            }
        }

        $trabajos = Trabajo::select(['imagen'])->whereNotNull('imagen')->get()->toArray();
        foreach ($trabajos as $trabajo) {
            foreach ($trabajo as $key => $imagen) {
                if ( ! $imagen) {
                    continue;
                }

                try {
                    Resizer::resizeTrabajoCatalogo($imagen);
                } catch (\Exception $exception) {
                    report($exception);
                    continue;
                }
            }
        }

        $catalogos = Catalogo::select(['imagen'])->whereNotNull('imagen')->get()->toArray();
        foreach ($catalogos as $catalogo) {
            foreach ($catalogo as $key => $imagen) {
                if ( ! $imagen) {
                    continue;
                }

                try {
                    Resizer::resizeTrabajoCatalogo($imagen);
                } catch (\Exception $exception) {
                    report($exception);
                    continue;
                }
            }
        }

    }
}
