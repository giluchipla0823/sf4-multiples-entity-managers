<?php

namespace App\Traits;

use App\Helpers\AppHelper;
use App\Helpers\JsonResponseHelper;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

Trait ApiResponse{

    /**
     * Construir una respuesta de éxito.
     *
     * @param $data
     * @param string $message
     * @param int $code
     * @param array $extras
     * @return JsonResponse
     */
    protected function successResponse(
        $data,
        string $message = 'OK',
        int $code = Response::HTTP_OK,
        array $extras = []
    ): JsonResponse{
        return $this->makeResponse($data, $message, $code, $extras);
    }

    /**
     * Construir respuesta para mostrar sólo mensajes.
     *
     * @param string $message
     * @param int $code
     * @return JsonResponse
     */
    protected function showMessageResponse(string $message, int $code): JsonResponse{
        return $this->makeResponse(NULL, $message, $code);
    }

    /**
     * Construir respuestas de error.
     *
     * @param string $message
     * @param int $code
     * @param array $extras
     * @return JsonResponse
     */
    protected function errorResponse(string $message, int $code, array $extras = []): JsonResponse{
        return $this->makeResponse(NULL, $message, $code, $extras);
    }

    /**
     * Returns a JsonResponse that uses the serializer component if enabled, or json_encode.
     *
     * @param $data
     * @param int $status
     * @param array $headers
     * @param array $context
     * @return JsonResponse
     */
    protected function json(
        $data,
        int $status = Response::HTTP_OK,
        array $headers = [],
        array $context = []
    ): JsonResponse
    {
        $container = AppHelper::getKernelContainer();

        if ($container->has('jms_serializer')) {
            $json = $container->get('jms_serializer')->serialize($data, 'json');

            $data = json_decode($json, TRUE);
        }

        return new JsonResponse($data, $status, $headers);
    }

    /**
     * Crear formato de respuesta json.
     *
     * @param $data
     * @param string $message
     * @param int $code
     * @param array $extras
     * @return JsonResponse
     */
    private function makeResponse($data, string $message, int $code, array $extras = []): JsonResponse{
        $response = JsonResponseHelper::getResponse($data, $message, $code, $extras);

        return $this->json($response, $code);
    }
}