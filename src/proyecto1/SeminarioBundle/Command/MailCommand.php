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

        $contenedor = $this->getContainer();
        $em = $contenedor->get('doctrine')->getManager();
        $eventos_semana = $em->getRepository('SeminarioBundle:Seminario')->findEventosSemana();
        $cad='';
        foreach ($eventos_semana as $evento_semana) {
            $fecha = $evento_semana->getFecha();
            $hora = $evento_semana->getHora();

            $fechahora = new \DateTime($fecha->format('Y-m-d') . ' ' . $hora->format('H:i:s'));

            $nombre = $evento_semana->getSeminario()->getResponsables();
            $res= $nombre[0];
            $descripcion = $evento_semana->getPlatica();
            $comentario = $evento_semana->getResumen();
            $localizacion = $evento_semana->getOrigen();
            $organizador = $evento_semana->getOrigen();
            $cad = $res . "\n" . $comentario."\n".$cad."\n";
        }

        $mailer = $this->getContainer()->get('mailer');
        $mensaje = $mailer->createMessage()
            ->setSubject('Seminarios de la semana - Centro de Ciencias Matemáticas UNAM')
            ->setFrom('webmaster@matmor.unam.mx')
            ->setTo('rudos@matmor.unam.mx')
            ->setBody($cad)

        ;
        $resul=$mailer->send($mensaje);
        $output->writeln($cad);



    }
}

