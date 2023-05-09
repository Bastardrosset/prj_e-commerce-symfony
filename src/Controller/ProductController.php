<?php

namespace App\Controller;

use App\Classe\FilterSearch;
use App\Entity\Product;
use App\Form\FilterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{

    #[Route('/our-products', name: 'products')]
    public function index(EntityManagerInterface $entityManager, Request $request): Response
    {
        $products= $entityManager->getRepository(Product::class)->findAll();
        // $products = $repository->findAll();
        
        $search = new FilterSearch;

        $form = $this->createForm(FilterType::class, $search);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $products = $entityManager->getRepository(Product::class)->findWithSearch($search);
            // $product = $repo->findWithSearch($search);
            // dd($search);
        }

        return $this->render('product/index.html.twig', [
            'products' => $products,
            'form' => $form->createView()
        ]);
    }

    #[Route('/product/{slug}', name: 'product')]
    public function showProduct($slug, EntityManagerInterface $entityManager): Response
    {

        $repository = $entityManager->getRepository(Product::class);
        $product = $repository->findOneBySlug($slug);
        
        if(!$product){
            return $this->redirectToRoute('products');
        }


        return $this->render('product/showProduct.html.twig', [
            'product' => $product
        ]);
    }
}
