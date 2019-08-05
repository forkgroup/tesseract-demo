<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://doc.hyperf.io
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf-cloud/hyperf/blob/master/LICENSE
 */

namespace App\Service;

use Hyperf\Guzzle\ClientFactory;
use Hyperf\Task\Annotation\Task;
use thiagoalessio\TesseractOCR\TesseractOCR;

class ImageService
{
    public function read(string $url)
    {
        $path = $this->save($url);

        return $this->tesseract($path);
    }

    /**
     * @Task
     */
    public function tesseract(string $path)
    {
        return (new TesseractOCR($path))->run();
    }

    protected function save(string $url): string
    {
        $client = di()->get(ClientFactory::class)->create();
        $content = $client->get($url)->getBody()->getContents();

        $path = BASE_PATH . '/runtime/' . uniqid();
        file_put_contents($path, $content);

        return $path;
    }
}
