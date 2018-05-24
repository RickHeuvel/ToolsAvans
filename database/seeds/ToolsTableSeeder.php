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
            'name' => 'Github',
            'uploader_id' => '1',
            'category_slug' => 'webservice',
            'status_slug' => 'actief',
            'description' => 'GitHub is een populaire website waarop software kan geplaatst worden. GitHub is gebouwd rond het Git-versiebeheersysteem, waardoor GitHub alle mogelijkheden van Git en eigen toevoegingen aanbiedt. Het beschikt onder ander over toegangscontrole en verschillende samenwerkingsfuncties, zoals een issue tracker, een forum voor het aanvragen van functies, takenlijsten en wikis voor ieder project. Op GitHub staat veel opensourcesoftware omdat bij de gratis versie standaard de broncode kan ingekeken worden door derden.',
            'logo_filename' => 'github-logo.png',
            'url' => 'https://github.com',
            'slug' => 'github',
            'created_at' => now(),
        ]);

        DB::table('tools')->insert([
            'name' => 'Google Drive',
            'uploader_id' => '1',
            'category_slug' => 'webservice',
            'status_slug' => 'actief',
            'description' => 'Google Drive is een service voor bestandsopslag en synchronisatie die is gemaakt en wordt beheerd door Google. Met Google Drive kunnen documenten in de cloud worden opgeslagen, bestanden worden gedeeld en documenten samen met anderen worden bewerkt. Google Drive omvat Google Documenten, Spreadsheets en Presentaties (Google Docs), een virtueel kantoor dat het mogelijk maakt samen aan onder andere documenten, spreadsheets, presentaties, tekeningen en formulieren te werken. Bestanden die openbaar gedeeld worden op Google Drive kunnen door internet zoekmachines worden doorzocht.',
            'logo_filename' => 'googledrive-logo.png',
            'url' => 'https://www.google.com/drive/',
            'slug' => 'google-drive',
            'created_at' => now(),
        ]);

        DB::table('tools')->insert([
            'name' => 'Slack',
            'uploader_id' => '1',
            'category_slug' => 'download',
            'status_slug' => 'actief',
            'description' => '
        Slack verenigt de communicatie van uw hele team, waardoor uw workflow een stuk beter stroomt. Alle apps die u nodig hebt, zijn naadloos geïntegreerd in ons platform en u kunt eenvoudig al uw bestanden, oproepen, berichten en collegas op één plek zoeken en vinden',
            'logo_filename' => 'slack-logo.jpg',
            'url' => 'https://slack.com',
            'slug' => 'slack',
            'created_at' => now(),
        ]);

        DB::table('tools')->insert([
            'name' => 'Heroku',
            'uploader_id' => '1',
            'category_slug' => 'webservice',
            'status_slug' => 'actief',
            'description' => 'Heroku is een cloudplatform als een service (PaaS) dat verschillende programmeertalen ondersteunt en wordt gebruikt als een implementatiemodel voor webtoepassingen. Heroku, een van de eerste cloudplatformen, is in ontwikkeling sinds juni 2007, toen het alleen de programmeertaal Ruby ondersteunde, maar nu Java, Node.js, Scala, Clojure, Python, PHP en Go ondersteunt. Om deze reden wordt gezegd dat Heroku een polyglot platform is, omdat het de ontwikkelaar in staat stelt applicaties op een vergelijkbare manier in alle talen te bouwen, uit te voeren en te schalen.',
            'logo_filename' => 'heroku-logo.png',
            'url' => 'https://heroku.com/',
            'slug' => 'heroku',
            'created_at' => now(),
        ]);

        DB::table('tools')->insert([
            'name' => 'Kahoot',
            'uploader_id' => '1',
            'category_slug' => 'website',
            'status_slug' => 'actief',
            'description' => 'Kahoot! is een onderwijsplatform uit Noorwegen. Kahoot! werkt met multiple choice-quizzen genaamd kahoots. Gebruikers hoeven niet geregistreerd te zijn om aan een kahoot deel te nemen, maar er is wel een registratie vereist om zelf kahoots te maken.
                    Kahoot! is begonnen als een project tussen Mobitroll en de Technisch-natuurwetenschappelijke Universiteit van Noorwegen, maar is nu een op zichzelf staand bedrijf genaamd Kahoot!',
            'logo_filename' => 'kahoot-logo.jpg',
            'url' => 'https://kahoot.com/',
            'slug' => 'kahoot',
            'created_at' => now(),
        ]);

        DB::table('tools')->insert([
            'name' => 'galculator',
            'uploader_id' => '1',
            'category_slug' => 'download',
            'status_slug' => 'inactief',
            'description' => 'galculator is een op GTK 2 / GTK 3 gebaseerde rekenmachine met gewone notatie / reverse-poolsnotatie (RPN), een formule-invoermodus, verschillende nummerbasissen (DEC, HEX, OCT, BIN) en verschillende eenheden van hoekmeting (DEG, RAD, GRAD ). Het ondersteunt quad-precision floating point en 112-bit binary arithmetic.',
            'logo_filename' => 'galculator-logo.png',
            'url' => 'http://galculator.mnim.org/',
            'slug' => 'galculator',
            'created_at' => now(),
        ]);

        DB::table('tools')->insert([
            'name' => 'Photoshop',
            'uploader_id' => '1',
            'category_slug' => 'download',
            'status_slug' => 'actief',
            'description' => 'Adobe Photoshop is een grafisch programma ontwikkeld door Adobe voor het bewerken van fotos en ander digitaal beeldmateriaal via de computer. Photoshop is beschikbaar voor macOS en Windows. Tot en met versie 4 bestond er ook een Unix-variant. Tegenwoordig kunnen Linux- en Unix-gebruikers een beroep doen op CodeWeavers CrossOver, Wine, om de Windows-versie van Photoshop ook onder X Window System te laten draaien. Photoshop is gericht op professionele gebruikers. Voor minder veeleisende gebruikers is er Adobe Photoshop Elements dat een licht andere functionaliteit biedt. Dat is gratis online te gebruiken. Het heeft bijvoorbeeld de mogelijkheid om grote hoeveelheden afbeeldingen te beheren.',
            'logo_filename' => 'photoshop-logo.png',
            'url' => 'https://www.adobe.com/nl/products/photoshop.html?mv=search&s_kwcid=AL!3085!3!98195047224!e!!g!!photoshop&ef_id=Wqk1FQAAAJSwhTRz:20180314201307:s',
            'slug' => 'photoshop',
            'created_at' => now(),
        ]);

        DB::table('tools')->insert([
            'name' => 'gcolor2',
            'uploader_id' => '1',
            'category_slug' => 'download',
            'status_slug' => 'concept',
            'description' => 'gcolor2 is een simpele kleur selector dat gebaseerd is op gcolor',
            'logo_filename' => 'gcolor2-logo.jpg',
            'url' => 'http://gcolor2.sourceforge.net/',
            'slug' => 'gcolor2',
            'created_at' => now(),
        ]);

        DB::table('tools')->insert([
            'name' => 'On the hub',
            'uploader_id' => '1',
            'category_slug' => 'download',
            'status_slug' => 'actief',
            'description' => 'Op on the hub kan je verschillende software downloaden met kortingen of soms zelfs gratis software voor studenten',
            'logo_filename' => 'onthehub-logo.jpeg',
            'url' => 'https://msdnaa.avans.nl/',
            'slug' => 'onthehub',
            'created_at' => now(),
        ]);

        DB::table('tools')->insert([
            'name' => 'Visual Studio',
            'uploader_id' => '1',
            'category_slug' => 'download',
            'status_slug' => 'verouderd',
            'description' => 'Microsoft Visual Studio is een integrated development environment (IDE) van Microsoft. Het biedt een complete set ontwikkelingstools om computerprogrammas in diverse programmeertalen voor met name Windows-omgevingen te ontwikkelen. Visual Studio gebruikt software-ontwikkelingsplatformen van Microsoft zoals Windows API, Windows Forms, Windows Presentation Foundation, Microsoft Store en Microsoft Silverlight.',
            'logo_filename' => 'visualstudio-logo.png',
            'url' => 'https://www.visualstudio.com/',
            'slug' => 'visualstudio',
            'created_at' => now(),
        ]);

        DB::table('tools')->insert([
            'name' => 'Taiga',
            'uploader_id' => '1',
            'category_slug' => 'website',
            'status_slug' => 'actief',
            'logo_filename' => 'taiga-logo.png',
            'description' => 'Taiga is de ultieme tool om een scrum project in order te houden',
            'url' => 'https://taiga.io/',
            'slug' => 'taiga',
            'created_at' => now(),
        ]);

        DB::table('tools')->insert([
            'name' => 'MySQL Workbench',
            'uploader_id' => '1',
            'category_slug' => 'download',
            'status_slug' => 'actief',
            'logo_filename' => 'mysql-workbench-logo.png',
            'description' => 'Zoek een een GUI voor het beheren van je (MySQL) database? Dan is MySQL Workbench misschien wel de ideale oplossing!',
            'url' => 'https://www.mysql.com/products/workbench/',
            'slug' => 'mysql-workbench',
            'created_at' => now(),
        ]);

        DB::table('tools')->insert([
            'name' => 'Discord',
            'uploader_id' => '1',
            'category_slug' => 'download',
            'status_slug' => 'actief',
            'logo_filename' => 'discord-logo.jpg',
            'description' => 'All-in-one voice and text chat for gamers that\'s free, secure, and works on both your desktop and phone.',
            'url' => 'https://discordapp.com/',
            'slug' => 'discord',
            'created_at' => now(),
        ]);

        DB::table('tools')->insert([
            'name' => 'YouTube',
            'uploader_id' => '1',
            'category_slug' => 'website',
            'status_slug' => 'concept',
            'logo_filename' => 'youtube-logo.png',
            'description' => 'Volgens mij kijken we hier vaak naar filmpjes...',
            'url' => 'https://www.youtube.com/',
            'slug' => 'youtube',
            'created_at' => now(),
        ]);

        if (App::environment('production')) {
            DB::table('tools')->update(['status_slug' => 'concept']);
        }
    }
}
