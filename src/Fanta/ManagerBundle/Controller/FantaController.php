<?php

namespace Fanta\ManagerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class FantaController extends Controller
{
    /**
     * @Route("/")
     * @Template()
     */
    public function indexAction()
    {
        $repository = $this->getDoctrine()->getRepository('FantaManagerBundle:FantaTeam');
        
        $fantaTeams = $repository->findAll();
        
        $roundRepository = $this->getDoctrine()->getRepository('FantaManagerBundle:Round');

        $query = $roundRepository->createQueryBuilder('r')
            ->where('r.is_played = 1')
            ->addOrderBy('r.datetime', 'ASC')
            ->getQuery();
        
        $rounds = $query->getResult();
        
        return $this->render('FantaManagerBundle:Fanta:index.html.twig', array('fantaTeams' => $fantaTeams, 'rounds' => $rounds));
    }
    
    /**
     * @Route("/fantaTeam/{id}")
     * @Template()
     */
    public function fantaTeamAction($id)
    {
        $repository = $this->getDoctrine()->getRepository('FantaManagerBundle:FantaTeam');
        
        $fantaTeam = $repository->findOneById($id);
        
        $fantaTeamPlayers = $fantaTeam->getPlayers();
        
        return $this->render('FantaManagerBundle:Fanta:fantaTeam.html.twig', array('fantaTeam' => $fantaTeam, 'fantaTeamPlayers' => $fantaTeamPlayers));
    }
    
    /**
     * @Route("/round/{id}")
     * @Template()
     */
    public function roundAction($id)
    {   
        $repository = $this->getDoctrine()->getRepository('FantaManagerBundle:FantaTeam');
        
        $fantaTeams = $repository->findAll();
        
        $roundRepository = $this->getDoctrine()->getRepository('FantaManagerBundle:Round');

        $query = $roundRepository->createQueryBuilder('r')
            ->where('r.is_played = 1')
            ->andWhere('r.id = :round')
            ->setParameter('round', $id)
            ->addOrderBy('r.datetime', 'DESC')
            ->setMaxResults(1)
            ->getQuery();
        
        $round = $query->getSingleResult();
        
        $repository = $this->getDoctrine()->getRepository('FantaManagerBundle:FantaLineUp');

        $query = $repository->createQueryBuilder('u')
            ->select('u, p, f, v')
            ->leftJoin('u.player', 'p')
            ->leftJoin('p.votes', 'v', 'WITH', 'v.round = :round')
            ->leftJoin('p.fantaTeam', 'f')
            ->andWhere('u.round = :round')
            ->setParameter('round', $round->getId())
            ->orderBy('f.id', 'ASC')
            ->addOrderBy('u.is_substitute', 'ASC')
            ->addOrderBy('p.role', 'DESC')
            ->addOrderBy('u.substitute_priority', 'ASC')
            ->getQuery();

        $fantaLineUps = $query->getResult();
        
        return $this->render('FantaManagerBundle:Fanta:round.html.twig', array('fantaTeams' => $fantaTeams, 'round' => $round));
    }
    
    public function lineUpAction($id, $round)
    {
        $repository = $this->getDoctrine()->getRepository('FantaManagerBundle:FantaLineUp');

        $query = $repository->createQueryBuilder('u')
            ->select('u, p')
            ->leftJoin('u.player', 'p')
            ->where('u.fanta_team = :id')
            ->andWhere('u.round = :round')
            ->setParameter('id', $id)
            ->setParameter('round', $round)
            ->orderBy('u.is_substitute', 'ASC')
            ->addOrderBy('p.role', 'DESC')
            ->addOrderBy('u.substitute_priority', 'ASC')
            ->getQuery();

        $fantaLineUp = $query->getResult();
        
        return $this->render('FantaManagerBundle:Fanta:lineUp.html.twig', array('fantaLineUp' => $fantaLineUp));
    }
    
