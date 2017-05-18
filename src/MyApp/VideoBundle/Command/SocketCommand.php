<?php
// myApp/pidBundle/Command/SocketCommand.php
// Change the namespace according to your bundle
namespace MyApp\VideoBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

// Include ratchet libs

use Ratchet\App;
// Chat instance


// Change the namespace according to your bundle
use MyApp\VideoBundle\Sockets\Chat;

class SocketCommand extends Command
{
    protected function configure()
    {
        $this->setName('sockets:start-chat')
            // the short description shown while running "php bin/console list"
            ->setHelp("Starts the chat socket demo")
            // the full command description shown when running the command with
            ->setDescription('Starts the chat socket demo')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln([
            'Chat socket',// A line
            '============',// Another line
            'Starting chat, open your browser.',// Empty line
        ]);

        $app = new App('localhost', 8080,'127.0.0.1');
        // Add route to chat with the handler as second parameter
        $app->route('/chat', new Chat);

        // To add another routes, then you can use :
        //$app->route('/america-chat', new AmericaChat);
        //$app->route('/europe-chat', new EuropeChat);
        //$app->route('/africa-chat', new AfricaChat);
        //$app->route('/asian-chat', new AsianChat);

        // Run !
        $app->run();
    }
}