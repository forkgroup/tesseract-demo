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

namespace HyperfTest\Cases;

use HyperfTest\HttpTestCase;

/**
 * @internal
 * @coversNothing
 */
class ImageTest extends HttpTestCase
{
    public function testImageReadFailed()
    {
        $res = $this->json('/image/read');
        $this->assertSame(1000, $res['code']);
    }

    public function testImageRead()
    {
        $res = $this->json('/image/read', [
            'url' => 'https://raw.githubusercontent.com/thiagoalessio/tesseract-ocr-for-php/master/tests/EndToEnd/images/8055.png',
        ]);

        $this->assertSame(0, $res['code']);
        $this->assertSame('8055', $res['data']);
    }
}
