<?php
/**
 * Created by PhpStorm.
 * User: SAMSUNG
 * Date: 02/04/2017
 * Time: 18:25
 */

namespace MyApp\VideoBundle\Controller;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ThreadController
{
    public function postThreadCommentsAction(Request $request, $id)
    {
        $thread = $this->container->get('fos_comment.manager.thread')->findThreadById($id);
        if (!$thread) {
            throw new NotFoundHttpException(sprintf('Thread with identifier of "%s" does not exist', $id));
        }

        if (!$thread->isCommentable()) {
            throw new AccessDeniedHttpException(sprintf('Thread "%s" is not commentable', $id));
        }

        $parent = $this->getValidCommentParent($thread, $request->query->get('parentId'));
        $commentManager = $this->container->get('fos_comment.manager.comment');
        $comment = $commentManager->createComment($thread, $parent);

        $form = $this->container->get('fos_comment.form_factory.comment')->createForm(null, array('method' => 'POST'));
        $form->setData($comment);
        $form->handleRequest($request);

        if ($form->isValid()) {
            if ($commentManager->saveComment($comment) !== false) {
                return $this->getViewHandler()->handle($this->onCreateCommentSuccess($form, $id, $parent));
            }
        }

        return $this->getViewHandler()->handle($this->onCreateCommentError($form, $id, $parent));
    }


}