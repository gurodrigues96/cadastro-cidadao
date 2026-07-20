<?php
use PHPUnit\Framework\TestCase;
use App\models\ValidadorCPF;

class ValidadorCPFTest extends TestCase {
    
    public function testDeveAceitarCpfValido() {
        $this->assertTrue(ValidadorCPF::validar('11144477735')); 
    }

    public function testDeveRejeitarCpfComDigitosRepetidos() {
        $this->assertFalse(ValidadorCPF::validar('11111111111'));
    }

    public function testDeveRejeitarCpfIncompleto() {
        $this->assertFalse(ValidadorCPF::validar('123456'));
    }
}