<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rules\ReCaptchaRule;
use Illuminate\Support\Facades\Cookie;
use App\Banner;
use App\DatosDinamico;
use App\Testimonio;
use App\Producto;
use App\Categoria;
use App\Marca;
use App\Uso;
use App\Rubro;
use App\Etiqueta;
use App\Pedido;
use App\PedidoDetalle;
use App\Opcion;
use App\Trabajo;
use App\CategoriaCatalogo;
use App\CategoriaTrabajo;
use App\Data;
use App\Blog;
use Str;

class FrontController extends Controller
{
    public function index(){
        $banners = Banner::where('visible', '=', 1)->orderBy('orden')->get();
        $productos_comerciales = Producto::where('visible', 1)->where('destacado_comercial', 1)->orderBy('id', 'desc')->limit(5)->get();
        $productos_industriales = Producto::where('visible', 1)->where('destacado_industrial', 1)->orderBy('id', 'desc')->limit(5)->get();
        $testimonios = Testimonio::where('visible', '=', 1)->orderBy('id', 'desc')->get();
        $marcas = Marca::all();
        $dato_dinamico = DatosDinamico::first();
		return view('front.index', compact('banners', 'productos_comerciales', 'productos_industriales', 'dato_dinamico', 'testimonios', 'marcas'));
	}
    public function contacto(){
        $testimonios = Testimonio::where('visible', '=', 1)->orderBy('id', 'desc')->get();
		return view('front.contacto', compact('testimonios'));
	}
    public function catalogo_categoria(Categoria $categoria){
        $productos = $categoria->productos;
        $marcas = Marca::orderBy('nombre')->get();
        $etiquetas = Etiqueta::orderBy('nombre')->get();
        $metaTags = [
            'titulo' => $categoria->categoria,
            'descripcion' => $categoria->meta_description,
            'imagen' => $categoria->meta_image,
            'url' => route('front.catalogo.categoria', ['categoria' => $categoria->id, 'nombre' => Str::slug($categoria->categoria)]),
            'keywords' => $categoria->meta_keywords
        ];
		return view('front.catalogo', compact('categoria', 'productos', 'etiquetas', 'marcas', 'metaTags'));
	}
    public function catalogo_marca(Marca $marca){
        $marcas = Marca::orderBy('nombre')->get();
        $productos = $marca->productos;
        $etiquetas = Etiqueta::orderBy('nombre')->get();
        $asunto = ['asunto' => 'Marca', 'titulo' => $marca->nombre];
        $asunto = ['asunto' => 'Marca', 'titulo' => $marca->nombre];
        $metaTags = [
            'titulo' => $marca->nombre,
            'descripcion' => $marca->meta_description,
            'imagen' => $marca->imagen,
            'url' => route('front.catalogo.marca', ['marca' => $marca->id, 'nombre' => Str::slug($marca->nombre)]),
            'keywords' => $marca->meta_keywords
        ];
        return view('front.catalogo_filtro', compact('marcas', 'marca', 'productos', 'etiquetas', 'asunto', 'metaTags'));
	}
    public function catalogo_uso(Uso $uso){
        $categoria = $uso->categoria;
        $productos = $uso->productos;
        $marcas = Marca::orderBy('nombre')->get();
        $etiquetas = Etiqueta::orderBy('nombre')->get();
		return view('front.catalogo', compact('categoria', 'uso', 'productos', 'etiquetas', 'marcas'));
	}
    public function catalogo_rubro(Rubro $rubro){
        $categoria = $rubro->categoria;
        $productos = $rubro->productos;
        $marcas = Marca::orderBy('nombre')->get();
        $etiquetas = Etiqueta::orderBy('nombre')->get();
        $metaTags = [
            'titulo' => $rubro->rubro,
            'descripcion' => $rubro->meta_description,
            'imagen' => $rubro->meta_image,
            'url' => route('front.catalogo.rubro', ['rubro' => $rubro->id, 'nombre' => Str::slug($rubro->rubro)]),
            'keywords' => $rubro->meta_keywords
        ];
		return view('front.catalogo', compact('categoria', 'rubro', 'productos', 'etiquetas', 'marcas', 'metaTags'));
	}
    public function catalogo_etiqueta(Etiqueta $etiqueta){
        $productos = $etiqueta->productos;
        $marcas = Marca::orderBy('nombre')->get();
        $etiquetas = Etiqueta::orderBy('nombre')->get();
        $asunto = ['asunto' => 'Etiqueta', 'titulo' => $etiqueta->nombre];
		return view('front.catalogo_filtro', compact('productos', 'etiqueta', 'etiquetas', 'marcas', 'asunto'));
	}
    public function buscar_catalogo(Request $request){
        $productos = Producto::where('nombre', 'LIKE', '%' . request('search_product') . '%')->get();
        $marcas = Marca::orderBy('nombre')->get();
        $etiquetas = Etiqueta::orderBy('nombre')->get();
        $asunto = ['asunto' => 'Búsqueda', 'titulo' => request('search_product')];
        return view('front.catalogo_filtro', compact('productos', 'etiquetas', 'marcas', 'asunto'));
    }
    public function catalogo_destacado(Request $request){

        if($request->destacado == 1){
            $productos = Producto::where('destacado_comercial', 1)->orderBy('id', 'desc')->get();
            $titulo = 'Destacados Comercial';
        } else {
            $titulo = 'Destacados Industrial';
            $productos = Producto::where('destacado_industrial', 1)->orderBy('id', 'desc')->get();
        }

        $marcas = Marca::orderBy('nombre')->get();
        $etiquetas = Etiqueta::orderBy('nombre')->get();
        $asunto = ['asunto' => 'Destacado', 'titulo' => $titulo];
        return view('front.catalogo_filtro', compact('productos', 'etiquetas', 'marcas', 'asunto'));
    }
    public function catalogo_todos(){
        $marcas = Marca::orderBy('nombre')->get();
        $productos = Producto::orderBy('id', 'desc')->get();
        $etiquetas = Etiqueta::orderBy('nombre')->get();
        $asunto = ['asunto' => 'Productos', 'titulo' => 'Todos los productos'];
		return view('front.catalogo_filtro', compact('marcas', 'productos', 'etiquetas', 'asunto'));
	}
    public function producto(Producto $producto){
		return view('front.producto', compact('producto'));
    }
    public function blog(Request $request){
      $categoria_id = $request->has('c') && $request->get('c') != null ? $request->get('c') : null;
      $search = $request->has('search') && $request->get('search') != null ? $request->get('search') : null;
      $blogs = Blog::where('visible',1)
                  ->when(isset($categoria_id), function ($query) use($categoria_id) {
                      return $query->where("categoria_id",$categoria_id);
                  })
                  ->when(isset($search), function ($query) use($search) {
                      return $query->where("titulo","like","%".$search."%");
                  })
                  ->orderBy('created_at','desc')->paginate(8);
      $categorias = Categoria::orderBy('categoria','asc')->get();
		  return view('front.blog',compact('blogs','categorias','categoria_id','search'));
    }
    public function singleBlog($id){
      $blog = Blog::find($id);
      $tepuede_interesar = Blog::where("categoria_id",$blog->categoria_id)->where("id","!=",$blog->id)->take(2)->inRandomOrder()->get();
		  return view('front.blog-single',compact('blog','tepuede_interesar'));
    }

