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
            'owner_id' => '1',
            'category_slug' => 'webservice',
            'status_slug' => 'actief',
            'description' => 'Online versiebeheer systeem gebaseerd op Git. Een van de meest gebruikte versie beheer systemen ter werelend. Naast code management kun je hier ook issues aanmaken en tracken. Let wel op! In je gratis account zitten alleen publieke repository. ',
            'logo_filename' => 'github-logo.png',
            'url' => 'https://github.com',
            'slug' => 'github',
            'created_at' => now(),
        ]);

        DB::table('tools')->insert([
            'name' => 'Google Drive',
            'owner_id' => '1',
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
            'owner_id' => '1',
            'category_slug' => 'download',
            'status_slug' => 'actief',
            'description' => 'Maak je gebruik van what\'s app om te communiceren binnen je project team? En vergeten mensen nog wel eens afspraken? Of lezen ze de belangrijke dingen niet? Misschien is What\'s app niet de beste communicatie vorm. Probeer eens Slack! Hiermee kun je in verschillende channels makkelijk verschillende gesprekken onderhouden. ',
            'logo_filename' => 'slack-logo.jpg',
            'url' => 'https://slack.com',
            'slug' => 'slack',
            'created_at' => now(),
        ]);

        DB::table('tools')->insert([
            'name' => 'Heroku',
            'owner_id' => '1',
            'category_slug' => 'webservice',
            'status_slug' => 'actief',
            'description' => 'Nog een platform voor het hosten van webaplicaties. Heroku ondersteund applicaties zoals PHP, Python, Java, NodeJs en meer. Als groot voordeel heeft Heroku dat er een mooie bouwstraat in zit. Je kan je app koppelen aan je Github repo en hierdoor worden je applicaties bij elke \'push\' automatisch uitgerold. ',
            'logo_filename' => 'heroku-logo.png',
            'url' => 'https://heroku.com/',
            'slug' => 'heroku',
            'created_at' => now(),
        ]);

        DB::table('tools')->insert([
            'name' => 'Kahoot',
            'owner_id' => '1',
            'category_slug' => 'website',
            'status_slug' => 'actief',
            'description' => 'Een platform om in je les spannende en competetieve quizen uit te voeren. Het maken van een quiz is zo gebeurd, en je kan deze keer op keer hergebruiken. Een wedstrijdje vragen beantwoorden hoeft niet lang te duren!',
            'logo_filename' => 'kahoot-logo.jpg',
            'url' => 'https://kahoot.it/',
            'slug' => 'kahoot',
            'created_at' => now(),
        ]);

        DB::table('tools')->insert([
            'name' => 'galculator',
            'owner_id' => '1',
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
            'owner_id' => '1',
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
            'owner_id' => '1',
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
            'owner_id' => '1',
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
            'owner_id' => '1',
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
            'owner_id' => '1',
            'category_slug' => 'website',
            'status_slug' => 'actief',
            'logo_filename' => 'taiga-logo.png',
            'description' => 'Taiga is een Taskboard applicatie waarbij je de mogelijkheid hebt om je taken te beheren in de vorm van een scrum of kanban bord. Het is een zeer toegankelijk platform waarbij je ook nog de mogelijheid hebt om deze met andere platformen zoals Github aan te sluiten.',
            'url' => 'https://taiga.io/',
            'slug' => 'taiga',
            'created_at' => now(),
        ]);

        DB::table('tools')->insert([
            'name' => 'MySQL Workbench',
            'owner_id' => '1',
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
            'owner_id' => '1',
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
            'owner_id' => '1',
            'category_slug' => 'website',
            'status_slug' => 'concept',
            'logo_filename' => 'youtube-logo.png',
            'description' => 'Volgens mij kijken we hier vaak naar filmpjes...',
            'url' => 'https://www.youtube.com/',
            'slug' => 'youtube',
            'created_at' => now(),
        ]);

        DB::table('tools')->insert([
            'name' => 'Trello',
            'owner_id' => '1',
            'category_slug' => 'webservice',
            'status_slug' => 'concept',
            'logo_filename' => 'trello-logo.png',
            'description' => 'Trello is vergelijkbaar met Taiga. Het is een platform voor taken management. Het is een iets simpelere versie van Taiga waardoor het meer toegankelijk is maar minder uitgebreide features bevat. ',
            'url' => 'https://trello.com/',
            'slug' => 'trello',
            'created_at' => now(),
        ]);

        DB::table('tools')->insert([
            'name' => 'Webdictaat',
            'owner_id' => '1',
            'category_slug' => 'website',
            'status_slug' => 'actief',
            'logo_filename' => 'webdictaat-logo.png',
            'description' => 'Een online platform dat draait binnen het AII netwerk. Hier kun je je lesmaterial op een meer aantrekkelijke manier aanbieden. Zie het als een alternatief voor PDf. Met de mogelijkheid tot quisjes, polletjes, video\'s en een punten systeem met bijbehorende opdracht.',
            'url' => 'http://webdictaat.aii.avans.nl/cms/',
            'slug' => 'webdictaat',
            'created_at' => now(),
        ]);

        DB::table('tools')->insert([
            'name' => 'Answergarden',
            'owner_id' => '1',
            'category_slug' => 'website',
            'status_slug' => 'concept',
            'logo_filename' => 'answergarden-logo.png',
            'description' => 'Een online platform waarmee je input uit de klas kan invetariseren. Wil je de input van je studenten? Open een nieuw \'tuintje\' en de studenten kunnen via de laptop en  telefoon input leveren. ',
            'url' => 'https://answergarden.ch/',
            'slug' => 'answergarden',
            'created_at' => now(),
        ]);

        DB::table('tools')->insert([
            'name' => 'Avans webhosting (student.aii.avans.nl)',
            'owner_id' => '1',
            'category_slug' => 'webservice',
            'status_slug' => 'concept',
            'logo_filename' => 'avans-a-logo.jpg',
            'description' => 'Hier kunnen studenten websites hosten voor de vakken WEBS1 en WEBS2. Het is gratis en je krijgt ondersteuning vanuit onze helpdesk. Voornamelijk HTML, PHP en ASP.net sites worden ondersteund. ',
            'url' => 'http://student.aii.avans.nl/',
            'slug' => 'avanswebhosting',
            'created_at' => now(),
        ]);

        DB::table('tools')->insert([
            'name' => 'Avans databases (databases.aii.avans.nl)',
            'owner_id' => '1',
            'category_slug' => 'webservice',
            'status_slug' => 'concept',
            'logo_filename' => 'avans-a-logo.jpg',
            'description' => 'Hier kunnen studenten van onze academie een database aanvragen. Het is een MySQL database. Je krijgt als informatica student standaard 2 databases. Het is ook mogelijk om voor je projectgroep een database aan te vragen. Toegang is via MySqlWorkbench. Je kan ook via je locale workbench verbinden. ',
            'url' => 'http://databases.aii.avans.nl/',
            'slug' => 'avansdatabases',
            'created_at' => now(),
        ]);

        DB::table('tools')->insert([
            'name' => 'Azure',
            'owner_id' => '1',
            'category_slug' => 'webservice',
            'status_slug' => 'concept',
            'logo_filename' => 'azure-logo.jpg',
            'description' => 'Een platform voor het hosten van database, webapplicaties, Micro-services en nog veel meer! Je kan als student een gratis account krijgen, maar hiervoor moet je wel je telefoonnummer inleveren. Werkt uitstekend samen met Microsoft tooling, maar heeft een pittige leer curve.',
            'url' => 'http://portal.azure.com',
            'slug' => 'azure',
            'created_at' => now(),
        ]);

        DB::table('tools')->insert([
            'name' => 'mLab',
            'owner_id' => '1',
            'category_slug' => 'webservice',
            'status_slug' => 'concept',
            'logo_filename' => 'mlab-logo.png',
            'description' => 'Een platform wat mooi samenwerkt met Heroku. Wil je een NoSQL database gratis online hosten? Dan is dit de plek! Je kan gratis een database aanmaken in een sandbox omgeving. ',
            'url' => 'https://mlab.com/',
            'slug' => 'mlab',
            'created_at' => now(),
        ]);

        DB::table('tools')->insert([
            'name' => 'BitBucket',
            'owner_id' => '1',
            'category_slug' => 'webservice',
            'status_slug' => 'concept',
            'logo_filename' => 'bitbucket-logo.png',
            'description' => 'Een populair alternatief voor Github. Ook gebaseerd op Git. Hier mag je wel privé repository aanmaken met een gratis account. Daarnaast is er een iets uitgebreider issue tracking systeem. ',
            'url' => 'https://bitbucket.org/product',
            'slug' => 'bitbucket',
            'created_at' => now(),
        ]);

        DB::table('tools')->insert([
            'name' => 'Avans inschrijftool',
            'owner_id' => '1',
            'category_slug' => 'webservice',
            'status_slug' => 'concept',
            'logo_filename' => 'avans-a-logo.png',
            'description' => 'Deze tool wordt gebruikt voor het inschrijven op verschillende websites én het plannen van afspraken.',
            'url' => 'http://inschrijven.aii.avans.nl/',
            'slug' => 'avansinschrijftool',
            'created_at' => now(),
        ]);

        DB::table('tools')->insert([
            'name' => 'Avans TWIN',
            'owner_id' => '1',
            'category_slug' => 'website',
            'status_slug' => 'concept',
            'logo_filename' => 'avans-a-logo.png',
            'description' => 'Bepaal nu met wie je in de klas wil zitten!',
            'url' => 'http://twin.aii.avans.nl/',
            'slug' => 'avanstwin',
            'created_at' => now(),
        ]);

        DB::table('tools')->insert([
            'name' => 'GitLab',
            'owner_id' => '1',
            'category_slug' => 'download',
            'status_slug' => 'concept',
            'logo_filename' => 'gitlab-logo.jpg',
            'description' => 'Whether you use Waterfall, Agile, or Conversational Development, GitLab streamlines your collaborative workflows. Visualize, prioritize, coordinate, and track your progress your way with GitLab’s flexible project management tools.',
            'url' => 'https://about.gitlab.com/',
            'slug' => 'gitlab',
            'created_at' => now(),
        ]);

        DB::table('tools')->insert([
            'name' => 'Screencast-O-Matic',
            'owner_id' => '1',
            'category_slug' => 'download',
            'status_slug' => 'concept',
            'logo_filename' => 'screencastomatic-logo.png',
            'description' => 'Screencast-O-Matic is trusted by millions of users to create and share screen recordings.',
            'url' => 'https://screencast-o-matic.com/',
            'slug' => 'screencastomatic',
            'created_at' => now(),
        ]);

        DB::table('tools')->insert([
            'name' => 'ScreenToGif',
            'owner_id' => '1',
            'category_slug' => 'download',
            'status_slug' => 'concept',
            'logo_filename' => 'screentogif-logo.png',
            'description' => 'Screen, webcam and sketchboard recorder with an integrated editor.',
            'url' => 'http://www.screentogif.com/',
            'slug' => 'screentogif',
            'created_at' => now(),
        ]);
        if (App::environment('production')) {
            DB::table('tools')->update(['status_slug' => 'concept']);
        }
    }
}