    public function lineUpVotesAction($id, $round)
    {
        $repository = $this->getDoctrine()->getRepository('FantaManagerBundle:FantaLineUp');

        $query = $repository->createQueryBuilder('u')
            ->select('p.role, COUNT(p.role) AS rolecount')
            ->leftJoin('u.player', 'p')
            ->where('u.fanta_team = :id')
            ->andWhere('u.round = :round')
            ->andWhere('u.is_substitute = 0')
            ->setParameter('id', $id)
            ->setParameter('round', $round)
            ->addOrderBy('p.role', 'DESC')
            ->addGroupBy('p.role')
            ->getQuery();
        
        $lineUpSchema = $query->getResult();
        
        foreach ($lineUpSchema as $zone) {
            $query = $repository->createQueryBuilder('u')
                ->select('u, p, v')
                ->leftJoin('u.player', 'p')
                ->leftJoin('p.votes', 'v', 'WITH', 'v.round = :round')
                ->where('u.fanta_team = :id')
                ->andWhere('u.round = :round')
                ->andWhere('p.role = :role')
                ->andWhere('v.fantavote IS NOT NULL')
                ->setParameter('id', $id)
                ->setParameter('round', $round)
                ->setParameter('role', $zone['role'])
                ->addOrderBy('u.is_substitute', 'ASC')
                ->addOrderBy('u.substitute_priority', 'ASC')
                ->setMaxResults($zone['rolecount'])
                ->getQuery();
            
            $name = 'fantaLineUp'.$zone['role'];
            
            $$name = $query->getResult();
        }
        
        return $this->render('FantaManagerBundle:Fanta:lineUpVotes.html.twig', array('fantaLineUpP' => $fantaLineUpP, 
                                                                                     'fantaLineUpD' => $fantaLineUpD,
                                                                                     'fantaLineUpC' => $fantaLineUpC,
                                                                                     'fantaLineUpA' => $fantaLineUpA));
    }
    
    public function lineUpBestVotesAction($id, $round)
    {
        $repository = $this->getDoctrine()->getRepository('FantaManagerBundle:FantaLineUp');

        $query = $repository->createQueryBuilder('u')
            ->select('p.role, COUNT(p.role) AS rolecount')
            ->leftJoin('u.player', 'p')
            ->where('u.fanta_team = :id')
            ->andWhere('u.round = :round')
            ->andWhere('u.is_substitute = 0')
            ->setParameter('id', $id)
            ->setParameter('round', $round)
            ->addOrderBy('p.role', 'DESC')
            ->addGroupBy('p.role')
            ->getQuery();
        
        $lineUpSchema = $query->getResult();
        
        $repository = $this->getDoctrine()->getRepository('FantaManagerBundle:Player');
        
        foreach ($lineUpSchema as $zone) {
            $query = $repository->createQueryBuilder('p')
                ->select('p, v')
                ->leftJoin('p.fantaTeam', 'f')
                ->leftJoin('p.votes', 'v', 'WITH', 'v.round = :round')
                ->where('f.id = :id')
                ->andWhere('p.role = :role')
                ->andWhere('v.fantavote IS NOT NULL')
                ->setParameter('id', $id)
                ->setParameter('round', $round)
                ->setParameter('role', $zone['role'])
                ->addOrderBy('v.fantavote', 'DESC')
                ->setMaxResults($zone['rolecount'])
                ->getQuery();
            
            $name = 'fantaBestLineUp'.$zone['role'];
            
            $$name = $query->getResult();
        }
        
        return $this->render('FantaManagerBundle:Fanta:lineUpBestVotes.html.twig', array('fantaBestLineUpP' => $fantaBestLineUpP, 
                                                                                         'fantaBestLineUpD' => $fantaBestLineUpD,
                                                                                         'fantaBestLineUpC' => $fantaBestLineUpC,
                                                                                         'fantaBestLineUpA' => $fantaBestLineUpA));
    }
    
    public function lineUpSchemaAction($id, $round)
    {
        $repository = $this->getDoctrine()->getRepository('FantaManagerBundle:FantaLineUp');

        $query = $repository->createQueryBuilder('u')
            ->select('p.role, COUNT(p.role) AS rolecount')
            ->leftJoin('u.player', 'p')
            ->where('u.fanta_team = :id')
            ->andWhere('u.round = :round')
            ->andWhere('u.is_substitute = 0')
            ->andWhere('p.role != :role')
            ->setParameter('id', $id)
            ->setParameter('round', $round)
            ->setParameter('role', 'P')
            ->addOrderBy('p.role', 'DESC')
            ->addGroupBy('p.role')
            ->getQuery();
        
        $lineUpSchema = $query->getResult();
        
        return $this->render('FantaManagerBundle:Fanta:lineUpSchema.html.twig', array('lineUpSchema' => $lineUpSchema));
    }
}
