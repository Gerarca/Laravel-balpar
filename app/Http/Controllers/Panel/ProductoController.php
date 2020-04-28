<?php
namespace App\Http\Controllers\Panel;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ProductosImport;

use Image;
use DB;
use Session;
use App\Producto;
use App\Categoria;
use App\Marca;
use App\ImagenProducto;
use App\Proveedor;
use App\Etiqueta;


class ProductoController extends Controller
{
  	public function __construct( Producto $productos, Categoria $categorias, Marca $marcas)
  	{
    	$this->middleware('auth');
    	$this->productos = $productos;
    	$this->categorias = $categorias;
    	$this->marcas = $marcas;
  	}


    public function index()
    {
      	$productos = $this->productos->orderBy('id', 'asc')->get();
      	return view('panel.producto.index', compact('productos'));
    }


    public function create(Producto $producto, Categoria $categoria)
    {
      	return view('panel.producto.import');
    }

    public function store(Request $request)
    {
        $productos = Excel::toArray(new ProductosImport(), request()->file('file'));
        $aux_hash=md5(date('Y-m-d H:i:s'));
        if (sizeof($productos[0])>=1) {
        	foreach ($productos[0] as $pos => $producto_array) {
	            $cod_categoria=$producto_array['cod_categoria'];
	            $categoria=$producto_array['categoria'];
	            $cod_subcategoria=$producto_array['cod_subcategoria'];
	            $subcategoria=$producto_array['subcategoria'];
	            $cod_marca=$producto_array['cod_marca'];
	            $marca=$producto_array['marca'];
	            $sku=$producto_array['sku'];
	            $referencia=$producto_array['referencia'];
	            $codigo_de_barra=$producto_array['codigo_de_barra'];
	            $producto=$producto_array['producto'];
	            $precio_retail=$producto_array['precio_retail'];
	            $stock=$producto_array['stock_sol'];
	            $visible=(strtoupper($producto_array['mostrar'])=='NO')?0:1;
	            $peso=$producto_array['peso'];
	            $tamano=$producto_array['tamano'];
	            $descripcion=$producto_array['descripcion'];
	            $especificaciones=$producto_array['especificaciones'];
	            $cod_articulo=$sku;
	            $imagen_principal='default.jpg';
            	//cuotas
              	$array_precio_cuotas=array();
              	for ($i=1; $i <100 ; $i++) {
                	if (isset($producto_array['cuota_'.$i]) && $producto_array['cuota_'.$i]>0) {
                  		$array_precio_cuotas[$i]=$producto_array['cuota_'.$i];
            		}
              	}
           	 	//cuotas

            	$array_imagenes_extras=array();
            	if (strlen($cod_articulo)>=1) {
              		$imagenes=Storage::disk('ftp')->allFiles('/'.$cod_articulo);
              		foreach ($imagenes as $posi => $imagen) {
                		if (strpos($imagen, '.jpg') !== false) {
                    		$imagen_ftp=Storage::disk('ftp')->get($imagen);
                    		$copiar=Storage::disk('public')->put('/productos/'.$cod_articulo.'_'.$posi.'.jpg', $imagen_ftp);
                    		if ($copiar && $imagen_principal=='default.jpg') {
                      			if (strlen($imagen)>=1) {
                        			$imagen_principal=$cod_articulo.'_'.$posi.'.jpg';
                      			}
                    		} else {
                      			$imagen_ftp=Storage::disk('ftp')->get($imagen);
                  				$copiar=Storage::disk('public')->put('/productos/'.$cod_articulo.'_'.$posi.'.jpg', $imagen_ftp);
                      			if ($copiar) {
                        			$imagen_extra=$cod_articulo.'_'.$posi.'.jpg';
                        			array_push($array_imagenes_extras, $imagen_extra);
                      			}
                			}
                		}
              		}

              		// Categoria
              		$existe_categoria = $this->categorias->query()->where('cod_origen', $cod_categoria)->where('cod_padre', NULL)->first();
              		if ($existe_categoria == NULL) {
                		$existe_categoria = $this->categorias->query()->create(['titulo' => $categoria, 'orden' => '1', 'cod_origen'=>$cod_categoria, 'user_id' => 1]);
              		} else {
                		$existe_categoria->fill(['titulo'=>$categoria])->save();
              		}
              		$cod_categoria_local = $existe_categoria->id;
              		// Categoria

              		// Sub_Categoria
              		$existe_sub_categoria = $this->categorias->query()->where('cod_origen', $cod_subcategoria)->where('cod_padre', $cod_categoria_local)->first();
              		if ($existe_sub_categoria == NULL) {
                		$existe_sub_categoria = $this->categorias->query()->create(['titulo' => $subcategoria, 'orden' => '1', 'cod_origen'=>$cod_subcategoria,'cod_padre'=>$cod_categoria_local , 'user_id' => 1]);
              		} else {
                		$existe_sub_categoria->fill(['titulo'=>$subcategoria])->save();
              		}
              		$cod_sub_categoria = $existe_sub_categoria->id;
              		// Sub_Categoria

			  		//Marca
              		$existe_marca = $this->marcas->query()->where('cod_origen',$cod_marca)->first();
              		if ($existe_marca == NULL) {
                		$existe_marca=$this->marcas->query()->create([ 'titulo' => $marca, 'orden' => '1', 'user_id' => 1, 'cod_origen'=>$cod_marca]);
              		}
              		//Marca

              		// Producto
              		$existe_producto = $this->productos->query()->find($cod_articulo);
              		if ($existe_producto == NULL) {
                		$existe_producto = $this->productos->query()->create([
	                  		'titulo' => $producto,
	                  		'cod_articulo' => $cod_articulo,
	                  		'imagen' => $imagen_principal,
	                  		'categoria_id' => $cod_sub_categoria,
	                  		'marca_id' => $existe_marca->id,
	                  		'descripcion' => $descripcion,
	                  		'especificaciones' => $especificaciones,
	                  		'user_id' => '1',
	                  		'oferta_semana' => '0',
	                  		'recomendado' => '0',
	                  		'mas_vendido' => '0',
	                  		'proveedor_id' => 1,
	                  		'sku' => $sku,
	                  		'referencia' => $referencia,
	                  		'codigo_barra' => $codigo_de_barra,
	                  		'precio_retail' => $precio_retail,
	                  		'stock' => $stock,
	                  		'peso' => $peso,
	                  		'tamano' => $tamano,
	                  		'visible' => $visible
                  		]);
                	} else {
                  		$existe_producto->fill([
                  			'titulo' => $producto,
                  			'imagen' => $imagen_principal,
                  			'categoria_id' => $cod_sub_categoria,
                  			'marca_id' => $existe_marca->id,
                  			'sku' => $sku,
                  			'referencia' => $referencia,
                  			'codigo_barra' => $codigo_de_barra,
                  			'precio_retail' => $precio_retail,
                  			'stock' => $stock,
                  			'peso' => $peso,
                  			'tamano' => $tamano,
                  			'visible' => $visible
                  		])->save();
                	}
                	// Producto

                	foreach ($array_imagenes_extras as $key => $imagen_extra) {
                  		if (strlen($imagen_extra)>=1) {
                    		$imagen_extra_existe=ImagenProducto::where('cod_articulo',$cod_articulo)->where('imagen', $imagen_extra)->first();
                    		if ($imagen_extra_existe==NULL) {
                      			ImagenProducto::create(['codigo_imagen'=>$aux_hash, 'imagen'=>$imagen_extra, 'cod_articulo'=>$cod_articulo, 'orden'=>$posi, 'user_id'=>1]);
                    		}else {
                      			$imagen_extra_existe->fill(['codigo_imagen'=>$aux_hash])->save();
                    		}
                  		}
                	}
                	ImagenProducto::where('cod_articulo',$cod_articulo)->where('codigo_imagen', '!=',$aux_hash)->delete();
                	//  crear relación $array_precio_cuotas
            	}
          	}
        }
      	Session::flash('mensaje', 'La importación ha sido creado correctamente');
      	return redirect(route('producto.index'))->with('status', 'El producto ha sido creado');
    }

