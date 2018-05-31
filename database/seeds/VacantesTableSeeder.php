<?php

use Illuminate\Database\Seeder;
use App\Models\Vacante;


class VacantesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Vacante::create([
            'EMPR_ID'=>1,
            'VACA_FECHAINICIO'=>'2018-05-14',
            'VACA_FECHAFIN'=>'2018-05-14',
            'VACA_REQUISITOS'=>'Se necesita ingeniero de sistemas',
            'VACA_PROGRAMA'=>'Ingenieria',            
            'VACA_SALARIO'=>1250000,
            'VACA_ESTADO'=>true,
            
        ]);
         Vacante::create([
            'EMPR_ID'=>2,
            'VACA_FECHAINICIO'=>'2018-05-01',
            'VACA_FECHAFIN'=>'2018-05-31',
            'VACA_REQUISITOS'=>'Se necesita analista de calidad de software',
            'VACA_PROGRAMA'=>'Mercadeo',
            'VACA_SALARIO'=>1050000,            
            'VACA_ESTADO'=>true,
            
        ]);

           Vacante::create([
            'EMPR_ID'=>3,
            'VACA_FECHAINICIO'=>'2018-06-01',
            'VACA_FECHAFIN'=>'2018-06-30',
            'VACA_REQUISITOS'=>'Somos una importante empresa del sector logistico con mas de 51 años de reconocimiento en el mercado siempre en la búsqueda del mejor personal para integrar su equipo de trabajo , en este momento contamos con la vacante de Practicante de sistemas preferiblemente 1 año con disponibilidad de la labor de lunes a viernes de 8 a 6 pm sábados de 8 a 12 pm - salario : SMMLV + pago de eps y Arl + servicio de alimentación gratuita.
				Fecha de contratación: 28/07/2018
				Cantidad de vacantes: 3',
            'VACA_PROGRAMA'=>'Ingenieria',
            'VACA_SALARIO'=>1500000,           
            'VACA_ESTADO'=>true,
            
        ]);
        

           Vacante::create([
            'EMPR_ID'=>4,
            'VACA_FECHAINICIO'=>'2018-06-15',
            'VACA_FECHAFIN'=>'2018-07-01',
            'VACA_REQUISITOS'=>'Labores del cargo:
Diseño de soluciones para sitios de alta concurrencia
Definición de arquitectura para aplicaciones front end, microservicios usualmente con APIs REST.
Desarrollo de componentes de software utilizando Spring Framework
Desarrollo de aplicaciones utilizando AngularJS
Desarrollo de componentes front end utilizando HTML5, CSS3 y Javascript
Trabajar de la mano de otros profesionales para mejorar la experiencia de los usuarios.

Requisitos:
Conocimientos en lenguaje de Programación Java
Servicios web XML o JSON.
Mínimo 1 año de experiencia comprobable en proyectos de desarrollo de aplicaciones web 
Conocimientos sólidos en arquitectura de software y programación orientada a objetos.
Tener un Grado de Ingeniero de Sistemas, Electrónico, Mecatrónica, Automatización o profesional que se adapte al perfil Interés en tecnologías de cara al usuario (UX)
Indispensable: HTML5, Javascript, CSS3',
            'VACA_PROGRAMA'=>'Tecnología en Sistemas',
            'VACA_SALARIO'=>2100000,           
            'VACA_ESTADO'=>true,
            
        ]);
    }
}