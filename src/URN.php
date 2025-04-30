<?php

namespace Standards;

use InvalidArgumentException;
use Stringable;

class URN implements Stringable
{
    protected string $nid;
    protected string $nss;

    public function __construct(string $nid, string $nss)
    {
        if (!preg_match('/^[a-z0-9][a-z0-9-]{1,31}$/', $nid)) {
            throw new InvalidArgumentException("Invalid NID format: {$nid}");
        }

        if (empty($nss)) {
            throw new InvalidArgumentException('NSS cannot be empty.');
        }

        $this->nid = strtolower($nid);
        $this->nss = $nss;
    }

    public static function build(string $nid = 'ietf', string $nss = 'params:oauth:jwk-thumbprint:sha-256:'): self
    {
        return new self($nid, $nss);
    }

    public static function parse(string $urn): self
    {
        $pattern = '/^urn:([a-z0-9][a-z0-9-]{1,31}):(.+)$/i';

        if (!preg_match($pattern, $urn, $matches)) {
            throw new InvalidArgumentException("Invalid URN: {$urn}");
        }

        return new self($matches[1], $matches[2]);
    }

    public function setNID(string $nid): static
    {
        $this->nid = $nid;
        return $this;
    }

    public function getNID(): string
    {
        return $this->nid;
    }

    public function getNSS(): string
    {
        return $this->nss;
    }

    public function setNSS(string $nss): static
    {
        $this->nss = $nss;
        return $this;
    }

    public function toString(): string
    {
        return "urn:{$this->nid}:{$this->nss}";
    }

    public function __toString(): string
    {
        return $this->toString();
    }
}
