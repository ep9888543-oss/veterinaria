<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Veterinario;
use App\Models\Dueno;
use App\Models\Mascota;
use App\Models\Consulta;
use Illuminate\Support\Facades\Hash;

class DemoExpedienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Asegurar que exista un usuario veterinario
        $user = User::firstOrCreate(
            ['email' => 'dr.demo@veterinaria.com'],
            [
                'name' => 'Dr. Demo Veterinario',
                'password' => Hash::make('12345678'),
                'rol' => 'veterinario',
                'activo' => true,
            ]
        );

        // 2. Crear su perfil de veterinario
        $veterinario = Veterinario::firstOrCreate(
            ['usuario_id' => $user->id],
            [
                'nombre_completo' => 'Dr. Demo Veterinario',
                'especialidad' => 'Medicina General Canina',
                'cedula_profesional' => 'ABC-123456',
            ]
        );

        // 3. Crear el Dueño
        $dueno = Dueno::create([
            'nombre_completo' => 'Juan Pérez García',
            'telefono' => '555-987-6543',
            'direccion' => 'Av. Siempre Viva 742, Springfield',
        ]);

        // 4. Crear la Mascota
        $mascota = Mascota::create([
            'dueno_id' => $dueno->id,
            'nombre' => 'Firulais',
            'especie' => 'Perro',
            'raza' => 'Golden Retriever',
            'fecha_nacimiento' => '2020-05-15',
            'tipo_sangre' => 'DEA 1.1 Positivo',
            'comportamiento' => 'Dócil y muy activo',
            'es_adoptado' => true,
        ]);

        // 5. Crear dos consultas
        // Consulta del mes pasado
        Consulta::create([
            'mascota_id' => $mascota->id,
            'veterinario_id' => $veterinario->id,
            'fecha_consulta' => now()->subDays(30),
            'peso' => 28.5,
            'talla' => 60.5,
            'diagnostico' => 'Revisión anual de rutina. El paciente presenta buena salud, dentadura limpia y reflejos normales. Leve acumulación de cerumen en oído izquierdo.',
            'tratamiento' => 'Se realizó limpieza ótica. Se aplicó vacuna séxtuple y se entregó desparasitante interno en tabletas para administrar en casa.',
        ]);

        // Consulta del día de hoy
        Consulta::create([
            'mascota_id' => $mascota->id,
            'veterinario_id' => $veterinario->id,
            'fecha_consulta' => now(),
            'peso' => 29.0,
            'talla' => 60.5,
            'diagnostico' => 'El paciente acude por cojera intermitente en el miembro posterior derecho que inició después de jugar en el parque ayer.',
            'tratamiento' => 'Reposo restringido por 5 días. Se prescribe Meloxicam (antiinflamatorio) cada 24 horas por 3 días. Reevaluar si no hay mejoría.',
        ]);
    }
}
