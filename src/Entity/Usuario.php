<?php

namespace  Application\Source\Entity;

use DateTime;

/**
 * @Entity
 * @Table(name="usuarios")
 */
class Usuario
{
    /**
     * @Id
     * @GeneratedValue
     * @Column(type="integer")
     */
    private $id;
    /**
     * @Column(type="string")
     */
    private $email;
    /**
     * @Column(type="string")
     */
    private $senha;

    private DateTime $created_at;

    public function senhaEstaCorreta(string $senhaPura): bool
    {
        return password_verify($senhaPura, $this->senha);
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setSenha($senha)
    {
        $this->senha = $senha;
    }

    public function setCreatedAt(): void
    {
        $this->created_at = new DateTime("now");
    }
}
