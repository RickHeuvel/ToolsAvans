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
            'uploader_id' => '2',
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
            'uploader_id' => '2',
            'category_slug' => 'download',
            'status_slug' => 'actief',
            'description' => '
        Slack verenigt de communicatie van uw hele team, waardoor uw workflow een stuk beter stroomt. Alle apps die u nodig hebt, zijn naadloos geïntegreerd in ons platform en u kunt eenvoudig al uw bestanden, oproepen, berichten en collegas op één plek zoeken en vinden',
            'logo_filename' => 'slack-logo.png',
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
            'logo_filename' => 'kahoot-logo.png',
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
            'logo_filename' => 'gcolor2-logo.png',
            'url' => 'http://gcolor2.sourceforge.net/',
            'slug' => 'gcolor',
            'created_at' => now(),
        ]);
        
        DB::table('tools')->insert([
            'name' => 'On the hub',
            'uploader_id' => '1',
            'category_slug' => 'download',
            'status_slug' => 'actief',
            'description' => 'Op on the hub kan je verschillende software downloaden met kortingen of soms zelfs gratis software voor studenten',
            'logo_filename' => 'onthehub-logo.png',
            'url' => 'https://msdnaa.avans.nl/',
            'slug' => 'onthehub',
            'created_at' => now(),
        ]);
        
        DB::table('tools')->insert([
            'name' => 'Visual Studio',
            'uploader_id' => '1',
            'category_slug' => 'download',
            'status_slug' => 'actief',
            'description' => 'Microsoft Visual Studio is een integrated development environment (IDE) van Microsoft. Het biedt een complete set ontwikkelingstools om computerprogrammas in diverse programmeertalen voor met name Windows-omgevingen te ontwikkelen. Visual Studio gebruikt software-ontwikkelingsplatformen van Microsoft zoals Windows API, Windows Forms, Windows Presentation Foundation, Microsoft Store en Microsoft Silverlight. Het kan zowel native code als managed code produceren.
        
        Visual Studio bevat een broncode-editor die zowel IntelliSense (het code-aanvulling-component) als refactoren ondersteunt. De geïntegreerde debugger werkt zowel op broncode-niveau als op machinetaal-niveau. Daarnaast bevat Visual Studio een profiler, vormenontwerper voor het bouwen van GUI-applicaties, webontwerper, klasseontwerper en databaseschemaontwerper.
        
        Visual Studio ondersteunt 36 verschillende programmeertalen en de broncode-editor en debugger kunnen bijna elke programmeertaal ondersteunen. C, C++ en C++/CLI (via Visual C++), VB.NET (via Visual Basic .NET), C# (via Visual C#), F# (sinds Visual Studio 2010) en TypeScript (sinds Visual Studio 2013 Update 2) zijn ingebouwd. Ondersteuning voor andere talen, zoals Python, Ruby, Node.js en M, zijn beschikbaar via taalservices die apart geïnstalleerd kunnen worden. Het ondersteunt ook XML/XSLT, HTML/XHTML, JavaScript en CSS. Java (en J#) werden in het verleden ondersteund.',
            'logo_filename' => 'heroku-logo.png',
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

        if(!is_dir('storage/app/tool-images'))
            mkdir('storage/app/tool-images');
        copy('https://assets-cdn.github.com/images/modules/logos_page/GitHub-Mark.png', 'storage/app/tool-images/github-logo.png');   
        copy('https://seeklogo.com/images/G/google-drive-logo-ED4F6E7476-seeklogo.com.png', 'storage/app/tool-images/googledrive-logo.png');            
        copy('https://www.seeklogo.net/wp-content/uploads/2015/09/slack-logo-vector-download.jpg', 'storage/app/tool-images/slack-logo.png');            
        copy('https://a.slack-edge.com/bfaba/img/api/hosting_heroku.png', 'storage/app/tool-images/heroku-logo.png');            
        copy('https://gamificationplus.uk/wp-content/uploads/2017/08/a5bc8ebe-f0bb-44cd-bf0c-c12bc44c8260.jpg', 'storage/app/tool-images/kahoot-logo.png');            
        copy('http://galculator.mnim.org/images/galculator_release.png', 'storage/app/tool-images/galculator-logo.png');            
        copy('https://upload.wikimedia.org/wikipedia/commons/thumb/9/92/Adobe_Photoshop_CS6_icon.svg/2000px-Adobe_Photoshop_CS6_icon.svg.png', 'storage/app/tool-images/photoshop-logo.png');            
        copy('http://gcolor2.sourceforge.net/gcolor2-collapsed-small.jpg', 'storage/app/tool-images/gcolor2-logo.png');            
        copy('https://pbs.twimg.com/profile_images/420611627696668672/8YsRFlbS_400x400.jpeg', 'storage/app/tool-images/onthehub-logo.png');            
        copy('https://seeklogo.com/images/V/visual-studio-logo-14F95CF819-seeklogo.com.png', 'storage/app/tool-images/visualstudio-logo.png');            
        copy('https://taiga.io/images/logo-color.png', 'storage/app/tool-images/taiga-logo.png');
    }
}