    public function presupuesto(){
        $actual_cookie = Cookie::get('productos') ?? serialize([]);
        $carrito_detalles = unserialize($actual_cookie);
        $total = 0;
        $envio = 0;
        $carrito_detalles = array_map(function ($detalle) {
            $producto = Producto::where('cod_articulo', $detalle['cod_articulo'])->first();
            $detalle['id'] = $producto->id;
            $detalle['nombre'] = $producto->nombre;
            $detalle['imagen'] = asset('storage/productos/' . $producto->imagen);
            $detalle['url'] = route('front.producto', [$producto->id, Str::slug($producto->nombre)]);
            return $detalle;
        }, $carrito_detalles);

        // foreach ($carrito_detalles as $pos => $detalle) {
        //     $total+=$detalle['precio']*$detalle['cantidad'];
        // }
        // $ciudades = Ciudad::where('visible',1)->orderBy('orden', 'desc')->get();
		return view('front.presupuesto', compact('carrito_detalles', 'envio'));
	}
    public function nosotros(){
        $data = Data::where('key', 'nosotros')->get()->first()->value;
		return view('front.nosotros', compact('data'));
	}
    public function servicio_tecnico(){
        $recursos = \App\ServicioTecnicoInfo::orderBy('created_at')->get()->first();
        $type = json_decode(@$recursos->type);
        $youtube_id = json_decode(@$recursos->youtube_id);

		return view('front.servicio_tecnico', compact("recursos","type","youtube_id"));
	}
    public function trabajos_realizados(){
        $categorias_trabajos = CategoriaTrabajo::whereHas('trabajos')->orderBy('orden')->get();
        $trabajos = Trabajo::orderBy('video', 'desc')->get();
        $trabajos = $trabajos->sortBy(function($a){
            return $a->categoria_id == 5 ? -1 : 1;
        });
		return view('front.trabajos_realizados', ['categorias_trabajos' => $categorias_trabajos, 'trabajos' => $trabajos]);
	}
    public function categoria_trabajos_realizados(Request $request){
        $categorias_trabajos = CategoriaTrabajo::whereHas('trabajos')->orderBy('orden')->get();
        $trabajos = Trabajo::where('categoria_id', $request->categoria_trabajo)->orderBy('id', 'desc')->get();
		return view('front.trabajos_realizados', ['categorias_trabajos' => $categorias_trabajos, 'trabajos' => $trabajos]);
	}
    public function catalogos(){
        $categoria_catalogos = CategoriaCatalogo::orderBy('nombre')->get();
		return view('front.catalogos', compact('categoria_catalogos'));
	}
    public function cargar_testimonio(Request $request)
    {
        request()->validate([
            'nombre' => 'required|max:255',
            'testimonio' => 'required'
        ]);

        Testimonio::create($request->only('nombre', 'testimonio'));
        return back()->with('status', 'Gracias por dejar tu testimonio!');
    }

