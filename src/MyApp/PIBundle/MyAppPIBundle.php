<?php

namespace MyApp\PIBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class MyAppPIBundle extends Bundle
{
    public function getParent(){
        return 'FOSUserBundle';
    }
}
