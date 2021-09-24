<?php

    // src/Controller/ProgramController.php

    namespace App\Controller;

    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;

    Class ProgramController extends AbstractController
    {
        /**

        * @Route("/program/{id}", requirements={"page"="\d+"}, methods={"GET"}, name="program_index")

        */

        // Route seulement si methode GET

        public function show(int $id=1): Response
        // Si le parametre d'id n'est pas renseigné, il sera à 1 par défaut
        {
            return $this->render('program/index.html.twig', [
            'website' => 'Wild Séries', 'id' => $id
            ]);
            // Envoie du parametre id d'url dans le render de twig
        }
    }