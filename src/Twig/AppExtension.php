<?php

namespace App\Twig;

use Twig\TwigFunction;
use Twig\Extension\AbstractExtension;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Http\Util\TargetPathTrait;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class AppExtension extends AbstractExtension
{
    use TargetPathTrait;

    public function __construct(
        private RequestStack $requestStack,
        private Security $security
    ) {}

    public function getFunctions(): array
    {
        return [
            new TwigFunction('need_login_referer', [$this, 'needLoginReferer'])
        ];
    }

    public function needLoginReferer(): bool
    {
        if ($this->security->getUser()) {
            return false;
        }

        $request = $this->requestStack->getCurrentRequest();
        $referrer = $request->getUri();
        
        $this->saveTargetPath($request->getSession(), 'main', $referrer);

        return true;
    }
}