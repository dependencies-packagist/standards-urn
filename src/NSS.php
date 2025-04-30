<?php

namespace Standards;

use Stringable;

class NSS implements Stringable
{
    protected array $slots = [];

    public function __construct(string $nss)
    {
        $this->slots = explode(':', $nss);
    }

    public static function build(
        string $namespace = 'params',
        string $subNamespace = 'oauth',
        string $resource = 'jwk-thumbprint',
        string $type = 'sha-256',
        string $value = null,
    ): self
    {
        return new self("{$namespace}:{$subNamespace}:{$resource}:{$type}:{$value}");
    }

    public static function parse(string $urn): self
    {
        return new self($urn);
    }

    public function getNamespace(): ?string
    {
        return $this->slots[0] ?? null;
    }

    public function setNamespace(?string $namespace): static
    {
        $this->slots[0] = $namespace;
        return $this;
    }

    public function getSubNamespace(): ?string
    {
        return $this->slots[1] ?? null;
    }

    public function setSubNamespace(?string $subNamespace): static
    {
        $this->slots[1] = $subNamespace;
        return $this;
    }

    public function getResource(): ?string
    {
        return $this->slots[2] ?? null;
    }

    public function setResource(?string $resource): static
    {
        $this->slots[2] = $resource;
        return $this;
    }

    public function getType(): ?string
    {
        return $this->slots[3] ?? null;
    }

    public function setType(?string $type): static
    {
        $this->slots[3] = $type;
        return $this;
    }

    public function getValue(): ?string
    {
        return $this->slots[4] ?? null;
    }

    public function setValue(?string $value): static
    {
        $this->slots[4] = $value;
        return $this;
    }

    public function toArray(): array
    {
        return [
            $this->getNamespace(),
            $this->getSubNamespace(),
            $this->getResource(),
            $this->getType(),
            $this->getValue(),
        ];
    }

    public function toString(): string
    {
        return implode(':', $this->toArray());
    }

    public function __toString(): string
    {
        return $this->toString();
    }
}
