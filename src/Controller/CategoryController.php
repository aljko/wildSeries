<?php

    // src/Controller/CategoryController.php

    namespace App\Controller;

    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;
    use App\Entity\Category;
    use App\Entity\Program;

    /**
    * @Route("/category", name="category_")
    */
    class CategoryController extends AbstractController{
         /**
         * Show all rows from Program’s entity
         *
         * @Route("/", name="index")
         * @return Response A response instance
         */
        public function index(): Response{
            $categorys = $this->getDoctrine()
                ->getRepository(Category::class)
                ->findAll();

            return $this->render(
                'category/index.html.twig',
                ['categorys' => $categorys]
            );
        }
     
     /**
     * @route("/show/{categoryName}", methods={"GET"}, name="show")
     * @param string $categoryName
     * @return Response
     */
    public function show(string $categoryName): Response
    {
        $category = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findOneBy(['name' => ucwords($categoryName)]);

        if(!$category) {
            throw $this->createNotFoundException('No category : '.$category.' found in category table'
            );
        }
        $programs = $this->getDoctrine()
            ->getRepository(Program::class)
            ->findBy(
                ['category' => $category],
                ['id' => 'DESC'],
                3
            );
        if (!$programs){
            throw $this->createNotFoundException(
                'Aucune série trouvée dans la categorie ' .$category
            );
        }

        return $this->render('category/show.html.twig', [
            'category' => $category,
            'programs' => $programs,
        ]);
    }

    }
