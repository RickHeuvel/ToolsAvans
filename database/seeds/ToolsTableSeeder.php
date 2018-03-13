<?php

use Illuminate\Database\Seeder;

class ToolsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tools')->insert([
            'name' => 'Heroku',
            'slug' => 'heroku',
            'uploader_id' => '1',
            'category_slug' => 'webservice',
            'status' => 'actief',
            'description' => 'Heroku is een cloudplatform als een service (PaaS) dat verschillende programmeertalen ondersteunt en wordt gebruikt als een implementatiemodel voor webtoepassingen. Heroku, een van de eerste cloudplatformen, is in ontwikkeling sinds juni 2007, toen het alleen de programmeertaal Ruby ondersteunde, maar nu Java, Node.js, Scala, Clojure, Python, PHP en Go ondersteunt. [1] [ 2] Om deze reden wordt gezegd dat Heroku een polyglot platform is, omdat het de ontwikkelaar in staat stelt applicaties op een vergelijkbare manier in alle talen te bouwen, uit te voeren en te schalen. Heroku werd in 2010 overgenomen door Salesforce.com voor $ 212 miljoen. [3]',
            'logo_filename' => 'heroku-thumbnail.png',
            'url' => 'https://heroku.com/',
            'slug' => 'heroku',
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('tools')->insert([
            'name' => 'Webdictaat',
            'uploader_id' => '1',
            'category_slug' => 'website',
            'status' => 'actief',
            'description' => 'Nice description! A lot of useful info!',
            'logo_filename' => 'heroku-thumbnail.png',
            'url' => 'https://webdictaat.com/',
            'slug' => 'webdictaat',
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('tools')->insert([
            'name' => 'Kahoot!',
            'uploader_id' => '1',
            'category_slug' => 'website',
            'status' => 'actief',
            'description' => 'Kahoot! is een onderwijsplatform uit Noorwegen. Kahoot! werkt met multiple choice-quizzen genaamd kahoots. Gebruikers hoeven niet geregistreerd te zijn om aan een kahoot deel te nemen, maar er is wel een registratie vereist om zelf kahoots te maken.
            Kahoot! is begonnen als een project tussen Mobitroll en de Technisch-natuurwetenschappelijke Universiteit van Noorwegen, maar is nu een op zichzelf staand bedrijf genaamd Kahoot!',
            'logo_filename' => 'heroku-thumbnail.png',
            'url' => 'https://kahoot.com/',
            'slug' => 'kahoot',
            'created_at' => date("Y-m-d H:i:s")
        ]);
        if(!is_dir('storage/app/tool-images'))
            mkdir('storage/app/tool-images');
        copy('http://www.wizarddevelopment.com/assets/heroku-logo-3fd853cc0508639b85b41af0cdc97b8f.png', 'storage/app/tool-images/heroku-logo.png');
    }
}
