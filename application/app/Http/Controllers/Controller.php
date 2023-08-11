<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * Class Controller
 * @package App\Http\Controllers
 *
 * @OA\Info(
 *      version="1.0.0",
 *      title="Neighbour states API documentation",
 *      description="Paths between countries, if its available",
 *      @OA\Contact(
 *          email="me@kalanys.com"
 *      )
 * )
 *
 * @OA\Tag(
 *     name="Targeting",
 *     description="Targeting paths via known data"
 * )
 *
 * @OA\Server(
 *      url=L5_SWAGGER_CONST_HOST,
 *      description="Demo API Server"
 * )
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
