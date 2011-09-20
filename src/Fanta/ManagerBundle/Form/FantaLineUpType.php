<?php

namespace Fanta\ManagerBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Doctrine\ORM\EntityRepository;

class FantaLineUpType extends AbstractType
{
    private $user;
    
    public function __construct($user)
    {
        $this->user = $user;
    }
    
    public function buildForm(FormBuilder $builder, array $options)
    {   
        $fanta_team_id = $this->user->getFantaTeam()->getId();
        
        $builder
            ->add('player', 'entity', array(
                'class' => 'Fanta\\ManagerBundle\\Entity\\Player',
                'query_builder' => function(EntityRepository $er) use ($fanta_team_id)  {
                    return $er->createQueryBuilder('p')
                        ->leftJoin('p.fantaTeam', 't')
                        ->where('t.id = :fanta_team_id')
                        ->setParameter('fanta_team_id', $fanta_team_id)
                        ->orderBy('p.role', 'DESC');
                },
            ))
            ->add('is_substitute', null, array('required' => false))
            ->add('substitute_priority', null, array('required' => false))
        ;
    }

    public function getName()
    {
        return 'fanta_managerbundle_fantalineuptype';
    }
}
