<?php

namespace Alura\Cursos\Factories;

class XMLFactory
{
    public function create(array $data, string $xmlElement): string
    {
        $dataInXml = new \SimpleXMLElement($xmlElement);

        foreach ($data as $d) {
            $valuesInXml = $dataInXml->addChild('curso');
            $valuesInXml->addChild('id', $d->getId());
            $valuesInXml->addChild('descricao', $d->getDescricao());
        }

        header('Content-Type: application/xml');

        return $dataInXml->asXML();
    }
}
