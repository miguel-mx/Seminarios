<?php
namespace proyecto1\SeminarioBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class MailCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName('email:events')
            ->setDescription('Envia eventos a emails de usuarios ');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        setlocale(LC_ALL, 'es_MX');

        $contenedor = $this->getContainer();
        $em = $contenedor->get('doctrine')->getManager();
        $eventos_semana = $em->getRepository('SeminarioBundle:Seminario')->findEventosSemanaSig();

        // Si no hay eventos termina
        if(count($eventos_semana) == 0) {
            $output->writeln("No hay eventos \n");
            return;
        }

        $cad="-⁠-⁠-⁠-⁠-⁠-⁠-⁠-⁠-⁠-⁠-⁠-⁠-⁠-⁠-⁠-⁠-⁠-⁠-⁠-⁠-⁠-⁠-⁠-⁠-⁠-⁠-⁠-⁠-⁠-⁠-⁠-⁠-⁠-⁠-⁠-⁠-⁠-⁠-⁠-⁠CENTRO DE CIENCIAS MATEMATICAS\n\n";

        foreach ($eventos_semana as $evento_semana) {

            $nombre = $evento_semana->getSeminario()->getNombre() . "\n";
            $responsables = "Responsables: " . $evento_semana->getResponsables() . "\n\n";

            $platica = "\t" . $evento_semana->getPlatica() . "\n";
            $ponente = "\t" . $evento_semana->getPonente() . " - " . $evento_semana->getOrigen() . "\n";

            $fecha = $evento_semana->getFecha();
            $hora = $evento_semana->getHora();
            $fechahora = new \DateTime($fecha->format('d-m-Y') . ' ' . $hora->format('H:i'));
            $lugar = "\t" . $evento_semana->getLugar() . "\n\n";

            $resumen =  wordwrap($evento_semana->getResumen(), 70, "\n");

            $cad .= $nombre . $responsables . $platica. $ponente . "\t" . strftime("%A %d - %H:%M hrs.", $fechahora->getTimestamp()) . "\n"  . $lugar . $resumen . "\n\n";
        }

        $mailer = $this->getContainer()->get('mailer');
        $mensaje = $mailer->createMessage()
            ->setSubject('Seminarios de la semana - Centro de Ciencias Matemáticas UNAM')
            ->setFrom('webmaster@matmor.unam.mx')
            ->setTo('miguel@matmor.unam.mx')
            ->setBody($cad)

        ;
        $resul=$mailer->send($mensaje);

        $output->writeln($cad);



    }
}

