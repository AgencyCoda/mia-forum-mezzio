<?php

namespace Mia\Forum\Handler;

/**
 * Description of SaveHandler
 * 
 * @OA\Post(
 *     path="/mia_forum/save",
 *     summary="MiaForum Save",
 *     tags={"MiaForum"},
*      @OA\RequestBody(
 *         description="Object",
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/MiaForum")
 *         )
 *     ),
 *     @OA\Response(
 *          response=200,
 *          description="successful operation",
 *          @OA\JsonContent(ref="#/components/schemas/MiaForum")
 *     ),
 *     security={
 *         {"bearerAuth": {}}
 *     },
 * )
 *
 * @author matiascamiletti
 */
class SaveHandler extends \Mia\Auth\Request\MiaAuthRequestHandler
{
    /**
     * 
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function handle(\Psr\Http\Message\ServerRequestInterface $request): \Psr\Http\Message\ResponseInterface 
    {
        // Obtener item a procesar
        $item = $this->getForEdit($request);
        // Guardamos data
        $item->user_id = intval($this->getParam($request, 'user_id', ''));
        $item->title = $this->getParam($request, 'title', '');
        $item->slug = $this->getParam($request, 'slug', '');
        $item->content = $this->getParam($request, 'content', '');
        $item->favorites = intval($this->getParam($request, 'favorites', ''));
        $item->comments = intval($this->getParam($request, 'comments', ''));
        $item->type = intval($this->getParam($request, 'type', ''));
        $item->item_id = intval($this->getParam($request, 'item_id', ''));
        $item->data = $this->getParam($request, 'data', []);

        $categoryId = $this->getParam($request, 'category_id', 0);
        if($categoryId > 0){
            $item->category_id = $categoryId;
        }
        
        try {
            $item->save();
        } catch (\Exception $exc) {
            return new \Mia\Core\Diactoros\MiaJsonErrorResponse(-2, $exc->getMessage());
        }

        // Devolvemos respuesta
        return new \Mia\Core\Diactoros\MiaJsonResponse($item->toArray());
    }
    
    /**
     * 
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @return \App\Model\MiaForum
     */
    protected function getForEdit(\Psr\Http\Message\ServerRequestInterface $request)
    {
        // Obtenemos ID si fue enviado
        $itemId = $this->getParam($request, 'id', '');
        // Buscar si existe el item en la DB
        $item = \Mia\Forum\Model\MiaForum::find($itemId);
        // verificar si existe
        if($item === null){
            return new \Mia\Forum\Model\MiaForum();
        }
        // Devolvemos item para editar
        return $item;
    }
}