<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommentRepository")
 */
class Comment
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $timestamp;

    /**
     * @ORM\Column(type="integer")
     */
    private $good;

    /**
     * @ORM\Column(type="integer")
     */
    private $bad;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\user", inversedBy="comments")
     */
    private $author;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Topic", inversedBy="comments")
     */
    private $topic;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTimestamp(): ?int
    {
        return $this->timestamp;
    }

    public function setTimestamp(int $timestamp): self
    {
        $this->timestamp = $timestamp;

        return $this;
    }

    public function getGood(): ?int
    {
        return $this->good;
    }

    public function setGood(int $good): self
    {
        $this->good = $good;

        return $this;
    }

    public function getBad(): ?int
    {
        return $this->bad;
    }

    public function setBad(int $bad): self
    {
        $this->bad = $bad;

        return $this;
    }

    public function getAuthor(): ?user
    {
        return $this->author;
    }

    public function setAuthor(?user $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getTopic(): ?Topic
    {
        return $this->topic;
    }

    public function setTopic(?Topic $topic): self
    {
        $this->topic = $topic;

        return $this;
    }
}
