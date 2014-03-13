<?php

namespace yt\ytBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
//use Symfony\Component\HttpFoundation\Session;


class DemoController extends Controller
{
	public function indexAction($page)
	{

		$articleList = array(	array('id' => 2, 'titre' => 'Mon dernier weekend !'),
								array('id' => 5, 'titre' => 'Sortie de Symfony2.1'),
								array('id' => 9, 'titre' => 'Petit test'));
							
					      
		return $this->render('ytTestBundle:Demo:index.html.twig', array('articles' => $articleList));

		if( $page < 1 )
		{
			throw $this->createNotFoundException('Page inexistante (page = '.$page.')');
		}
		return $this->render('ytTestBundle:Demo:index.html.twig');
	}


	public function voirAction($id)
	{
		return $this->render('ytTestBundle:Demo:voir.html.twig', array('id' => $id));
	}

	public function ajouterAction()
	{
		// La gestion d'un formulaire est particulière, mais l'idée est la suivante :
		if( $this->get('request')->getMethod() == 'POST' )
		{
			// Ici, on s'occupera de la création et de la gestion du formulaire
			//$this->get('session')->getFlashBag()->add('notice', 'Article bien enregistré');
			// Puis on redirige vers la page de visualisation de cet article
			return $this->redirect( $this->generateUrl('ytdemo_voir', array('id' => 5)) );
		}

		// Si on n'est pas en POST, alors on affiche le formulaire
		return $this->render('ytTestBundle:Demo:ajouter.html.twig');
	}

	public function modifierAction($id)
	{
		return $this->render('ytTestBundle:Demo:supprimer.html.twig');
	}
	public function supprimerAction($id)
	{
		return $this->render('ytTestBundle:Demo:supprimer.html.twig');
	}

	public function menuAction($nombre) // Ici, nouvel argument $nombre, on l'a transmis via le render() depuis la vue
	{
		// On fixe en dur une liste ici, bien entendu par la suite on la récupérera depuis la BDD !
		// On pourra récupérer $nombre articles depuis la BDD,
		// avec $nombre un paramètre qu'on peut changer lorsqu'on appelle cette action
		$liste = array(
			array('id' => 2, 'titre' => 'Mon dernier weekend !'),
			array('id' => 5, 'titre' => 'Sortie de Symfony2.1'),
			array('id' => 9, 'titre' => 'Petit test')
		);
    
		return $this->render('ytTestBundle:Demo:menu.html.twig', array(
			'liste_articles' => $liste // C'est ici tout l'intérêt : le contrôleur passe les variables nécessaires au template !
		));
	}

	// On récupère tous les paramètres en arguments de la méthode
	public function voirSlugAction($slug, $annee, $format)
	{
		// 	var_dump($this->getRequest());
		// Ici le contenu de la méthode
		return new Response("On pourrait afficher l'article correspondant au slug '".$slug."', créé en ".$annee." et au format ".$format.".");
	}
}
