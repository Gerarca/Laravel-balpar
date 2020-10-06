<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Spatie\ArrayToXml\ArrayToXml;
use Illuminate\Database\Eloquent\Builder;
use App\Categoria;
use App\Marca;
use App\Etiqueta;
use App\Producto;
use App\CategoriaTrabajo;
use Str;

class GenerarSitemap implements ShouldQueue
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
        $categories = Categoria::whereHas('productos', function (Builder $query) {
		    $query->where('visible', 1);
		})->orderBy('orden')->get();
        $marcas = Marca::orderBy('nombre')->get();
        $etiquetas = Etiqueta::orderBy('nombre')->get();
        $productos = Producto::where('visible', 1)->orderBy('id', 'desc')->get();
        $categorias_trabajos = CategoriaTrabajo::whereHas('trabajos')->orderBy('orden')->get();
        $fecha = "2020-06-05";
        $fecha_actual = date("Y-m-d");
        // crear site map
        $sitemap = [];

        $sitemap = [
            'url' => [
                [
                    'loc' => route('front.catalogo.todos'),
                    'lastmod' => $fecha,
                    'prority' => number_format(1.00, 2),
                ],
                [
                    'loc' => route('front.servicio_tecnico'),
                    'lastmod' => $fecha,
                    'prority' => number_format(0.80, 2),
                ],
                [
                    'loc' => route('front.nosotros'),
                    'lastmod' => $fecha,
                    'prority' => number_format(0.80, 2),
                ],
                [
                    'loc' => route('front.trabajos_realizados'),
                    'lastmod' => $fecha,
                    'prority' => number_format(0.80, 2),
                ],
                [
                    'loc' => route('front.contacto'),
                    'lastmod' => $fecha,
                    'prority' => number_format(0.80, 2),
                ],
                [
                    'loc' => route('front.catalogos'),
                    'lastmod' => $fecha,
                    'prority' => number_format(0.80, 2),
                ]
            ]
        ];

        foreach ($categories as $key => $category) {
            $sitemap['url'][] = [
                'loc' => route('front.catalogo.categoria', ['categoria' => $category, 'nombre' => Str::slug($category->categoria    )]),
                'lastmod' =>  $fecha_actual,
                'priority' => number_format(0.80, 2)
            ];
        }

        foreach ($category->rubros as $key => $rubro) {
            $sitemap['url'][] = [
                'loc' => route('front.catalogo.rubro', ['rubro' => $rubro->id, 'nombre' => Str::slug($rubro->rubro)]),
                'lastmod' =>  $fecha_actual,
                'priority' => number_format(0.80, 2)
            ];
        }

        foreach ($marcas as $key => $marca) {
            $sitemap['url'][] = [
                'loc' => route('front.catalogo.marca', ['marca' => $marca->id, 'nombre' => Str::slug($marca->nombre)]),
                'lastmod' =>  $fecha_actual,
                'priority' => number_format(0.80, 2)
            ];
        }

        foreach ($etiquetas as $key => $etiqueta) {
            $sitemap['url'][] = [
                'loc' => route('front.catalogo.etiqueta', ['etiqueta' => $etiqueta, 'nombre' => Str::slug($etiqueta->nombre)]),
                'lastmod' =>  $fecha_actual,
                'priority' => number_format(0.80, 2)
            ];
        }

        foreach ($categorias_trabajos as $key => $categoria_trabajos) {
            $sitemap['url'][] = [
                'loc' => route('front.categoria_trabajos_realizados', ['categoria_trabajo' => $categoria_trabajos->id, 'nombre' => Str::slug($categoria_trabajos->categoria)]),
                'lastmod' =>  $fecha_actual,
                'priority' => number_format(0.80, 2)
            ];
        }

        foreach ($productos as $key => $producto) {
            $sitemap['url'][] = [
                'loc' => route('front.producto', ['producto' => $producto->id, 'nombre' => Str::slug($producto->nombre)]),
                'lastmod' =>  $fecha_actual,
                'priority' => number_format(0.80, 2)
            ];
        }


        // clase que genera XML
        $xml = ArrayToXml::convert($sitemap, [
                    'rootElementName' => 'urlset',
                    '_attributes' => [
                        'xmlns' => 'http://www.sitemaps.org/schemas/sitemap/0.9',
                        'xmlns:xsi' => 'http://www.w3.org/2001/XMLSchema-instance',
                        'xsi:schemaLocation' => "http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd"
                    ],
                ], true, 'UTF-8');

        file_put_contents(public_path('sitemap.xml'), $xml);

        dd("Hecho");
    }
}
