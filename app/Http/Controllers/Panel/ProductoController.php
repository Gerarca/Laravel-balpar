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
use Str;
use App\Producto;
use App\Categoria;
use App\Marca;
use App\Uso;
use App\Rubro;
use App\Etiqueta;
use App\ImagenProducto;
use App\Proveedor;

class ProductoController extends Controller
{
    public function __construct(Producto $productos, Categoria $categorias, Marca $marcas)
    {
        $this->middleware('auth');
        $this->productos = $productos;
        $this->categorias = $categorias;
        $this->marcas = $marcas;
    }


    public function index()
    {
        $productos = $this->productos->orderBy('id', 'desc')->get();
        return view('panel.producto.index', compact('productos'));
    }


    public function create(Producto $producto)
    {
        $categorias = Categoria::orderBy('categoria')->get();
        $marcas = Marca::orderBy('nombre')->get();
        $etiquetas = Etiqueta::orderBy('nombre')->get();
        return view('panel.producto.form', compact('producto', 'categorias', 'marcas', 'etiquetas'));
    }

    public function store(Request $request)
    {
        request()->validate([
            'categoria_id' => 'required|exists:categorias,id',
            'marca_id' => 'required|exists:marcas,id',
            'uso_id' => 'required|exists:usos,id',
            'rubro_id' => 'required|exists:rubros,id',
            'nombre' => 'required|max:255',
            'subtitulo' => 'required',
            'cod_articulo' => 'required|max:255',
            'descripcion' => 'required',
            'imagen' => 'required|image',
            'imagen2' => 'image',
            'imagen3' => 'image',
            'imagen4' => 'image',
            'medidas' => 'image'
        ]);

        $request['visible'] = $request['visible'] ? '1' : '0';
        $request['destacado_comercial'] = $request['destacado_comercial'] ? '1' : '0';
        $request['destacado_industrial'] = $request['destacado_industrial'] ? '1' : '0';

        $imageName = 'i-'. Str::slug($request->nombre).'-'.time() . '.' .$request->file('imagen')->getClientOriginalExtension();
        $destino = base_path() . '/public/storage/productos/';
        $request->file('imagen')->move($destino, $imageName);
/*
        try {
            Image::make($destino . $imageName)->resize(220, 326, function ($constraint) {
                $constraint->upsize();
                $constraint->aspectRatio();
            })->encode('jpg', 70)->save($destino . 'thumbs/' . $imageName);
        } catch (\Intervention\Image\Exception\NotSupportedException $e) {
            report($e);
            Session::flash('alerta', 'La imagen principal no se pudo redimensionar porque es un formato no soportado');
        }
*/
        if ($request->hasFile('imagen2')) {
            $imageName2 = 'i2'. Str::slug($request->nombre).'-'.time() . '.' .$request->file('imagen2')->getClientOriginalExtension();
            $destino = base_path() . '/public/storage/productos/';
            $request->file('imagen2')->move($destino, $imageName2);
            try {
                Image::make($destino . $imageName2)->resize(220, 326, function ($constraint) {
                    $constraint->upsize();
                    $constraint->aspectRatio();
                })->encode('jpg', 70)->save($destino . 'thumbs/' . $imageName2);
            } catch (\Intervention\Image\Exception\NotSupportedException $e) {
                report($e);
                Session::flash('alerta', 'La imagen 2 no se pudo redimensionar porque es un formato no soportado');
            }
        } else {
            $imageName2 = '';
        }

        if ($request->hasFile('imagen3')) {
            $imageName3 = 'i3'. Str::slug($request->nombre).'-'.time() . '.' .$request->file('imagen3')->getClientOriginalExtension();
            $destino = base_path() . '/public/storage/productos/';
            $request->file('imagen3')->move($destino, $imageName3);
            try {
                Image::make($destino . $imageName3)->resize(220, 326, function ($constraint) {
                    $constraint->upsize();
                    $constraint->aspectRatio();
                })->encode('jpg', 70)->save($destino . 'thumbs/' . $imageName3);
            } catch (\Intervention\Image\Exception\NotSupportedException $e) {
                report($e);
                Session::flash('alerta', 'La imagen 3 no se pudo redimensionar porque es un formato no soportado');
            }
        } else {
            $imageName3 = '';
        }

        if ($request->hasFile('imagen4')) {
            $imageName4 = 'i4'. Str::slug($request->nombre).'-'.time() . '.' .$request->file('imagen4')->getClientOriginalExtension();
            $destino = base_path() . '/public/storage/productos/';
            $request->file('imagen4')->move($destino, $imageName4);
            try {
                Image::make($destino . $imageName4)->resize(220, 326, function ($constraint) {
                    $constraint->upsize();
                    $constraint->aspectRatio();
                })->encode('jpg', 70)->save($destino . 'thumbs/' . $imageName4);
            } catch (\Intervention\Image\Exception\NotSupportedException $e) {
                report($e);
                Session::flash('alerta', 'La imagen 4 no se pudo redimensionar porque es un formato no soportado');
            }
        } else {
            $imageName4 = '';
        }

        if ($request->hasFile('medidas')) {
            $medidasName = 'm-'. Str::slug($request->nombre).'-'.time() . '.' .$request->file('medidas')->getClientOriginalExtension();
            $request->file('medidas')->move(base_path() . '/public/storage/productos/', $medidasName);
        } else {
            $medidasName = '';
        }

        $producto = Producto::create(
            $request->only(
                'categoria_id',
                'marca_id',
                'uso_id',
                'rubro_id',
                'nombre',
                'subtitulo',
                'cod_articulo',
                'descripcion',
                'informacion',
                'visible',
                'destacado_comercial',
                'destacado_industrial',
                'meta_keywords'
            ) + ['imagen' => $imageName] + ['imagen2' => $imageName2] + ['imagen3' => $imageName3]
              + ['imagen4' => $imageName4] + ['medidas' => $medidasName] + ['stock' => 10]
        );

        $producto->etiquetas()->attach(request('etiquetas'));

        Session::flash('mensaje', 'El producto '. $producto->nombre .' ha sido creado correctamente');
        return redirect(route('producto.index'));
    }

