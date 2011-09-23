<?php

namespace Fanta\ManagerBundle\Controller;

use Symfony\Component\Security\Acl\Domain\ObjectIdentity;
use Symfony\Component\Security\Acl\Domain\UserSecurityIdentity;
use Symfony\Component\Security\Acl\Permission\MaskBuilder;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Fanta\ManagerBundle\Entity\FantaLineUp;
use Fanta\ManagerBundle\Entity\Round;
use Fanta\ManagerBundle\Form\FantaLineUpType;

/**
 * FantaLineUp controller.
 *
 * @Route("/fantalineup")
 */
class FantaLineUpController extends Controller
{
    /**
     * Lists all FantaLineUp entities.
     *
     * @Route("/", name="fantalineup")
     * @Template()
     */
    public function indexAction()
    {
        $user = $this->get('security.context')->getToken()->getUser();
        
        $roundRepository = $this->getDoctrine()->getRepository('FantaManagerBundle:Round');

        $query = $roundRepository->createQueryBuilder('r')
            ->where('r.is_played = 0')
            ->addOrderBy('r.datetime', 'ASC')
            ->setMaxResults(1)
            ->getQuery();
        
        $round = $query->getSingleResult();
        
        $repository = $this->getDoctrine()->getRepository('FantaManagerBundle:FantaLineUp');

        $query = $repository->createQueryBuilder('u')
            ->leftJoin('u.player', 'p')
            ->where('u.fanta_team = :id')
            ->andWhere('u.round = :round')
            ->setParameter('id', $user->getFantaTeam()->getId())
            ->setParameter('round', $round->getId())
            ->orderBy('u.is_substitute', 'ASC')
            ->addOrderBy('p.role', 'DESC')
            ->addOrderBy('u.substitute_priority', 'ASC')
            ->getQuery();

        $entities = $query->getResult();

        $entity = new FantaLineUp();
        $form   = $this->createForm(new FantaLineUpType($user), $entity);
        
        return array('entities' => $entities, 
                     'user'     => $user, 
                     'entity'   => $entity,
                     'form'     => $form->createView(),);
    }

    /**
     * Displays a form to create a new FantaLineUp entity.
     *
     * @Route("/new", name="fantalineup_new")
     * @Template()
     */
    public function newAction()
    {
        $user = $this->get('security.context')->getToken()->getUser();
        
        $entity = new FantaLineUp();
        
        $form   = $this->createForm(new FantaLineUpType($user), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'user'   => $user,
        );
    }

    /**
     * Creates a new FantaLineUp entity.
     *
     * @Route("/create", name="fantalineup_create")
     * @Method("post")
     * @Template("FantaManagerBundle:FantaLineUp:new.html.twig")
     */
    public function createAction()
    {
        $user = $this->get('security.context')->getToken()->getUser();
        
        $roundRepository = $this->getDoctrine()->getRepository('FantaManagerBundle:Round');

        $query = $roundRepository->createQueryBuilder('r')
            ->where('r.is_played = 0')
            ->addOrderBy('r.datetime', 'ASC')
            ->setMaxResults(1)
            ->getQuery();
        
        $round = $query->getSingleResult();
        
        $entity  = new FantaLineUp();
        $request = $this->getRequest();
        $form    = $this->createForm(new FantaLineUpType($user), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            
            $entity->setType(1);
            $entity->setFantaTeam($user->getFantaTeam());
            $entity->setRound($round);
            
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();
            
            // creating the ACL
            $aclProvider = $this->get('security.acl.provider');
            $objectIdentity = ObjectIdentity::fromDomainObject($entity);
            $acl = $aclProvider->createAcl($objectIdentity);

            // retrieving the security identity of the currently logged-in user
            $securityContext = $this->get('security.context');
            $user = $securityContext->getToken()->getUser();
            $securityIdentity = UserSecurityIdentity::fromAccount($user);

            // grant owner access
            $acl->insertObjectAce($securityIdentity, MaskBuilder::MASK_OWNER);
            $aclProvider->updateAcl($acl);

            return $this->redirect($this->generateUrl('fantalineup'));
            
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing FantaLineUp entity.
     *
     * @Route("/{id}/edit", name="fantalineup_edit")
     * @Template()
     */
    public function editAction($id)
    {   
        $user = $this->get('security.context')->getToken()->getUser();
        
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('FantaManagerBundle:FantaLineUp')->find($id);

        $securityContext = $this->get('security.context');

        // check for edit access
        if (false === $securityContext->isGranted('EDIT', $entity))
        {
            throw new AccessDeniedException();
        }
        
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find FantaLineUp entity.');
        }
        
        

        $editForm = $this->createForm(new FantaLineUpType($user), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing FantaLineUp entity.
     *
     * @Route("/{id}/update", name="fantalineup_update")
     * @Method("post")
     * @Template("FantaManagerBundle:FantaLineUp:edit.html.twig")
     */
    public function updateAction($id)
    {
        $user = $this->get('security.context')->getToken()->getUser();
        
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('FantaManagerBundle:FantaLineUp')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find FantaLineUp entity.');
        }

        $editForm   = $this->createForm(new FantaLineUpType($user), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('fantalineup', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a FantaLineUp entity.
     *
     * @Route("/{id}/delete", name="fantalineup_delete")
     * @Method("post")
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('FantaManagerBundle:FantaLineUp')->find($id);

            $securityContext = $this->get('security.context');

            // check for edit access
            if (false === $securityContext->isGranted('DELETE', $entity))
            {
                throw new AccessDeniedException();
            }
            
            if (!$entity) {
                throw $this->createNotFoundException('Unable to find FantaLineUp entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('fantalineup'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
    
    /**
     * Calculate fantavotes.
     *
     * @Route("/calculate/{id}", name="fantalineup_calculate")
     * @Template()
     */
    public function calculateFantaVotesAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        
        $repository = $em->getRepository('FantaManagerBundle:PlayerVote');
        
        $playerVotes = $repository->findBy(array('round' => $id, 'fantavote' => null));

        if (!$playerVotes) {
            throw new \Exception('No fantaVotes to calculate.');
        }
        
        foreach ($playerVotes as $playerVote) {
            $playerVote->setFantaVote($playerVote->calculateFantaVote());
            $em->persist($playerVote);
        }
        
        $em->flush();
        
        return $this->redirect($this->generateUrl('fanta_manager_fanta_round', array('id' => $id)));
    }
    
    /**
     * Calculate fantavotes.
     *
     * @Route("/calculateIndex/{id}", name="fantalineup_calculate_index")
     * @Template()
     */
    public function calculateIndexValueAction($id)
    {   
        $em = $this->getDoctrine()->getEntityManager();
        
        $repository = $em->getRepository('FantaManagerBundle:Player');
        
        $players = $repository->findAll();

        if (!$players) {
            throw new \Exception('No players found.');
        }
        
        foreach ($players as $player) {
            $player->setIndexValue($player->calculateIndexValue());
            $em->persist($player);
        }
        
        $em->flush();
        
        return $this->redirect($this->generateUrl('fanta_manager_fanta_round', array('id' => $id)));  
    }
}
