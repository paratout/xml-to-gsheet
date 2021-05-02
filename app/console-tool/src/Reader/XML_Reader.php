<?php


namespace App\Reader;

use App\Contract\FileReaderInterface;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class XML_Reader implements FileReaderInterface
{
    private $path;

    public function __construct(string $path)
    {
        $this->path = $path;
    }

    public function getContent(): array
    {
        $serializer = new Serializer([new ObjectNormalizer()], [new XmlEncoder()]);
        return $serializer->decode(file_get_contents($this->path), 'xml');
    }
}
