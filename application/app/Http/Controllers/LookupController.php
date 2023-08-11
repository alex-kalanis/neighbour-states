<?php

namespace App\Http\Controllers;

use App\Lib\Lookup;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;

/**
 * This is a main lookup for getting parts of data from the system
 * By just a few things it can get the rest of data
 */
class LookupController extends Controller
{
    /** @var Lookup */
    protected $lookup = null;

    public function __construct(Lookup $lookup)
    {
        $this->lookup = $lookup;
    }

    /**
     * Get available addresses by sent parts
     *
     * @OA\Get(
     *     path="/routing/{country1}/{country2}",
     *     tags={"Targeting"},
     *     security={{"sanctum": {}}},
     *     @OA\RequestBody(),
     *     @OA\Response(response="200", description="Available path", @OA\JsonContent()),
     *     @OA\Response(response="400", description="No path found", @OA\JsonContent()),
     *     @OA\Response(response="401", description="Unauthorized", @OA\JsonContent()),
     *     @OA\Response(response="404", description="Not Found", @OA\JsonContent()),
     *     @OA\Response(response="419", description="Error", @OA\JsonContent()),
     *     @OA\Response(response="500", description="Server error", @OA\JsonContent())
     * )
     *
     * @param string $country1
     * @param string $country2
     * @throws Exception
     * @return JsonResponse
     */
    public function paths(string $country1, string $country2): JsonResponse
    {
        try {
            $path = $this->lookup->processing(strtoupper($country1), strtoupper($country2));

            if (empty($path)) {
                return new JsonResponse(['error' => 'path not found'], 400);
            }
            return new JsonResponse($path);
        } catch (ModelNotFoundException $ex) {
            return new JsonResponse(['error' => $ex->getMessage()], 419);
        }
    }
}
