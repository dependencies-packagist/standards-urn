<?php

namespace Standards\URN;

use InvalidArgumentException;
use Stringable;

class UniformResourceName implements Stringable
{
    protected string $namespaceIdentifier;
    protected string $namespaceSpecificString;

    public function __construct(string $namespaceIdentifier, string $namespaceSpecificString)
    {
        if (!preg_match('/^[a-z0-9][a-z0-9-]{1,31}$/', $namespaceIdentifier)) {
            throw new InvalidArgumentException("Invalid NamespaceIdentifier format: {$namespaceIdentifier}");
        }

        if (empty($namespaceSpecificString)) {
            throw new InvalidArgumentException('NamespaceSpecificString cannot be empty.');
        }

        $this->namespaceIdentifier     = strtolower($namespaceIdentifier);
        $this->namespaceSpecificString = $namespaceSpecificString;
    }

    public static function build(string $namespaceIdentifier = 'ietf', string $namespaceSpecificString = 'params:oauth:jwk-thumbprint:sha-256:'): self
    {
        return new self($namespaceIdentifier, $namespaceSpecificString);
    }

    public static function parse(string $urn): self
    {
        $pattern = '/^urn:([a-z0-9][a-z0-9-]{1,31}):(.+)$/i';

        if (!preg_match($pattern, $urn, $matches)) {
            throw new InvalidArgumentException("Invalid URN: {$urn}");
        }

        return new self($matches[1], $matches[2]);
    }

    public function setNamespaceIdentifier(string $namespaceIdentifier): static
    {
        $this->namespaceIdentifier = $namespaceIdentifier;
        return $this;
    }

    public function getNamespaceIdentifier(): string
    {
        return $this->namespaceIdentifier;
    }

    public function getNamespaceSpecificString(): string
    {
        return $this->namespaceSpecificString;
    }

    public function setNamespaceSpecificString(string $namespaceSpecificString): static
    {
        $this->namespaceSpecificString = $namespaceSpecificString;
        return $this;
    }

    public function toString(): string
    {
        return "urn:{$this->namespaceIdentifier}:{$this->namespaceSpecificString}";
    }

    public function __toString(): string
    {
        return $this->toString();
    }
}
