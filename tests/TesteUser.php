<?php

namespace App\Tests;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

class TesteUser extends TestCase
{
    public function testClassConstructor()
    {
        $user = new User();

        $user->setNome('Laleska Tester');
        $carga = $user->setCargaHorariaSemanal(100);
        $bool = $user->setEmail('teste@teste.com');

        if (!is_null($carga)) {
            echo 'Hello World';
        }

        $this->assertSame('Laleska Tester', $user->getNome());
        $this->assertEquals('teste@teste.com', $bool->getEmail());
        $this->assertIsNumeric($carga->getCargaHorariaSemanal(), 'Deu ruim!');
    }

}