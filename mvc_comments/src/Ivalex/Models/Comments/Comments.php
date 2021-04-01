<?php

namespace Ivalex\Models\Comments;

use Ivalex\Models\ActiveRecordEntity;
use Ivalex\Exceptions\BadValueException;


/**
 * All functions get<StringField>() will return htmlspecialchars(<value>).
 * Use or create if missing get<StringField>Directly() for get the original values
 *
 */
class Comment extends ActiveRecordEntity
{
    protected $name;
    protected $email;
    protected $text;

    /**
     * @return string user name
     */
    public function getName(): string
    {
        return htmlspecialchars($this->name);
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string email
     */
    public function getEmail(): string
    {
        return htmlspecialchars($this->email);
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    /**
     * @return string comment text
     */
    public function getText(): string
    {
        return htmlspecialchars($this->text);
    }

    public function setText(string $text)
    {
        $this->text = $text;
    }

    /**
     *
     */
    public static function addComment(array $commentData): Comment
    {
        if (empty($commentData['username'])) {
            throw new BadValueException('Username not passed', 1001);
        }
        if (empty($commentData['email'])) {
            throw new BadValueException('Email address not passed', 1002);
        }
        if (empty($commentData['text'])) {
            throw new BadValueException('Comment text not passed', 1003);
        }

        $comment = new Comment();

        $comment->setName($commentData['username']);
        $comment->setEmail($commentData['email']);
        $comment->setText($commentData['text']);

        $comment->save();

        return $comment;
    }

    /**
     * contract
     */
    protected static function getTableName(): string
    {
        return 'comments';
    }
}
