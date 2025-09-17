<?php

use PHPUnit\Framework\TestCase;
use App\WordReverser;

class WordReverserTest extends TestCase
{
    // Тестирование базовых английских слов с разным регистром и пунктуацией
    public function testEnglishSimple()
    {
        $this->assertSame('Tac', WordReverser::reverseStringWords('Cat'));
        $this->assertSame('EsuOh', WordReverser::reverseStringWords('HouSe'));
        $this->assertSame('TnAhPele', WordReverser::reverseStringWords('ElEpHant'));
        $this->assertSame('tac,', WordReverser::reverseStringWords('cat,'));
        $this->assertSame("si 'dloc' won", WordReverser::reverseStringWords("is 'cold' now"));
    }

    // Тестирование русских слов с поддержкой Unicode и различных символов
    public function testRussianSimple()
    {
        $this->assertSame('Ьшым', WordReverser::reverseStringWords('Мышь'));
        $this->assertSame('кимОД', WordReverser::reverseStringWords('домИК'));
        $this->assertSame('Амиз:', WordReverser::reverseStringWords('Зима:'));
        $this->assertSame('отэ «Кат» "отсорп"', WordReverser::reverseStringWords('это «Так» "просто"'));
    }

    // Тестирование обработки разделителей, дефисов и апострофов (считаются частью слова)
    public function testSeparatorsSimple()
    {
        $this->assertSame('driht-trap', WordReverser::reverseStringWords('third-part'));
        $this->assertSame("nac`t", WordReverser::reverseStringWords("can`t"));
        $this->assertSame("it's-e", WordReverser::reverseStringWords("ti's-e"));
    }

    // Тестирование смешанного контента: цифры, буквы, спецсимволы и Unicode с диакритиками
    public function testMixedSimple()
    {
        $this->assertSame('123 cba!', WordReverser::reverseStringWords('123 abc!'));
        $this->assertSame('FeDcBa', WordReverser::reverseStringWords('AbCdEf'));
        $this->assertSame('DçBá', WordReverser::reverseStringWords('ÁbÇd'));
    }
}
