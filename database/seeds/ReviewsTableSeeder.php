<?php

use Illuminate\Database\Seeder;

class ReviewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tool_reviews')->insert([
            'tool_slug' => 'heroku',
            'user_id' => '8',
            'title' => 'Goede webhosting, makkelijk in gebruik',
            'rating' => '5',
            'description' => 'Heroku werkt goed samen met travis, ik beveel het erg aan medestudenten.',
            'created_at' => now(),
        ]);

        DB::table('tool_reviews')->insert([
            'tool_slug' => 'heroku',
            'user_id' => '9',
            'title' => 'Prima service om je website op te laten draaien',
            'rating' => '5',
            'description' => 'Je maakt je website en vervolgens staat deze online op het www. Hoe tof is dat?',
            'created_at' => now(),
        ]);

        DB::table('tool_reviews')->insert([
            'tool_slug' => 'heroku',
            'user_id' => '10',
            'title' => '*facepalm*',
            'rating' => '1',
            'description' => 'Heroku heeft opeens mijn website weg gehaald toen ik deze had geüploaded op de heroku server. Pls fix dit!',
            'created_at' => now(),
        ]);

        DB::table('tool_reviews')->insert([
            'tool_slug' => 'heroku',
            'user_id' => '11',
            'title' => 'Mwa, jammer van de plaatjes...',
            'rating' => '3',
            'description' => 'Het is een enorm geklooi om foto\'s van mijn website op de heroku server te plaatsen',
            'created_at' => now(),
        ]);

        DB::table('tool_reviews')->insert([
            'tool_slug' => 'heroku',
            'user_id' => '12',
            'title' => 'WAUW, WAUW, EN NOG EENS WAUW!!!',
            'rating' => '5',
            'description' => 'eCHT EEN PRIMA WEBSERVER. wAUW!',
            'created_at' => now(),
        ]);

        DB::table('tool_reviews')->insert([
            'tool_slug' => 'heroku',
            'user_id' => '11',
            'title' => 'Plug-ins zijn best OK',
            'rating' => '4',
            'description' => 'In Heroku is er een brede keus aan plug-ins. Opzich is dat best fijn.',
            'created_at' => now(),
        ]);

        DB::table('tool_reviews')->insert([
            'tool_slug' => 'github',
            'user_id' => '12',
            'title' => 'Must have voor elk project!',
            'rating' => '5',
            'description' => 'Github is voor mij essentieel voor het werken in projecten.',
            'created_at' => now(),
        ]);

        DB::table('tool_reviews')->insert([
            'tool_slug' => 'github',
            'user_id' => '8',
            'title' => 'Beter dan Bitbucket',
            'rating' => '4',
            'description' => 'GitHub is beter dan Bitbucket, maar ik heb nog wel wat verbeterpunten gezien.',
            'created_at' => now(),
        ]);

        DB::table('tool_reviews')->insert([
            'tool_slug' => 'github',
            'user_id' => '9',
            'title' => 'Tja...',
            'rating' => '4',
            'description' => 'Opzich best OK tool, maar soms doet het niet helemaal wat je verwacht.',
            'created_at' => now(),
        ]);

        DB::table('tool_reviews')->insert([
            'tool_slug' => 'github',
            'user_id' => '10',
            'title' => '',
            'rating' => '2',
            'description' => 'Al die toestanden met accounts heb je hier niet, maar hoezo is alles in GitHub openbaar? Dat slaat echt nergens op, want ik wil gewoon mijn repositories privé houden. Niemand hoeft te weten wat ik op dit moment aan het maken ben enz.',
            'created_at' => now(),
        ]);

        DB::table('tool_reviews')->insert([
            'tool_slug' => 'github',
            'user_id' => '11',
            'title' => 'Hoe werkt git?',
            'rating' => '5',
            'description' => 'Heeft iemand enig idee hoe GitHub werkt? Ik wil dit gaan gebruiken in mijn project, omdat we met veel teamleden zijn.',
            'created_at' => now(),
        ]);

        DB::table('tool_reviews')->insert([
            'tool_slug' => 'github',
            'user_id' => '12',
            'title' => 'Nog nooit zo fijn gewerkt als met GitHub!',
            'rating' => '5',
            'description' => '',
            'created_at' => now(),
        ]);

        DB::table('tool_reviews')->insert([
            'tool_slug' => 'google-drive',
            'user_id' => '11',
            'title' => 'Samen documenten maken',
            'rating' => '4',
            'description' => 'Samen documenten maken is de beste feature van Googol Drive.',
            'created_at' => now(),
        ]);

        DB::table('tool_reviews')->insert([
            'tool_slug' => 'google-drive',
            'user_id' => '12',
            'title' => 'Goud',
            'rating' => '5',
            'description' => 'Echt goud waard!',
            'created_at' => now(),
        ]);

        DB::table('tool_reviews')->insert([
            'tool_slug' => 'google-drive',
            'user_id' => '8',
            'title' => 'Zilver',
            'rating' => '4',
            'description' => 'Hé, das best een grappige manier van beoordelen als het doet net zoals Bram-Boris',
            'created_at' => now(),
        ]);

        DB::table('tool_reviews')->insert([
            'tool_slug' => 'google-drive',
            'user_id' => '9',
            'title' => 'Niet heel vertrouwelijk',
            'rating' => '2',
            'description' => 'Ik lees allemaal rare dingen over de Cloud. Ik vertrouw het Amerikaanse Privacybeleid niet...',
            'created_at' => now(),
        ]);

        DB::table('tool_reviews')->insert([
            'tool_slug' => 'google-drive',
            'user_id' => '10',
            'title' => 'Werkt perfect voor mijn project',
            'rating' => '5',
            'description' => 'Werkt perfect voor mijn project',
            'created_at' => now(),
        ]);

        DB::table('tool_reviews')->insert([
            'tool_slug' => 'google-drive',
            'user_id' => '11',
            'title' => 'Al mijn bestanden op alle apparaten',
            'rating' => '5',
            'description' => 'Het is gewoon ongelovelijk: ik heb toegang tot al mijn bestanden op elk apparaat!',
            'created_at' => now(),
        ]);

        DB::table('tool_reviews')->insert([
            'tool_slug' => 'slack',
            'user_id' => '12',
            'title' => 'Kan beter',
            'rating' => '3',
            'description' => 'Slack heeft veel potentie, maar ze mogen wel wat veranderen aan het hoge RAM gebruik van hun desktop applicatie',
            'created_at' => now(),
        ]);

        DB::table('tool_reviews')->insert([
            'tool_slug' => 'slack',
            'user_id' => '11',
            'title' => 'Werkt voor geen ene meter. FIX DIT!',
            'rating' => '1',
            'description' => 'Slack werkt niet op OpenSUSE.',
            'created_at' => now(),
        ]);

        DB::table('tool_reviews')->insert([
            'tool_slug' => 'slack',
            'user_id' => '12',
            'title' => 'Projectwerk at its finest',
            'rating' => '5',
            'description' => 'Wij gebruiken het voor elk project.',
            'created_at' => now(),
        ]);

        DB::table('tool_reviews')->insert([
            'tool_slug' => 'slack',
            'user_id' => '8',
            'title' => '',
            'rating' => '4',
            'description' => 'Werkt prima, maar ik zou graag mijn eigen stijl willen maken in de desktop app',
            'created_at' => now(),
        ]);

        DB::table('tool_reviews')->insert([
            'tool_slug' => 'slack',
            'user_id' => '9',
            'title' => 'Hoezo ontvangt niemand mijn uitnodigingen?',
            'rating' => '3',
            'description' => 'Hallo allemaal, ik zoek een manier om mensen uit te nodigen in mijn groep. Weet iemand hoe dit moet?',
            'created_at' => now(),
        ]);

        DB::table('tool_reviews')->insert([
            'tool_slug' => 'slack',
            'user_id' => '10',
            'title' => 'Bah, ik gebruik liever Discord',
            'rating' => '1',
            'description' => '',
            'created_at' => now(),
        ]);

        DB::table('tool_reviews')->insert([
            'tool_slug' => 'kahoot',
            'user_id' => '11',
            'title' => 'Leuke, andere manier voor een quiz',
            'rating' => '4',
            'description' => 'Weg met de quiz, kahoot! is hier die een interactieve manier geeft om te leren.',
            'created_at' => now(),
        ]);

        DB::table('tool_reviews')->insert([
            'tool_slug' => 'kahoot',
            'user_id' => '12',
            'title' => 'Echt een manier om de aandacht van de klas terug te krijgen',
            'rating' => '5',
            'description' => 'Leerlingen gebruiken graag Kahoot! Aanrader.',
            'created_at' => now(),
        ]);

        DB::table('tool_reviews')->insert([
            'tool_slug' => 'kahoot',
            'user_id' => '11',
            'title' => 'Stom',
            'rating' => '2',
            'description' => 'De quizzen die gemaakt worden zijn soms zo saai, maar de gebruikersnamen zijn grappig xD',
            'created_at' => now(),
        ]);

        DB::table('tool_reviews')->insert([
            'tool_slug' => 'kahoot',
            'user_id' => '12',
            'title' => 'Jah, KahOOOOOOOOT!',
            'rating' => '4',
            'description' => 'Maak de blitz met Kahoot! Maar de kamernamen zijn te lang of vervelend om in te voeren.',
            'created_at' => now(),
        ]);

        DB::table('tool_reviews')->insert([
            'tool_slug' => 'kahoot',
            'user_id' => '8',
            'title' => '',
            'rating' => '4',
            'description' => '',
            'created_at' => now(),
        ]);

        DB::table('tool_reviews')->insert([
            'tool_slug' => 'kahoot',
            'user_id' => '9',
            'title' => '',
            'rating' => '5',
            'description' => '',
            'created_at' => now(),
        ]);

        DB::table('tool_reviews')->insert([
            'tool_slug' => 'galculator',
            'user_id' => '10',
            'title' => 'Een rekenmachine',
            'rating' => '4',
            'description' => 'Voor Linux gebruikers kan je dit niet missen op je systeem.',
            'created_at' => now(),
        ]);

        DB::table('tool_reviews')->insert([
            'tool_slug' => 'galculator',
            'user_id' => '11',
            'title' => 'Wordt al jaren niet geüpdated',
            'rating' => '1',
            'description' => 'Wat een ouwe zooi! Sinds 2005 niet meer geüpdated.',
            'created_at' => now(),
        ]);

        DB::table('tool_reviews')->insert([
            'tool_slug' => 'galculator',
            'user_id' => '12',
            'title' => 'Chill',
            'rating' => '4',
            'description' => '',
            'created_at' => now(),
        ]);

        DB::table('tool_reviews')->insert([
            'tool_slug' => 'galculator',
            'user_id' => '11',
            'title' => 'Niet voor Windows',
            'rating' => '2',
            'description' => 'Dit kan ik niet eens gebruiken op Windows',
            'created_at' => now(),
        ]);

        DB::table('tool_reviews')->insert([
            'tool_slug' => 'galculator',
            'user_id' => '12',
            'title' => 'Outdated',
            'rating' => '1',
            'description' => 'Er zijn vele betere alternatieve én het is een oude tool.',
            'created_at' => now(),
        ]);

        DB::table('tool_reviews')->insert([
            'tool_slug' => 'galculator',
            'user_id' => '8',
            'title' => 'Haters gonna hate',
            'rating' => '5',
            'description' => 'Ja, ik gebruik deze rekenmachine. Het werkt super goed!',
            'created_at' => now(),
        ]);

        DB::table('tool_reviews')->insert([
            'tool_slug' => 'photoshop',
            'user_id' => '9',
            'title' => 'Erg duur',
            'rating' => '2',
            'description' => 'Het programma werkt goed, ik kan het mij alleen niet veroorloven.',
            'created_at' => now(),
        ]);

        DB::table('tool_reviews')->insert([
            'tool_slug' => 'photoshop',
            'user_id' => '10',
            'title' => 'Gebruik dit graag',
            'rating' => '5',
            'description' => '',
            'created_at' => now(),
        ]);

        DB::table('tool_reviews')->insert([
            'tool_slug' => 'photoshop',
            'user_id' => '11',
            'title' => 'Zou ik dit wel moeten aanschaffen?',
            'rating' => '4',
            'description' => 'Ik gebruikte Photoshop graag op stage, nu ik niet meer op stage zit moet ik overwegen dat dure pakket aan te schaffen... Wat zouden jullie doen?',
            'created_at' => now(),
        ]);

        DB::table('tool_reviews')->insert([
            'tool_slug' => 'photoshop',
            'user_id' => '12',
            'title' => 'Wow, das duur',
            'rating' => '3',
            'description' => 'Misschien kan ik Photoshop vragen voor Sinterklaas. Ik moet nog een verlanglijstje maken.',
            'created_at' => now(),
        ]);

        DB::table('tool_reviews')->insert([
            'tool_slug' => 'photoshop',
            'user_id' => '11',
            'title' => 'JA!!',
            'rating' => '5',
            'description' => 'De geile droom van elke designer :D',
            'created_at' => now(),
        ]);

        DB::table('tool_reviews')->insert([
            'tool_slug' => 'photoshop',
            'user_id' => '12',
            'title' => 'Veel mogelijk, graag in gebruik, maar toch is het echt een duur pakket',
            'rating' => '3',
            'description' => '',
            'created_at' => now(),
        ]);

        DB::table('tool_reviews')->insert([
            'tool_slug' => 'visualstudio',
            'user_id' => '8',
            'title' => 'Makkelijke software om software te maken',
            'rating' => '4',
            'description' => 'Crasht alleen vaak dus als ze dit oplossen wel 5 sterren',
            'created_at' => now(),
        ]);

        DB::table('tool_reviews')->insert([
            'tool_slug' => 'visualstudio',
            'user_id' => '9',
            'title' => 'Er is geen ander programma waarmee ik code schrijf',
            'rating' => '5',
            'description' => 'Er vallen veel positieve dingen te zeggen over Visual Studio',
            'created_at' => now(),
        ]);

        DB::table('tool_reviews')->insert([
            'tool_slug' => 'visualstudio',
            'user_id' => '10',
            'title' => 'Alternatieve?',
            'rating' => '3',
            'description' => 'Ik ben op zoek naar zo\'n tool, maar dan met betere GIT-features',
            'created_at' => now(),
        ]);

        DB::table('tool_reviews')->insert([
            'tool_slug' => 'visualstudio',
            'user_id' => '11',
            'title' => 'Crasht vaak',
            'rating' => '2',
            'description' => 'Crasht heel vaak. Pls fix.',
            'created_at' => now(),
        ]);

        DB::table('tool_reviews')->insert([
            'tool_slug' => 'visualstudio',
            'user_id' => '12',
            'title' => 'HAHA hoezo crashen?',
            'rating' => '5',
            'description' => 'Prima tool, doet alles ZONDER te crashen.',
            'created_at' => now(),
        ]);

        DB::table('tool_reviews')->insert([
            'tool_slug' => 'visualstudio',
            'user_id' => '11',
            'title' => '',
            'rating' => '3',
            'description' => '',
            'created_at' => now(),
        ]);

        DB::table('tool_reviews')->insert([
            'tool_slug' => 'onthehub',
            'user_id' => '12',
            'title' => 'Wie wil geen gratis software',
            'rating' => '4',
            'description' => 'Onmisbare software als student.',
            'created_at' => now(),
        ]);

        DB::table('tool_reviews')->insert([
            'tool_slug' => 'onthehub',
            'user_id' => '8',
            'title' => 'Ik kijk graag op deze website',
            'rating' => '4',
            'description' => 'Maar de downloader vind ik eigenlijk best irritant. Ik wil geen onnodige software installeren voor een beetje downloaden.',
            'created_at' => now(),
        ]);

        DB::table('tool_reviews')->insert([
            'tool_slug' => 'onthehub',
            'user_id' => '9',
            'title' => 'Gratis VMware downloaden op Avans account',
            'rating' => '5',
            'description' => 'Ik gebruik graag VMware, dus het is fijn dat OnTheHub mij die kans geeft om het nogmaals te gebruiken.',
            'created_at' => now(),
        ]);

        DB::table('tool_reviews')->insert([
            'tool_slug' => 'onthehub',
            'user_id' => '10',
            'title' => 'HOe wErrkT dItt?',
            'rating' => '3',
            'description' => 'wEet ieManD HOe diiT werkT?',
            'created_at' => now(),
        ]);

        DB::table('tool_reviews')->insert([
            'tool_slug' => 'onthehub',
            'user_id' => '11',
            'title' => 'Nope, nope, nope',
            'rating' => '1',
            'description' => 'Altijd als ik op deze website kom, dan geeft mijn adbocker aan dat er cookies verstuurd worden naar Microsoft.',
            'created_at' => now(),
        ]);

        DB::table('tool_reviews')->insert([
            'tool_slug' => 'onthehub',
            'user_id' => '12',
            'title' => 'Ik ben echt zó blij met deze site',
            'rating' => '5',
            'description' => 'Beste plek om tools te vinden',
            'created_at' => now(),
        ]);

        DB::table('tool_reviews')->insert([
            'tool_slug' => 'taiga',
            'user_id' => '11',
            'title' => 'Scrumboard slecht vindbaar',
            'rating' => '2',
            'description' => 'Kan bijna niks vinden op deze website, het scrumtaskboard zit onnodig ver weggestopt.',
            'created_at' => now(),
        ]);

        DB::table('tool_reviews')->insert([
            'tool_slug' => 'taiga',
            'user_id' => '12',
            'title' => 'Het was veel oefenen met Agile, maar nu vind ik het een fijne tool',
            'rating' => '4',
            'description' => 'Het duurde nml heel lang totdat ik wist hoe Taiga werkte.',
            'created_at' => now(),
        ]);

        DB::table('tool_reviews')->insert([
            'tool_slug' => 'taiga',
            'user_id' => '8',
            'title' => 'Kom mijn project joinen!',
            'rating' => '5',
            'description' => 'Ik zoek een programmeur die mee wil doen met mijn schoolproject. Bel 0900-AGILE!',
            'created_at' => now(),
        ]);

        DB::table('tool_reviews')->insert([
            'tool_slug' => 'taiga',
            'user_id' => '9',
            'title' => 'Hele verbetering vergeleken met stage',
            'rating' => '4',
            'description' => 'Toen maakte we nog gebruik van post-it notes op een bord.',
            'created_at' => now(),
        ]);

        DB::table('tool_reviews')->insert([
            'tool_slug' => 'taiga',
            'user_id' => '10',
            'title' => 'Stomme tool, geef me mijn wachtwoord!!',
            'rating' => '2',
            'description' => 'Ik weet mijn inloggegevens niet meer en Taiga wil deze niet doorgeven',
            'created_at' => now(),
        ]);

        DB::table('tool_reviews')->insert([
            'tool_slug' => 'taiga',
            'user_id' => '11',
            'title' => '',
            'rating' => '3',
            'description' => '',
            'created_at' => now(),
        ]);

        DB::table('tool_reviews')->insert([
            'tool_slug' => 'mysql-workbench',
            'user_id' => '12',
            'title' => 'Ik gebruik niets anders meer voor mijn database',
            'rating' => '5',
            'description' => 'Dit is de perfecte tool!',
            'created_at' => now(),
        ]);

        DB::table('tool_reviews')->insert([
            'tool_slug' => 'mysql-workbench',
            'user_id' => '11',
            'title' => 'Alternatief is beter',
            'rating' => '3',
            'description' => 'Ooit gehoord van phpmyadmin? Dat kan ik veel beter aanraden dan dit.',
            'created_at' => now(),
        ]);

        DB::table('tool_reviews')->insert([
            'tool_slug' => 'mysql-workbench',
            'user_id' => '12',
            'title' => 'Perfect in combinatie met de Avans server',
            'rating' => '5',
            'description' => '',
            'created_at' => now(),
        ]);

        DB::table('tool_reviews')->insert([
            'tool_slug' => 'mysql-workbench',
            'user_id' => '8',
            'title' => 'Voor school.',
            'rating' => '4',
            'description' => 'Krijgen we op onze database examen.',
            'created_at' => now(),
        ]);

        DB::table('tool_reviews')->insert([
            'tool_slug' => 'mysql-workbench',
            'user_id' => '9',
            'title' => 'Mist functies',
            'rating' => '3',
            'description' => 'Workbench werkt opzich wel, maar er zijn soms functies die missen.',
            'created_at' => now(),
        ]);

        DB::table('tool_reviews')->insert([
            'tool_slug' => 'mysql-workbench',
            'user_id' => '10',
            'title' => 'Geeft steeds een foutmelding bij opstarten',
            'rating' => '1',
            'description' => 'Er verschijnt steeds een foutmelding als ik WorkBench wil opstarten op Windows. Iemand een idee hoe ik dit op kan lossen?',
            'created_at' => now(),
        ]);

        DB::table('tool_reviews')->insert([
            'tool_slug' => 'discord',
            'user_id' => '11',
            'title' => 'Op alle platformen beschikbaar',
            'rating' => '5',
            'description' => '',
            'created_at' => now(),
        ]);

        DB::table('tool_reviews')->insert([
            'tool_slug' => 'discord',
            'user_id' => '12',
            'title' => 'Gebruik ik graag voor mijn projectbesprekingen, maar minder geschikt voor het houden van serieuze standups.',
            'rating' => '4',
            'description' => 'Maar misschien komt dat ook wel door mijn microfoon.',
            'created_at' => now(),
        ]);

        DB::table('tool_reviews')->insert([
            'tool_slug' => 'discord',
            'user_id' => '11',
            'title' => 'Gericht naar gamers',
            'rating' => '3',
            'description' => 'Leuk platform om op samen te werken, maar het lijkt wel alsof Discord alleen gericht is op gamers',
            'created_at' => now(),
        ]);

        DB::table('tool_reviews')->insert([
            'tool_slug' => 'discord',
            'user_id' => '12',
            'title' => '',
            'rating' => '1',
            'description' => 'Valt regelmatig uit op Linux.',
            'created_at' => now(),
        ]);

        DB::table('tool_reviews')->insert([
            'tool_slug' => 'discord',
            'user_id' => '8',
            'title' => 'Gotta love it',
            'rating' => '5',
            'description' => 'Discord? Hell yeah!',
            'created_at' => now(),
        ]);

        DB::table('tool_reviews')->insert([
            'tool_slug' => 'discord',
            'user_id' => '9',
            'title' => 'Rare vrienden',
            'rating' => '4',
            'description' => 'Ik krijg soms van die rare vriendenverzoeken. Maar verder werkt het fantastisch!',
            'created_at' => now(),
        ]);

        DB::table('tool_reviews')->insert([
            'tool_slug' => 'youtube',
            'user_id' => '10',
            'title' => 'Kan overal video\'s op kijken',
            'rating' => '5',
            'description' => 'Dit is mijn favoriete platform om video\'s op te kijken',
            'created_at' => now(),
        ]);

        DB::table('tool_reviews')->insert([
            'tool_slug' => 'youtube',
            'user_id' => '11',
            'title' => 'Soms best nutteloos',
            'rating' => '2',
            'description' => 'Het houd me vaak van mijn schoolwerk af',
            'created_at' => now(),
        ]);

        DB::table('tool_reviews')->insert([
            'tool_slug' => 'youtube',
            'user_id' => '12',
            'title' => 'Goed tot de update',
            'rating' => '4',
            'description' => 'De nieuwe versie vind ik niet zo prettig werken.',
            'created_at' => now(),
        ]);

        DB::table('tool_reviews')->insert([
            'tool_slug' => 'youtube',
            'user_id' => '11',
            'title' => '',
            'rating' => '1',
            'description' => '',
            'created_at' => now(),
        ]);

        DB::table('tool_reviews')->insert([
            'tool_slug' => 'youtube',
            'user_id' => '12',
            'title' => 'Kent iemand een goede video converter hiervoor?',
            'rating' => '4',
            'description' => 'Asking for a friend',
            'created_at' => now(),
        ]);

        DB::table('tool_reviews')->insert([
            'tool_slug' => 'youtube',
            'user_id' => '8',
            'title' => 'Tutorials',
            'rating' => '5',
            'description' => 'Er staan veel goede tutorials op over Laravel enz.',
            'created_at' => now(),
        ]);

        DB::table('tool_reviews')->insert([
            'tool_slug' => 'webdictaat',
            'user_id' => '8',
            'title' => 'Leert super fijn!',
            'rating' => '5',
            'description' => 'Een super fijne manier om te leren!',
            'created_at' => now(),
        ]);
    }
}
