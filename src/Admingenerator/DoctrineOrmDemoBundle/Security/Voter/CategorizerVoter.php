<?php

namespace Admingenerator\DoctrineOrmDemoBundle\Security\Voter;


use Admingenerator\DoctrineOrmDemoBundle\Entity\Post;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class CategorizerVoter extends Voter
{

    /**
     * Determines if the attribute and subject are supported by this voter.
     *
     * @param string $attribute An attribute
     * @param mixed $subject The subject to secure, e.g. an object the user wants to access or any other PHP type
     *
     * @return bool True if the attribute and subject are supported, false otherwise
     */
    protected function supports($attribute, $subject)
    {
        return 'CATEGORIZER' === $attribute
            && (null == $subject || $subject instanceof Post);
    }

    /**
     * Perform a single access check operation on a given attribute, subject and token.
     *
     * @param string $attribute
     * @param mixed $subject
     * @param TokenInterface $token
     *
     * @return bool
     */
    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        if (null == $subject) {
            // Filters: available
            return true;
        }

        // Available on new, but not on edit
        return !$subject->getId();
    }
}