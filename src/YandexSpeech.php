<?php

namespace Pyatnitsev\YandexSpeech;


use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

class YandexSpeech
{
    private function generateRandomSelection($min, $max, $count)
    {
        $result=array();
        if($min>$max) return $result;
        $count=min(max($count,0),$max-$min+1);
        while(count($result)<$count) {
            $value=rand($min,$max-count($result));
            foreach($result as $used) if($used<=$value) $value++; else break;
            $result[]=dechex($value);
            sort($result);
        }
        shuffle($result);
        return $result;
    }
    public function getTextByAudioByURL($url, $first = true)
    {
        $uuid=implode($this->generateRandomSelection(0,30,64));
        $uuid=substr($uuid,1,32);
        $key = config('yandex-speech.key');
        $topic = config('yandex-speech.topic');
        $lang = config('yandex-speech.lang');

        $serviceUrl = "https://asr.yandex.net/asr_xml?uuid={$uuid}&key={$key}&topic={$topic}&lang={$lang}";

        $client = new Client();
        $response = $client->post($serviceUrl, ['body' => fopen($url, 'r')]);
        $result = $this->parseXml((string) $response->getBody());
        if (!$result) return false;
        if ($first) {
            return $result[0]['value'];
        } else {
            return $result;
        }
    }

    private function parseXml($xml)
    {
        $result = [];
        $crawler = new Crawler();
        $crawler->addXmlContent($xml);
        if ($crawler->filterXPath('//recognitionResults/@success')->text() == 0)
            return false;
        else {
            foreach ($crawler->filterXPath('//recognitionResults/variant') as $i => $node) {
                $result[] = array('confidence'=> $node->attributes->getNamedItem('confidence')->nodeValue,
                    'value' => $node->nodeValue);
            }
        }
        return $result;
    }
}