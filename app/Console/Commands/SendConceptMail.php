<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Http\Controllers\MailController;
use App\Mail\ConceptTools;
use App\Tool;
use App\User;

class SendConceptMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'conceptmail:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send concept mail';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $tools = Tool::conceptTools()->get();
        $users = User::admins()->get();

        MailController::sendMailable(new ConceptTools($tools), $users);
    }
}