    public function show(Producto $producto)
    {
        return false;
    }

    public function edit(Producto $producto)
    {
        $categorias = Categoria::orderBy('categoria')->get();
        $marcas = Marca::orderBy('nombre')->get();
        $etiquetas = Etiqueta::orderBy('nombre')->get();
        return view('panel.producto.form', compact('producto', 'categorias', 'marcas', 'etiquetas'));
    }

    public function update(Request $request, Producto $producto)
    {
        request()->validate([
            'categoria_id' => 'required|exists:categorias,id',
            'marca_id' => 'required|exists:marcas,id',
            'uso_id' => 'required|exists:usos,id',
            'rubro_id' => 'required|exists:rubros,id',
            'nombre' => 'required|max:255',
            'subtitulo' => 'required',
            'cod_articulo' => 'required|max:255',
            'descripcion' => 'required',
            'imagen' => 'image',
            'imagen2' => 'image',
            'imagen3' => 'image',
            'imagen4' => 'image',
            'medidas' => 'image'
        ]);

        $request['visible'] = $request['visible'] ? '1' : '0';
        $request['destacado_comercial'] = $request['destacado_comercial'] ? '1' : '0';
        $request['destacado_industrial'] = $request['destacado_industrial'] ? '1' : '0';

        if ($request->hasFile('imagen')) {
            $imageName = 'i'. Str::slug($request->nombre).'-'.time() . '.' .$request->file('imagen')->getClientOriginalExtension();
            $destino = base_path() . '/public/storage/productos/';
            $request->file('imagen')->move($destino, $imageName);

            try {
                Image::make($destino . $imageName)->resize(220, 326, function ($constraint) {
                    $constraint->upsize();
                    $constraint->aspectRatio();
                })->encode('jpg', 70)->save($destino . 'thumbs/' . $imageName);
            } catch (\Intervention\Image\Exception\NotSupportedException $e) {
                report($e);
                Session::flash('alerta', 'La imagen principal no se pudo redimensionar porque es un formato no soportado');
            }
            $producto->fill(['imagen' => $imageName])->save();
        }

        if ($request->hasFile('imagen2')) {
            $imageName2 = 'i2'. Str::slug($request->nombre).'-'.time() . '.' .$request->file('imagen2')->getClientOriginalExtension();
            $destino = base_path() . '/public/storage/productos/';
            $request->file('imagen2')->move($destino, $imageName2);
            try {
                Image::make($destino . $imageName2)->resize(220, 326, function ($constraint) {
                    $constraint->upsize();
                    $constraint->aspectRatio();
                })->encode('jpg', 70)->save($destino . 'thumbs/' . $imageName2);
            } catch (\Intervention\Image\Exception\NotSupportedException $e) {
                report($e);
                Session::flash('alerta', 'La imagen 2 no se pudo redimensionar porque es un formato no soportado');
            }
            $producto->fill(['imagen2' => $imageName2])->save();
        }

        if ($request->hasFile('imagen3')) {
            $imageName3 = 'i3'. Str::slug($request->nombre).'-'.time() . '.' .$request->file('imagen3')->getClientOriginalExtension();
            $destino = base_path() . '/public/storage/productos/';
            $request->file('imagen3')->move($destino, $imageName3);
            try {
                Image::make($destino . $imageName3)->resize(220, 326, function ($constraint) {
                    $constraint->upsize();
                    $constraint->aspectRatio();
                })->encode('jpg', 70)->save($destino . 'thumbs/' . $imageName3);
            } catch (\Intervention\Image\Exception\NotSupportedException $e) {
                report($e);
                Session::flash('alerta', 'La imagen 3 no se pudo redimensionar porque es un formato no soportado');
            }
            $producto->fill(['imagen3' => $imageName3])->save();
        }

        if ($request->hasFile('imagen4')) {
            $imageName4 = 'i4'. Str::slug($request->nombre).'-'.time() . '.' .$request->file('imagen4')->getClientOriginalExtension();
            $destino = base_path() . '/public/storage/productos/';
            $request->file('imagen4')->move($destino, $imageName4);
            try {
                Image::make($destino . $imageName4)->resize(220, 326, function ($constraint) {
                    $constraint->upsize();
                    $constraint->aspectRatio();
                })->encode('jpg', 70)->save($destino . 'thumbs/' . $imageName4);
            } catch (\Intervention\Image\Exception\NotSupportedException $e) {
                report($e);
                Session::flash('alerta', 'La imagen 4 no se pudo redimensionar porque es un formato no soportado');
            }
            $producto->fill(['imagen4' => $imageName4])->save();
        }

        if ($request->hasFile('medidas')) {
            $medidasName = 'm-'. Str::slug($request->nombre).'-'.time() . '.' .$request->file('medidas')->getClientOriginalExtension();
            $request->file('medidas')->move(base_path() . '/public/storage/productos/', $medidasName);
            $producto->fill(['medidas' => $medidasName])->save();
        }

        $producto->fill(
            $request->only(
                'categoria_id',
                'marca_id',
                'uso_id',
                'rubro_id',
                'nombre',
                'subtitulo',
                'cod_articulo',
                'descripcion',
                'informacion',
                'visible',
                'destacado_comercial',
                'destacado_industrial',
                'meta_keywords'
            )
        )->save();

        $producto->etiquetas()->sync(request('etiquetas'));

        Session::flash('mensaje', 'El producto '. $producto->nombre .' ha sido actualizado correctamente');
        return redirect(route('producto.edit', $producto->id));
    }

