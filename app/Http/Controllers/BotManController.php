<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use BotMan\BotMan\BotMan;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Drivers\DriverManager;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;


$config = [
//     'facebook' => [
//         'token' => 'YOUR-FACEBOOK-PAGE-TOKEN-HERE',
//       'app_secret' => 'YOUR-FACEBOOK-APP-SECRET-HERE',
//       'verification'=>'MY_SECRET_VERIFICATION_TOKEN',
//   ]
];



DriverManager::loadDriver(\BotMan\Drivers\Web\WebDriver::class);

// Create BotMan instance
BotManFactory::create($config);


class BotManController extends Controller
{
    public function handle()
    {
    
 
        $botman = app('botman');

        // Listen for greetings
        $botman->hears('.*(hi|hello).*', function (BotMan $bot) {
            $this->askForName($bot);
        });

        $botman->listen();
    }

    /**
     * Ask for the user's name after greeting.
     */
    public function askForName(BotMan $bot)
    {
        $bot->ask("Hi there! What's your name?", function (Answer $answer) use ($bot) {
            $name = $answer->getText();

            // Respond with a personalized message
            $bot->reply("Nice to meet you, $name! How can I assist you today?");
            
            // Show the menu options
            $this->showMenu($bot);
        });
    }

    /**
     * Show menu options.
     */
    public function showMenu(BotMan $bot)
    {
        $question = Question::create('Please select an option:')
            ->addButtons([
                Button::create('Clinic Location')->value('clinic_location'),
                Button::create('Services Offer')->value('services_offer'),
            ]);

        $bot->ask($question, function (Answer $answer) use ($bot) {
            if ($answer->isInteractiveMessageReply()) {
                switch ($answer->getValue()) {
                    case 'clinic_location':
                        $this->showClinicLocation($bot);
                        break;
                    case 'services_offer':
                        $this->showServicesOffer($bot);
                        break;
                    default:
                        $bot->reply('Invalid option selected. Please choose again.');
                        $this->showMenu($bot);
                        break;
                }
            }
        });
    }

    /**
     * Show clinic location.
     */
    public function showClinicLocation(BotMan $bot)
    {
        $bot->reply('Clinic located at Ibaba East Calapan City.');
        // Show menu again
        $this->showMenu($bot);
    }

    /**
     * Show services offered.
     */
    public function showServicesOffer(BotMan $bot)
    {
        $bot->reply('Services Offered: Urinalysis, CBC');
        // Show menu again
        $this->showMenu($bot);
    }
   
}