    public function carritoFinalizar(Request $request){
        request()->validate([
            'nombre'=> 'required|max:255',
            'telefono'=> 'required|max:255',
            'email'=> 'required|email|max:255',
            'empresa'=> 'max:255'
        ]);

        $actual_cookie = Cookie::get('productos') ?? serialize([]);
        $carrito_detalles = unserialize($actual_cookie);
        $subtotal=0;
        $envio=0;
        $carrito_detalles = array_map(function ($detalle) {
            $producto = Producto::where('cod_articulo', $detalle['cod_articulo'])->first();
            $detalle['titulo'] = $producto->nombre;
            $detalle['imagen'] = asset('storage/productos/' . $producto->imagen);
            $detalle['url'] = route('front.producto', [$producto->id, Str::slug($producto->nombre)]);
            $detalle['producto'] = $producto;
            return $detalle;
        }, $carrito_detalles);
        // foreach ($carrito_detalles as $pos => $detalle) {
        //     $subtotal+=$detalle['precio']*$detalle['cantidad'];
        // }
        // $ciudad=Ciudad::where('id',$request['ciudad'])->where('visible', 1)->first();
        // if ($ciudad==NULL) {
        //     return back()->withErrors('No se encuentra la ciudad especificada o esta desactivada ');
        // }
        // $envio=$ciudad->delivery;
        // $descuento=0;

        if (sizeof($carrito_detalles)>=1) {
            $pedido=Pedido::create([
                'nombre'=>$request['nombre'],
                'telefono'=>$request['telefono'],
                'email'=>$request['email'],
                'empresa'=>$request['empresa'],
                'mensaje'=>$request['mensaje']
            ]);
            if ($pedido==NULL) {
                return back()->withErrors('Ocurrió un error, favor volver a intentar en unos minutos');
            }else {
                foreach ($carrito_detalles as $pos => $detalle) {
                    PedidoDetalle::create([
                        'pedido_id'=>$pedido->id,
                        'cod_articulo'=>$detalle['cod_articulo'],
                        'cantidad'=>$detalle['cantidad']
                    ]);
                }
                $pedido->finalizar();
                Cookie::queue(Cookie::forget('productos'));
                return redirect()->route('front.presupuesto')->with('status', 'Su solicitud de presupuesto se ha realizado con éxito.');

            }
        }else {
            return back()->withErrors('El carrito se encuentra vacio');
        }

    }

