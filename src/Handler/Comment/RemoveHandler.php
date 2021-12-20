<?php

namespace Mia\Forum\Handler\Comment;

use Mia\Core\Exception\MiaException;

/**
 * Description of RemoveHandler
 * 
 * @OA\Get(
 *     path="/mia_forum_comment/remove/{id}",
 *     summary="MiaForumComment Revove",
 *     tags={"MiaForumComment"},
 *     @OA\Parameter(
 *         name="id",
 *         description="Id of Item",
 *         required=true,
 *         in="path"
 *     ),
 *     @OA\Response(
 *          response=200,
 *          description="successful operation",
 *          @OA\JsonContent(ref="#/components/schemas/MiaJsonResponse")
 *     ),
 *     security={
 *         {"bearerAuth": {}}
 *     },
 * )
 *
 * @author matiascamiletti
 */
class RemoveHandler extends \Mia\Auth\Request\MiaAuthRequestHandler
{
    /**
     * 
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function handle(\Psr\Http\Message\ServerRequestInterface $request): \Psr\Http\Message\ResponseInterface 
    {
        $user = $this->getUser($request);
        // Obtenemos ID si fue enviado
        $itemId = $this->getParam($request, 'id', '');
        // Buscar si existe el item en la DB
        $item = \Mia\Forum\Model\MiaForumComment::where('id', $itemId)->where('user_id', $user->id)->first();
        // verificar si existe
        if($item === null){
            throw new MiaException('not exist');
        }
        $item->deleted = 1;
        $item->save();

        $item->forum->comments--;
        $item->forum->save();
        // Devolvemos respuesta
        return new \Mia\Core\Diactoros\MiaJsonResponse(true);
    }
}