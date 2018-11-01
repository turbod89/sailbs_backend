<?php

use Illuminate\Database\Seeder;

class CertificatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $certificate = \App\Certificate::updateOrCreate([ 'code' => 'PNB']);
        $certificate = \App\Certificate::updateOrCreate([ 'code' => 'PER']);

        self::setNames();
    }


    public function setNames() {

        $certificate = \App\Certificate::where(['code' => 'PNB'])->first();
        $certificateTranslation = \App\CertificateTranslation::updateOrCreate(
            ['locale' => 'es', 'certificate_id' => $certificate->id],
            [
                'name' => 'Título de Patrón de Navegación Básica',
                'short_name' => 'Patrón de Navegación Básica',
                'description' => 'Este título es el de Patrón de Navegación Básica.'
            ]
        );
        $certificateTranslation = \App\CertificateTranslation::updateOrCreate(
            ['locale' => 'en', 'certificate_id' => $certificate->id],
            [
                'name' => 'Basic Coastal Skipper Certificate',
                'short_name' => 'Basic Coastal Skipper Certificate',
                'description' => 'This title is the Basic Coastal Skipper one.'
            ]
        );

        $certificate = \App\Certificate::where(['code' => 'PER'])->first();
        $certificateTranslation = \App\CertificateTranslation::updateOrCreate(
            ['locale' => 'es', 'certificate_id' => $certificate->id],
            [
                'name' => 'Título de Patrón de Embarcaciones de Recreo',
                'short_name' => 'Patrón de Embarcaciones de Recreo',
                'description' => 'Este título es el de Patrón de Embarcaciones de Recreo.'
            ]
        );
        $certificateTranslation = \App\CertificateTranslation::updateOrCreate(
            ['locale' => 'en', 'certificate_id' => $certificate->id],
            [
                'name' => 'Coastal Skipper Certificate',
                'short_name' => 'Coastal Skipper Certificate',
                'description' => 'This title is the Coastal Skipper one.'
            ]
        );


    }
}
