<?php

namespace App\Controller;

use App\Classe\Search;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductController extends AbstractController
{
    /**
     * @Route("/nos-produits", name="products")
     */
    public function index(EntityManagerInterface $manager,ProductRepository $repo): Response
    {
        $products = $repo->findAll();
        //dd($products);
        $search = new Search();
        $form = $this->createForm(SearchType::class, $search);

        return $this->render('product/index.html.twig',[
            'products'=>$products,
            'form'=>$form->createView()
        ]);
    }

    
    /**
     * @Route("/produit/{slug}", name="product")
     */
    public function show($slug,ProductRepository $repo): Response
    {
        $product = $repo->findOneBySlug($slug);
        //dd($products);
        if(!$product){ // raha ts misy ny $product, zany oe 'slug' ts misy no nosoratany
            return $this->redirectToRoute('products');
        }
        return $this->render('product/show.html.twig',[
            'product'=>$product
        ]);
    }
}
