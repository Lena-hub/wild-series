<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Program;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/category", name="category_")
 */


class CategoryController extends AbstractController
{
    /**
     * Undocumented function
     *
     * @return Response
     *
     * @Route("/", name="index")
     */
    public function index(): Response

    {
        $categories = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findAll();

        return $this->render('category/index.html.twig', ['categories' => $categories]);
    }


    /**
     * @Route("/{categoryName}",  methods = {"GET"}, requirements = {"categoryName" = "[^/]+"}, name = "show")
     */
    public function show(string $categoryName): Response
    {

        $category = $this->getDoctrine()
        ->getRepository(Category::class)
            ->findOneBy(['name' => $categoryName]);

        if (empty($category)) {
            throw $this->createNotFoundException(
                "La catégorie   $categoryName  néxiste pas");
            }

        $program = $this->getDoctrine()
        ->getRepository(Program::class)
        ->findBy(['category' => $category->getId()]);


        return $this->render('category/show.html.twig', ['categoryName' => $categoryName, 'program' => $program]);
    }
}