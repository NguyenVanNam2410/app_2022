<?php

namespace App\Services;


abstract class Service
{
    
    protected $user = null;

    
    public function withUser($user): static
    {
        $this->user = $user;

        return $this;
    }

  
    public function getUser(): ?\App\Models\User
    {
        return $this->user;
    }

  
    public static function getInstance(): static
    {
        return app(static::class);
    }
}