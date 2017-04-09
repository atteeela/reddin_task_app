<?php

namespace AppBundle\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;

class LoadUsersCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            // the name of the command (the part after "bin/console")
            ->setName('app:load-users')
            // the short description shown while running "php bin/console list"
            ->setDescription('Loads users from CSV file')
            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp('This command allows you to load users from CSV file.')
            // configure an argument
            ->addArgument('csv_file', InputArgument::REQUIRED, 'CSV file to load users from');
    }

    /**
     * Load a single user into the database.
     * It will not overwrite the users existing password (if user exists)
     *
     * Sets password for a new user their first name
     *
     * @param $firstName Users first name
     * @param $lastName Users last name
     * @param $email Users email
     */
    private function createOrUpdateUser($firstName, $lastName, $email)
    {
        // Emails are always dealt with in lower case
        $email = strtolower($email);

        $doctrine = $this->getContainer()->get('doctrine');

        /** @var User $user */
        $user = $doctrine
            ->getRepository('AppBundle:User')
            ->findOneByEmail($email);

        if (empty($user)) {

            $user = new User();
            $user->setFirstName($firstName);
            $user->setLastName($lastName);
            $user->setEmail($email);
            $user->setIsActive(true);
            $user->setPassword($firstName);
        } else {
            $user->setFirstName($firstName);
            $user->setLastName($lastName);
        }

        $em = $doctrine->getManager();
        $em->persist($user);
        $em->flush();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // outputs multiple lines to the console (adding "\n" at the end of each line)
        $output->writeln([
            'User Loader',
            '============',
            '',
        ]);

        $csvFilePath = $input->getArgument('csv_file');

        if (($handle = fopen($csvFilePath, "r")) !== FALSE) {
            $skipHeaderRow = true;
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                if ($skipHeaderRow) {
                    $skipHeaderRow = false;
                    continue;
                }

                $firstName = $data[0];
                $lastName = $data[1];
                $email = $data[2];

                $output->writeln("Processing user entry. first_name={$firstName}, last_name={$lastName}, email={$email}");
                $this->createOrUpdateUser($firstName, $lastName, $email);
            }
            fclose($handle);
        }

        $output->writeln('Done loading users');
    }
}