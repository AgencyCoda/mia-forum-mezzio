<?php

namespace Mia\Forum\Handler\Comment;

/**
 * Description of SaveHandler
 * 
 * @OA\Post(
 *     path="/mia_forum_comment/save",
 *     summary="MiaForumComment Save",
 *     tags={"MiaForumComment"},
*      @OA\RequestBody(
 *         description="Object",
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/MiaForumComment")
 *         )
 *     ),
 *     @OA\Response(
 *          response=200,
 *          description="successful operation",
 *          @OA\JsonContent(ref="#/components/schemas/MiaForumComment")
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
        $item->forum_id = intval($this->getParam($request, 'forum_id', ''));
        $item->user_id = intval($this->getParam($request, 'user_id', ''));
        $item->comment = $this->getParam($request, 'comment', '');
        $item->favorites = intval($this->getParam($request, 'favorites', ''));
        $item->status = intval($this->getParam($request, 'status', ''));
                
        
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
     * @return \App\Model\MiaForumComment
     */
    protected function getForEdit(\Psr\Http\Message\ServerRequestInterface $request)
    {
        // Obtenemos ID si fue enviado
        $itemId = $this->getParam($request, 'id', '');
        // Buscar si existe el item en la DB
        $item = \Mia\Forum\Model\MiaForumComment::find($itemId);
        // verificar si existe
        if($item === null){
            return new \Mia\Forum\Model\MiaForumComment();
        }
        // Devolvemos item para editar
        return $item;
    }
}