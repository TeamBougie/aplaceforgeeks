<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Twig;


use AppBundle\Entity\User;
use AppBundle\Manager\AvatarUserResolver;
use Twig\TwigFunction;

class AvatarExtension extends \Twig_Extension
{
    private $avatarResolver;

    public function __construct(AvatarUserResolver $avatarManager)
    {
        $this->avatarResolver = $avatarManager;
    }

    public function getFunctions()
    {
        return array(
            new TwigFunction('get_avatar', array($this, 'getAvatar')),
        );
    }

    public function getAvatar(User $user)
    {
        return $this->avatarResolver->resolve($user);
    }
}
