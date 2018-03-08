<?php

namespace SocialiteProviders\Avans;

use SocialiteProviders\Manager\SocialiteWasCalled;

class AvansExtendSocialite
{
    /**
     * Execute the provider.
     */
    public function handle(SocialiteWasCalled $socialiteWasCalled)
    {
        $socialiteWasCalled->extendSocialite(
            'avans',
            __NAMESPACE__.'\Provider',
            __NAMESPACE__.'\Server'
        );
    }
}
