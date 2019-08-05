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

namespace App\Controller;

use App\Constants\ErrorCode;
use App\Exception\BusinessException;
use App\Service\ImageService;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\AutoController;

/**
 * @AutoController(prefix="/image")
 */
class ImageController extends Controller
{
    /**
     * @Inject
     * @var ImageService
     */
    protected $service;

    public function read()
    {
        $url = $this->request->input('url');

        if (empty($url)) {
            throw new BusinessException(ErrorCode::PARAMS_INVALID);
        }

        $result = $this->service->read($url);

        return $this->response->success($result);
    }
}