    public function carritoResumen(Request $request, $id_md5){
        $pedido = Pedido::where('estado',1)->where(DB::raw('md5(id)'),$id_md5)->first();
        if ($pedido==NULL) {
            return back()->withErrors('No se encuentra el pedido definido');
        }else {
            return view('front.resumen', compact('pedido'));
        }
    }

    public function sendContacto(Request $request){

        $validator = \Validator::make(
            $request->all(), [
                'nombre' => 'required|max:255',
                'email' => 'required|email|max:255',
                'telefono' => 'required|max:255',
                'asunto' => 'required|integer',
                'mensaje' => 'required',
			    'g-recaptcha-response' => ['required', new ReCaptchaRule() ]
            ]
        );

        if($request->asunto == '1'){
            $asunto = 'Contacto';
        } else if ($request->asunto == '2'){
            request()->validate([ 'archivo' => 'required' ]);
            $asunto = 'Trabajá con nosotros';
        } else {
            $asunto = 'Quejas y Sugerencias';
        }

        if ($validator->fails()) {
            return redirect('contacto')->withInput()->withErrors($validator);
        }

        // $color_principal=Opcion::where('name','color_principal')->first();
        $logo=Opcion::where('name','logo')->first();
        $email_empresa=Opcion::where('name','mail')->first();
        $emails_recepcion=Opcion::where('name','mail_contacto')->first();
        $nombre_empresa=Opcion::where('name','nombre_comercio')->first();
        // if ($color_principal==NULL) {
        //     $color_principal='#222021';
        // }else {
        //     $color_principal=$color_principal['value'];
        // }
        if (!$logo==NULL) {
            $logo=$logo['value'];
        }
        if ($emails_recepcion==NULL) {
            $GLOBALS['emailis_copia']=array('carlos.sosa@porta.com.py');
        }else {
            $GLOBALS['emailis_copia']=explode(',', $emails_recepcion['value']);
            array_push($GLOBALS['emailis_copia'], 'carlos.sosa@porta.com.py');
        }
        if ($email_empresa==NULL) {
            $GLOBALS['email_empresa']='no-reply@empresa.com';
        }else {
            $GLOBALS['email_empresa']=$email_empresa['value'];
        }
        if ($nombre_empresa==NULL) {
            $GLOBALS['nombre_empresa']='Nombre comercio';
        }else {
            $GLOBALS['nombre_empresa']=$nombre_empresa['value'];
        }

        $nombre = $request->nombre;
        $email = $request->email;
        $telefono = $request->telefono;
        $mensaje = $request->mensaje;
        $direccion = $request->direccion;

        $GLOBALS['email']=$email;
        $GLOBALS['nombre']=$nombre;
        $GLOBALS['asunto']=$asunto;

        if($request->hasFile('archivo')) {
            $filePathName = Str::slug($nombre).'-'.time() . '.' .$request->file('archivo')->getClientOriginalExtension();
            $request->file('archivo')->move(base_path() . '/public/uploads/', $filePathName);
        }else {
            $filePathName=NULL;
        }

        $GLOBALS['filePathName']=$filePathName;

        \Mail::send('emails.contacto_email', [
            'nombre' => $nombre,
            'email' => $email,
            'telefono' => $telefono,
            'mensaje' => $mensaje,
            'asunto' => $asunto,
            'logo' => $logo,
            'direccion' => $direccion,
            'nombre_empresa' =>$GLOBALS['nombre_empresa'],

        ], function ($message) {
            $message->from($GLOBALS['email_empresa'], $GLOBALS['nombre_empresa']);
            $message->sender($GLOBALS['email_empresa'], $GLOBALS['nombre_empresa']);
            foreach ($GLOBALS['emailis_copia'] as $pos => $aux_email) {
                $message->cc(trim($aux_email), $GLOBALS['nombre_empresa']);
            }
            $message->returnPath('desarrollo@porta.com.py');
            $message->to($GLOBALS['email'], $GLOBALS['nombre'])->subject($GLOBALS['asunto']);
            if (strlen($GLOBALS['filePathName'])>=1) {
                $message->attach(base_path() . '/public/uploads/'. $GLOBALS['filePathName']);
            }
            $message->getSwiftMessage();
        });

        return redirect('contacto')->with('status', 'El mensaje se envio de manera correcta!');

    }