    public function show(Producto $producto)
    {
        return false;
    }

    public function edit($id)
    {
      	$producto = $this->productos->findOrFail($id);
      	$categorias = $this->categorias->getPadresConHijos();
      	$marcas = $this->marcas->orderBy('orden', 'desc')->get();
      	$categoria = $this->categorias->findOrFail($producto->categoria_id);
      	$etiquetas_seleccionadas=$producto->etiquetas;
      	$etiquetas_no_seleccionadas=$this->productos->etiquetasNoSeleccionadas($producto->cod_articulo);
      	return view('panel.producto.form', compact('producto', 'categorias', 'marcas', 'categoria', 'etiquetas_seleccionadas', 'etiquetas_no_seleccionadas'));
    }

    public function update(Request $request, $id)
    {
      	request()->validate([
	        'titulo' => 'required|max:255',
	        'marca_id' => 'required',
	        'categoria_id' => 'required',
      	]);

      	$request['visible'] = $request['visible'] ? '1' : '0';
      	$request['oferta_semana'] = $request['oferta_semana'] ? '1' : '0';
      	$request['recomendado'] = $request['recomendado'] ? '1' : '0';
      	$request['mas_vendido'] = $request['mas_vendido'] ? '1' : '0';

      	$producto = $this->productos->findOrFail($id);
      	$producto->fill($request->only('titulo', 'categoria_id', 'marca_id', 'descripcion', 'especificaciones', 'visible', 'oferta_semana', 'recomendado', 'mas_vendido'))->save();

		if ($request->hasFile('imagen')) {
			$imageName = str_slug($request->cod_articulo). time() .'.' . $request->file('imagen')->getClientOriginalExtension();
 		   	$request->file('imagen')->move(base_path() . '/public/storage/productos/', $imageName);
 		   	Image::make(base_path() . '/public/storage/productos/' . $imageName)->encode('jpg', 60)->save();
			$producto->fill(['imagen' => $imageName])->save();
      	}

      	$producto->guardarEtiquetas($request['etiquetas'], \Auth::user()->id);
      	$producto->guardarTamanos($request['tamanos'], \Auth::user()->id);
      	$producto->guardarColores($request['colores'], \Auth::user()->id);

      	Session::flash('mensaje', 'El producto '.$producto->titulo.' ha sido creado correctamente');
      	return redirect(route('producto.index'))->with('status', 'El producto ha sido creado');
    }

