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

namespace Elcodi\Component\Comment\Tests\Services;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use PHPUnit_Framework_TestCase;

use Elcodi\Component\Comment\Entity\Comment;
use Elcodi\Component\Comment\Entity\Vote;
use Elcodi\Component\Comment\Repository\CommentRepository;
use Elcodi\Component\Comment\Services\CommentCache;
use Elcodi\Component\Comment\Services\VoteManager;

/**
 * Class CommentCacheTest.
 */
class CommentCacheTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var CommentCache
     *
     * comment cache
     */
    protected $commentCache;

    /**
     * @var VoteManager
     *
     * vote manager
     */
    protected $voteManager;

    /**
     * @var CommentRepository
     *
     * Comment repository
     */
    protected $commentRepository;

    /**
     * Setup.
     */
    public function setUp()
    {
        $this->commentRepository = $this->createMock('Elcodi\Component\Comment\Repository\CommentRepository');
        $this->voteManager = $this->createMock('Elcodi\Component\Comment\Services\VoteManager');
        $commentVotes = $this->createMock('Elcodi\Component\Comment\Entity\VotePackage');

        $commentVotes
            ->expects($this->any())
            ->method('getNbVotes')
            ->will($this->returnValue(2));

        $commentVotes
            ->expects($this->any())
            ->method('getNbUpVotes')
            ->will($this->returnValue(1));

        $commentVotes
            ->expects($this->any())
            ->method('getNbDownVotes')
            ->will($this->returnValue(1));

        $this
            ->voteManager
            ->expects($this->any())
            ->method('getCommentVotes')
            ->will($this->returnValue($commentVotes));

        $this->commentCache = new CommentCache(
            $this->commentRepository,
            $this->voteManager,
            'key'
        );

        $this
            ->commentCache
            ->setCache($this->getMockForAbstractClass('Doctrine\Common\Cache\CacheProvider'))
            ->setEncoder($this->createMock('Elcodi\Component\Core\Encoder\Interfaces\EncoderInterface'));
    }

    /**
     * Test load.
     */
    public function testLoad()
    {
        $this
            ->commentRepository
            ->expects($this->any())
            ->method('getAllCommentsSortedByParentAndIdAsc')
            ->with($this->equalTo('source'))
            ->will($this->returnValue($this->getCommentsStructure()));

        $comments = $this
            ->commentCache
            ->load('source', 'context');

        $this->assertEquals([
            [
                'entity' => [
                    'id' => 1,
                    'authorName' => 'Marc Morera',
                    'authorEmail' => 'engonga@engonga.com',
                    'context' => 'admin',
                    'content' => 'comment1',
                    'nbVotes' => 2,
                    'nbUpVotes' => 1,
                    'nbDownVotes' => 1,
                    'createdAt' => '2015-01-01 00:00:00',
                    'updatedAt' => '2015-01-01 00:00:00',
                ],
                'children' => [
                    [
                        'entity' => [
                            'id' => 2,
                            'authorName' => 'Marc Morera',
                            'authorEmail' => 'engonga@engonga.com',
                            'context' => 'admin',
                            'content' => 'comment2',
                            'nbVotes' => 2,
                            'nbUpVotes' => 1,
                            'nbDownVotes' => 1,
                    'createdAt' => '2015-01-01 00:00:00',
                    'updatedAt' => '2015-01-01 00:00:00',
                        ],
                        'children' => [],
                    ],
                    [
                        'entity' => [
                            'id' => 3,
                            'authorName' => 'Another guy',
                            'authorEmail' => 'lala@lala.com',
                            'context' => 'admin',
                            'content' => 'comment3',
                            'nbVotes' => 2,
                            'nbUpVotes' => 1,
                            'nbDownVotes' => 1,
                    'createdAt' => '2015-01-01 00:00:00',
                    'updatedAt' => '2015-01-01 00:00:00',
                        ],
                        'children' => [],
                    ],
                ],
            ],
            [
                'entity' => [
                    'id' => 4,
                    'authorName' => 'Marc Morera',
                    'authorEmail' => 'engonga@engonga.com',
                    'context' => 'admin',
                    'content' => 'comment4',
                    'nbVotes' => 2,
                    'nbUpVotes' => 1,
                    'nbDownVotes' => 1,
                    'createdAt' => '2015-01-01 00:00:00',
                    'updatedAt' => '2015-01-01 00:00:00',
                ],
                'children' => [
                    [
                        'entity' => [
                            'id' => 5,
                            'authorName' => 'Marc Morera',
                            'authorEmail' => 'engonga@engonga.com',
                            'context' => 'admin',
                            'content' => 'comment5',
                            'nbVotes' => 2,
                            'nbUpVotes' => 1,
                            'nbDownVotes' => 1,
                    'createdAt' => '2015-01-01 00:00:00',
                    'updatedAt' => '2015-01-01 00:00:00',
                        ],
                        'children' => [],
                    ],
                ],
            ],
        ], $comments);
    }

    /**
     * Get comments structure.
     *
     * @return Collection Comment Structure
     */
    protected function getCommentsStructure()
    {
        $comment1 = new Comment();
        $comment1->setId(1);
        $comment1->setSource('source');
        $comment1->setContext('admin');
        $comment1->setParent(null);
        $comment1->setAuthorName('Marc Morera');
        $comment1->setAuthorEmail('engonga@engonga.com');
        $comment1->setAuthorToken('12345');
        $comment1->setContent('comment1');
        $comment1->setCreatedAt(DateTime::createFromFormat('Y-m-d H:i:s', '2015-01-01 00:00:00'));
        $comment1->setUpdatedAt(DateTime::createFromFormat('Y-m-d H:i:s', '2015-01-01 00:00:00'));

        $comment2 = new Comment();
        $comment2->setId(2);
        $comment2->setSource('source');
        $comment2->setContext('admin');
        $comment2->setParent($comment1);
        $comment2->setAuthorName('Marc Morera');
        $comment2->setAuthorEmail('engonga@engonga.com');
        $comment2->setAuthorToken('12345');
        $comment2->setContent('comment2');
        $comment2->setCreatedAt(DateTime::createFromFormat('Y-m-d H:i:s', '2015-01-01 00:00:00'));
        $comment2->setUpdatedAt(DateTime::createFromFormat('Y-m-d H:i:s', '2015-01-01 00:00:00'));

        $comment3 = new Comment();
        $comment3
            ->setId(3);
        $comment3->setSource('source');
        $comment3->setContext('admin');
        $comment3->setParent($comment1);
        $comment3->setAuthorName('Another guy');
        $comment3->setAuthorEmail('lala@lala.com');
        $comment3->setAuthorToken('12345');
        $comment3->setContent('comment3');
        $comment3->setCreatedAt(DateTime::createFromFormat('Y-m-d H:i:s', '2015-01-01 00:00:00'));
        $comment3->setUpdatedAt(DateTime::createFromFormat('Y-m-d H:i:s', '2015-01-01 00:00:00'));

        $comment4 = new Comment();
        $comment4->setId(4);
        $comment4->setSource('source');
        $comment4->setContext('admin');
        $comment4->setParent(null);
        $comment4->setAuthorName('Marc Morera');
        $comment4->setAuthorEmail('engonga@engonga.com');
        $comment4->setAuthorToken('12345');
        $comment4->setContent('comment4');
        $comment4->setCreatedAt(DateTime::createFromFormat('Y-m-d H:i:s', '2015-01-01 00:00:00'));
        $comment4->setUpdatedAt(DateTime::createFromFormat('Y-m-d H:i:s', '2015-01-01 00:00:00'));

        $comment5 = new Comment();
        $comment5->setId(5);
        $comment5->setSource('source');
        $comment5->setContext('admin');
        $comment5->setParent($comment4);
        $comment5->setAuthorName('Marc Morera');
        $comment5->setAuthorEmail('engonga@engonga.com');
        $comment5->setAuthorToken('12345');
        $comment5->setContent('comment5');
        $comment5->setCreatedAt(DateTime::createFromFormat('Y-m-d H:i:s', '2015-01-01 00:00:00'));
        $comment5->setUpdatedAt(DateTime::createFromFormat('Y-m-d H:i:s', '2015-01-01 00:00:00'));

        return new ArrayCollection([
            $comment1,
            $comment2,
            $comment3,
            $comment4,
            $comment5,
        ]);
    }
}