    public function destroy(Producto $producto)
    {
        $producto->delete();
        Session::flash('mensaje', 'El Producto '. $producto->nombre.' ha sido eliminado');
        return redirect(route('producto.index'));
    }

    public function crearIndividual()
    {
        $producto = new Producto;
        $categorias = Categoria::all();
        $marcas = Marca::all();
        $etiquetas = Etiqueta::all();
        return view('panel.producto.form_individual', compact('producto', 'categorias', 'marcas', 'etiquetas', 'categoria'));
    }

    public function guardarIndividual(Request $request)
    {
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

    public function subirFotos(Request $request, $id)
    {
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

    protected function getLastOrden($cod_articulo)
    {
        $aux = ImagenProducto::where('cod_articulo', $cod_articulo)->orderBy('orden', 'desc')->first();

        if ($aux == null) {
            return 0;
        } else {
            return $aux->orden;
        }
    }

    public function eliminarImagen(Request $request)
    {
        $producto = Producto::whereId($request->producto_id)->update([$request->imagen => null]);
        return $producto;
    }

    public function actualizarOrden(Request $request)
    {
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

    public function galeriaFotos(Request $request)
    {
        $imagenes_secundarias = ImagenProducto::where('cod_articulo', $request->codigo_articulo)->orderBy('orden', 'asc')->get();
        return view('panel.producto.partial-fotos-secundarias', ['imagenes_secundarias' => $imagenes_secundarias]);
    }
}
