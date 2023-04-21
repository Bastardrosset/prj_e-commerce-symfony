<?php

namespace App\Controller;

use App\Entity\Product;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{

    #[Route('/our-products', name: 'products')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $repository = $entityManager->getRepository(Product::class);
        $products = $repository->findAll();
        
        // dd($products);


        return $this->render('product/index.html.twig', [
            'products' => $products
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
