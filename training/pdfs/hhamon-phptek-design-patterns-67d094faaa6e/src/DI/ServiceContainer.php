<?php

namespace DI;

class ServiceContainer
{
    private $services   = [];
    private $methodsMap = [];

    public function __construct()
    {
        $this->methodsMap = [
            'logger'  => 'getLoggerService',
            'mailer'  => 'getMailerService',
            'kernel'  => 'getKernelService',
            // ...
        ];
    }
    
    public function get($id)
    {
        $id = strtolower($id);
        if (isset($this->services[$id])) {
            return $this->services[$id];
        }

        if (!isset($this->methodsMap[$id])) {
            throw new ServiceNotFoundException(sprintf('Service "%s" is not registered.', $id));
        }

        $method = $this->methodsMap[$id];

        return call_user_func([ $this, $method ]);
    }

    private function getLoggerService()
    {
        $this->services['logger'] = $instance = new Logger();
        
        return $instance;
    }
}