    public function sendServicio(Request $request){

        $validator = \Validator::make(
            $request->all(), [
                'nombre' => 'required|max:255',
                'ciudad' => 'required|ciudad|max:255',
                'email' => 'required|email|max:255',
                'telefono' => 'required|max:255',
                'direccion' => 'required|max:255',
                'mensaje' => 'required',
			    'g-recaptcha-response' => ['required', new ReCaptchaRule() ]
            ]
        );

        if ($validator->fails()) {
            return redirect(route('front.servicio_tecnico'))->withInput()->withErrors($validator);
        }

        // $color_principal=Opcion::where('name','color_principal')->first();
        $logo=Opcion::where('name','logo')->first();
        $email_empresa=Opcion::where('name','mail')->first();
        $emails_recepcion=Opcion::where('name','mail_contacto')->first();
        $nombre_empresa=Opcion::where('name','nombre_comercio')->first();
        // if ($color_principal==NULL) {
        //     $color_principal='#222021';
        // }else {
        //     $color_principal=$color_principal['value'];
        // }
        if (!$logo==NULL) {
            $logo=$logo['value'];
        }
        if ($emails_recepcion==NULL) {
            $GLOBALS['emailis_copia']=array('carlos.sosa@porta.com.py');
        }else {
            $GLOBALS['emailis_copia']=explode(',', $emails_recepcion['value']);
            array_push($GLOBALS['emailis_copia'], 'carlos.sosa@porta.com.py');
        }
        if ($email_empresa==NULL) {
            $GLOBALS['email_empresa']='no-reply@empresa.com';
        }else {
            $GLOBALS['email_empresa']=$email_empresa['value'];
        }
        if ($nombre_empresa==NULL) {
            $GLOBALS['nombre_empresa']='Nombre comercio';
        }else {
            $GLOBALS['nombre_empresa']=$nombre_empresa['value'];
        }

        $nombre = $request->nombre;
        $ciudad = $request->ciudad;
        $email = $request->email;
        $telefono = $request->telefono;
        $mensaje = $request->mensaje;
        $direccion = $request->direccion;
        $asunto = 'Solicitud de Servicio Técnico';

        $GLOBALS['email']=$email;
        $GLOBALS['nombre']=$nombre;
        $GLOBALS['asunto']=$asunto;

        \Mail::send('emails.servicio_email', [
            'nombre' => $nombre,
            'ciudad' => $ciudad,
            'email' => $email,
            'telefono' => $telefono,
            'mensaje' => $mensaje,
            'asunto' => $asunto,
            'logo' => $logo,
            'direccion' => $direccion,
            'nombre_empresa' =>$GLOBALS['nombre_empresa'],

        ], function ($message) {
            $message->from($GLOBALS['email_empresa'], $GLOBALS['nombre_empresa']);
            $message->sender($GLOBALS['email_empresa'], $GLOBALS['nombre_empresa']);
            foreach ($GLOBALS['emailis_copia'] as $pos => $aux_email) {
                $message->cc(trim($aux_email), $GLOBALS['nombre_empresa']);
            }
            $message->returnPath('carlos.sosa@porta.com.py');
            $message->to($GLOBALS['email'], $GLOBALS['nombre'])->subject($GLOBALS['asunto']);
            $message->getSwiftMessage();
        });

        return redirect(route('front.servicio_tecnico'))->with('status', 'La solicitud se envio de manera correcta!');

    }

}
