<?php

/*
 * This file is part of the Elcodi package.
 *
 * Copyright (c) 2014-2016 Elcodi Networks S.L.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Feel free to edit as you please, and have fun.
 *
 * @author Marc Morera <yuhu@mmoreram.com>
 * @author Aldo Chiecchia <zimage@tiscali.it>
 */

declare(strict_types=1);

namespace Elcodi\Component\Comment\Services;

use Elcodi\Component\Comment\Entity\Interfaces\CommentInterface;
use Elcodi\Component\Comment\EventDispatcher\CommentEventDispatcher;
use Elcodi\Component\Core\Services\ObjectDirector;
use Elcodi\Component\Core\Wrapper\Abstracts\AbstractCacheWrapper;

/**
 * Class CommentManager.
 */
class CommentManager extends AbstractCacheWrapper
{
    /**
     * @var CommentEventDispatcher
     *
     * Comment event dispatcher
     */
    private $commentEventDispatcher;

    /**
     * @var ObjectDirector
     *
     * Comment Director
     */
    private $commentDirector;

    /**
     * Construct method.
     *
     * @param CommentEventDispatcher $commentEventDispatcher
     * @param ObjectDirector         $commentDirector
     */
    public function __construct(
        CommentEventDispatcher $commentEventDispatcher,
        ObjectDirector $commentDirector
    ) {
        $this->commentEventDispatcher = $commentEventDispatcher;
        $this->commentDirector = $commentDirector;
    }

    /**
     * Add comment into source.
     *
     * @param string                $source
     * @param string                $context
     * @param string                $content
     * @param string                $authorToken
     * @param string                $authorName
     * @param string                $authorEmail
     * @param CommentInterface|null $parent
     *
     * @return CommentInterface Commend added
     */
    public function addComment(
        string $source,
        string $context,
        string $content,
        string $authorToken,
        string $authorName,
        string $authorEmail,
        CommentInterface $parent = null
    ) {
        /**
         * @var CommentInterface $comment
         */
        $comment = $this
            ->commentDirector
            ->create();

        $comment->setId(round(microtime(true) * 1000));
        $comment->setParent($parent);
        $comment->setSource($source);
        $comment->setAuthorToken($authorToken);
        $comment->setAuthorName($authorName);
        $comment->setAuthorEmail($authorEmail);
        $comment->setContent($content);
        $comment->setContext($context);

        $this
            ->commentDirector
            ->save($comment);

        $this
            ->commentEventDispatcher
            ->dispatchCommentOnAddEvent($comment);

        return $comment;
    }

    /**
     * Edit a comment.
     *
     * @param CommentInterface $comment
     * @param string           $content
     */
    public function editComment(
        CommentInterface $comment,
        string $content
    ) {
        $comment->setContent($content);

        $this
            ->commentDirector
            ->save($comment);

        $this
            ->commentEventDispatcher
            ->dispatchCommentOnEditEvent($comment);
    }

    /**
     * Remove a comment.
     *
     * @param CommentInterface $comment
     */
    public function removeComment(CommentInterface $comment)
    {
        $this
            ->commentEventDispatcher
            ->dispatchCommentPreRemoveEvent($comment);

        $this
            ->commentDirector
            ->save($comment);

        $this
            ->commentEventDispatcher
            ->dispatchCommentOnRemoveEvent($comment);
    }
}
