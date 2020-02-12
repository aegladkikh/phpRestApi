<?php

namespace App\Command;

use App\Entity\Currency;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class UpdateCurrencyCommand extends Command
{
    protected static $defaultName = 'currency:update';
    protected string $url = 'http://cbr.ru/scripts/XML_daily.asp';
    private ManagerRegistry $manager;

    public function __construct(ManagerRegistry $manager)
    {
        parent::__construct();
        $this->manager = $manager;
    }

    protected function configure()
    {
        $this
            ->setName('currency:update')
            ->setDescription('Обновление курса валют.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // outputs multiple lines to the console (adding "\n" at the end of each line)
        $output->writeln(
            [
                'Обновляем курс валют',
                '============',
            ]
        );

        $data = simplexml_load_file($this->url);

        if (!$data) {
            $output->write('Ошибка при обновление цен.');

            return 0;
        }

        foreach ($data->children() as $row) {
            $name = (string)$row->Name->__toString();
            $value = (string)$row->Value->__toString();

            $findByName = $this->manager
                ->getManager()
                ->getRepository(Currency::class)
                ->findOneBy(['name' => $name]);

            if ($findByName) {
                $findByName->setRate($value);
            } else {
                $Currency = new Currency();
                $Currency->setName($name);
                $Currency->setRate($value);

                $this->manager->getManager()->persist($Currency);
            }
        }

        $this->manager->getManager()->flush();

        $output->write('Успешно обновил.');

        return 0;
    }
}
