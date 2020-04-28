<?php

use App\Opcion;
use Illuminate\Database\Seeder;

class OpcionesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Opcion::create([
            'title' => 'Facebook',
            'type' => 'text',
            'name' => 'facebook',
            'value' => '',
            'group' => '1',
        ]);
        Opcion::create([
            'title' => 'Facebook Messenger',
            'type' => 'text',
            'name' => 'messenger',
            'value' => '',
            'group' => '1',
        ]);
        Opcion::create([
            'title' => 'WhatsApp',
            'type' => 'text',
            'name' => 'whatsapp',
            'value' => '',
            'group' => '1',
        ]);

        // Opcion::create([
        //   'title' => 'Twitter',
        //   'type' => 'text',
        //   'name' => 'twitter',
        //   'value' => '',
        //   'group' => '1',
        // ]);
        Opcion::create([
          'title' => 'Instagram',
          'type' => 'text',
          'name' => 'instagram',
          'value' => '',
          'group' => '1',
        ]);
        Opcion::create([
          'title' => 'Mail',
          'type' => 'text',
          'name' => 'mail',
          'value' => '',
          'group' => '2',
        ]);
        Opcion::create([
          'title' => 'Teléfono',
          'type' => 'text',
          'name' => 'telefono',
          'value' => '',
          'group' => '2',
        ]);
        Opcion::create([
          'title' => 'Dirección',
          'type' => 'text',
          'name' => 'direccion',
          'value' => '',
          'group' => '2',
        ]);
        Opcion::create([
          'title' => 'Horario',
          'type' => 'text',
          'name' => 'horario',
          'value' => '',
          'group' => '2',
        ]);

        // Opcion::create([
        //   'title' => 'Efectivo contra entrega',
        //   'type' => 'flag',
        //   'name' => 'pago_contado',
        //   'value' => 1,
        //   'group' => '3',
        // ]);
        // Opcion::create([
        //   'title' => 'Tarjeta de crédito contra entrega',
        //   'type' => 'flag',
        //   'name' => 'pago_tarjeta',
        //   'value' => 1,
        //   'group' => '3',
        // ]);
        Opcion::create([
          'title' => 'Nombre del comercio',
          'type' => 'text',
          'name' => 'nombre_comercio',
          'value' => 'Comercio',
          'group' => '3',
        ]);

        Opcion::create([
          'title' => 'Descripción del comercio',
          'type' => 'text',
          'name' => 'descripcion_comercio',
          'value' => 'Descripción de la empresa.',
          'group' => '3',
        ]);

        Opcion::create([
          'title' => 'Mail de contacto <small>(separado por commas para varios)</small>',
          'type' => 'text',
          'name' => 'mail_contacto',
          'value' => 'prueba@prueba.com,prueba2@prueba.com',
          'group' => '3',
        ]);

        Opcion::create([
          'title' => 'Mail de confirmación de compra <small>(separado por commas para varios)</small>',
          'type' => 'text',
          'name' => 'mail_pedido',
          'value' => 'prueba@prueba.com,prueba2@prueba.com',
          'group' => '3',
        ]);

        Opcion::create([
          'title' => 'Color principal',
          'type' => 'color',
          'name' => 'color_principal',
          'value' => '#222021',
          'group' => '3',
        ]);
        Opcion::create([
          'title' => 'Color secundario',
          'type' => 'color',
          'name' => 'color_secundario',
          'value' => '#F5A5BA',
          'group' => '3',
        ]);
        Opcion::create([
          'title' => 'Logo del comercio',
          'type' => 'imagen',
          'name' => 'logo',
          'value' => '',
          'group' => '3',
        ]);
        Opcion::create([
          'title' => 'Titulo Carrusel 1',
          'type' => 'text',
          'name' => 'carrusel_1',
          'value' => 'Carrusel 1',
          'group' => '3',
        ]);
        Opcion::create([
          'title' => 'Titulo Carrusel 2',
          'type' => 'text',
          'name' => 'carrusel_2',
          'value' => 'Carrusel 2',
          'group' => '3',
        ]);


    }
}
