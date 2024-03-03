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
use BotMan\BotMan\Messages\Conversations\Conversation;


$config = [
    'facebook' => [
        'token' => EAADwdLUwOaoBO6efQZByvpF2SBw6DKgUHXogmx87iZBhLNDvHGZBkOkl3r2MzEZBWWeZAqXG01WWXbpHjUveMpGjD1BrZB8rY5ZAGpmDVrZBTbLv1wQCvoCW46zZBg7e6bivXpItETRTZBIAJxbD8NaT3ohNN9soZC2af7nDNE2PoY0AKtKbkwwRy1qJ5wsR8SEuab0,
      'app_secret' => '',
      'verification'=>'ilabgraceclinic',
  ]
];

DriverManager::loadDriver(\BotMan\Drivers\Web\WebDriver::class);

DriverManager::loadDriver(\BotMan\Drivers\Facebook\FacebookDriver::class);
// Create BotMan instance
BotManFactory::create($config);


class BotManController extends Controller
{
    public function handle()
    {
        $botman = app('botman');

        // Listen for greetings
        $botman->hears('.*(hi|hello).*', function (BotMan $bot) {
            $bot->startConversation(new NameConversation());
        });

        $botman->listen();
    }
}


class NameConversation extends Conversation
{
    public function askForName()
    {
        $this->ask("Hi there! What's your name?", function (Answer $answer) {
            $name = $answer->getText();

            // Respond with a personalized message
            $this->say("Nice to meet you, $name! How can I assist you today?");
            
            // Show the menu options
            $this->showMenu();
        });
    }

    public function showMenu()
    {
        $question = Question::create('Please select an option:')
            ->addButtons([
                Button::create('Clinic Location')->value('clinic_location'),
                Button::create('Services Offer')->value('services_offer'),
            ]);

        $this->ask($question, function (Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {
                switch ($answer->getValue()) {
                    case 'clinic_location':
                        $this->showClinicLocation();
                        break;
                    case 'services_offer':
                        $this->showServicesOffer();
                        break;
                    default:
                        $this->say('Invalid option selected. Please choose again.');
                        $this->showMenu();
                        break;
                }
            }
        });
    }

    public function showClinicLocation()
    {
        $this->say('Clinic located at Ibaba East Calapan City.');
        // Show menu again
        $this->showMenu();
    }

    public function showServicesOffer()
    {
        $this->say('Services Offered: Urinalysis, CBC');
        // Show menu again
        $this->showMenu();
    }

    public function run()
    {
        // Start the conversation
        $this->askForName();
    }
}