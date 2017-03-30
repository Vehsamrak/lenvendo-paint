<?php

namespace Lenvendo\Canvas\Service\ImageRepository\ImageScheme;

/**
 * @author Vehsamrak
 */
class Image
{

    private $id;
    private $password;
    private $scheme;

    public function __construct(string $id, string $password, $scheme)
    {
        $this->id = $id;
        $this->password = $password;
        $this->scheme = $scheme;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getScheme(): string
    {
        return $this->scheme;
    }

    public function setScheme(string $scheme)
    {
        $this->scheme = $scheme;
    }
}