    public function destroy( $id)
    {
      	$producto = $this->productos->findOrFail($id);
      	$producto->delete();
      	Session::flash('mensaje', 'El Producto '. $producto->titulo.' ha sido eliminado');
      	return redirect(route('producto.index'));
    }

    public function crearIndividual() {
        $producto = new Producto;
        $categorias = Categoria::all();
        $marcas = Marca::all();
        $etiquetas = Etiqueta::all();
        return view('panel.producto.form_individual', compact('producto', 'categorias', 'marcas', 'etiquetas', 'categoria'));
    }

	public function guardarIndividual(Request $request) {
		$datosValidados = $request->validate([
			"titulo" => ['required', 'max:255'],
			"cod_articulo" => ['required', 'max:255'],
			"codigo_barra" => ['nullable', 'max:255'],
			"referencia" => ['nullable', 'max:255'],
			"stock" => ['nullable', 'integer'],
			"precio_retail" => ['nullable', 'numeric'],
			"marca_id" => ['nullable', 'exists:marcas,id'],
			"descripcion" => ['nullable'],
			"especificaciones" => ['nullable'],
			"visible" => ['nullable', 'in:on'],
			"oferta_semana" => ['nullable', 'in:on'],
			"recomendado" => ['nullable', 'in:on']
	   ]);

		$datosValidados['visible'] = $request->visible == 'on' ? 1 : 0;
		$datosValidados['oferta_semana'] = $request->oferta_semana == 'on' ? 1 : 0;
		$datosValidados['recomendado'] = $request->recomendado == 'on' ? 1 : 0;
		$datosValidados['categoria_id'] = 1;
		$datosValidados['user_id'] = \Auth::id();

	   if ($request->hasFile('imagen_principal')) {
		   $imageName = str_slug($request->cod_articulo). '_0.' . $request->file('imagen_principal')->getClientOriginalExtension();
		   $request->file('imagen_principal')->move(base_path() . '/public/storage/productos/', $imageName);
		   Image::make(base_path() . '/public/storage/productos/' . $imageName)->encode('jpg', 60)->save();
	   }

	   	$producto = Producto::create($datosValidados);
		if (strlen($imageName) >= 1):
			$producto->fill(['imagen' => $imageName])->save();
		endif;

		Session::flash('mensaje', 'El producto '.$producto->titulo.' ha sido creado correctamente');
        return redirect(route('producto.index'))->with('status', 'El producto ha sido creado');
	}

	public function subirFotos(Request $request, $id) {
		$producto = $this->productos->findOrFail($id);

		foreach ($request->imagenes_secundarias as $imagen) {
			$aux_orden = (int) $this->getLastOrden($id);
			$imageName = str_slug($producto->cod_articulo) . $aux_orden . time() . '.' . $imagen->getClientOriginalExtension();
  		   	$imagen->move(base_path() . '/public/storage/productos/', $imageName);
  		   	Image::make(base_path() . '/public/storage/productos/' . $imageName)->encode('jpg', 60)->save();

			ImagenProducto::create([
				'cod_articulo' => $producto->cod_articulo,
				'imagen' => $imageName,
				'orden' => ++$aux_orden,
				'user_id' => \Auth::id()
			]);
		}

		Session::flash('mensaje', 'Las nuevas fotos se han agregado correctamente');
        return redirect(route('producto.edit', $id))->with('status', 'Las nuevas fotos se han agregado correctamente');
	}

	protected function getLastOrden($cod_articulo) {
		$aux = ImagenProducto::where('cod_articulo', $cod_articulo)->orderBy('orden', 'desc')->first();

		if ($aux == null) {
			return 0;
		} else {
			return $aux->orden;
		}
	}

	public function eliminarImagen(Request $request) {
		$id_true = $request->id;
		$img = ImagenProducto::where('id', $id_true);
		$img->delete();
		return;
	}

	public function actualizarOrden(Request $request) {
		$producto = $this->productos->findOrFail($request->id);
		$array = $request->nuevo_orden;
		foreach ($array as $key => $orden) {
			$auxiliar = ImagenProducto::findOrFail($orden);
			$auxiliar->fill([
				'orden' => (int) $key + 1
			])->save();
		}
		return;
	}

	public function galeriaFotos(Request $request) {
		$imagenes_secundarias = ImagenProducto::where('cod_articulo', $request->codigo_articulo)->orderBy('orden', 'asc')->get();
		return view('panel.producto.partial-fotos-secundarias', ['imagenes_secundarias' => $imagenes_secundarias]);
	}
}
