<?php

namespace Ivalex\Controllers;

use Ivalex\Models\Comments\Comment;
use Ivalex\Views\View;
use Ivalex\Exceptions\BadValueException;


/**
 * 
 */
class CommentsController extends BasicController
{

    /**
     * prepare single webpage contains adding form and comments list
     */
    public function singlePage()
    {
        $this->view->setTemplatePart('pageHeader', 'header.php');
        $this->view->setTemplatePart('pageFooter', 'footer.php');
        $this->view->setTemplatePart('commentsForm', 'commentsForm.php');
        $this->setCommentsList();
        $this->view->renderHtml('comments.php');
    }

    /**
     * 
     */
    private function setCommentsList()
    {
        $this->view->setVar('comments', Comment::getById(0, '>='));
        $this->view->setTemplatePart('commentsList', 'commentsList.php');
    }

    /**
     * prepare single webpage contains adding form and comments list
     */
    public function addComment(): void
    {
        if (isset($_POST['addComment'])) {
            try {
                // will use Prepared Statements to insert data into SQL query
                Comment::addComment($this->getCommentFields($_POST));
            } catch (BadValueException $e) {
                // send error message to the page
                $this->view->setVar('error', $e->getMessage());
                // refresh the page
                $this->singlePage();
                return;
            }
        }
        header('Location: /');
    }

    /**
     * 
     */
    public function ajaxAddComment(): void
    {
        if (isset($_POST['ajaxAddComment'])) {
            try {
                // will use Prepared Statements to insert data into SQL query
                $comment = Comment::addComment($this->getCommentFields($_POST));
                $results['error'] = '';
                $success = true;
                $results['data'] = [
                    'id' => $comment->getId(),
                    'username' => $comment->getName(),
                    'email' => $comment->getEmail(),
                    'text' => $comment->getText(),
                ];
            } catch (BadValueException $e) {
                // send error message to the page
                $success = false;
                $results['error'] = $e->getMessage();
            }
        } else {
            $success = false;
            $results['error'] = 'No correct data';
        }
        $json = json_encode($results);

        if ($success) {
            header('HTTP/1.1 201 Created');
            header('Content-Type: application/json; charset=UTF-8');
            echo $json;
        } else {
            header('HTTP/1.1 400 Bad Request');
            header('Content-Type: application/json; charset=UTF-8');
            die($json);
        }
    }

    /**
     * @param array $dataSource such as $_POST
     */
    private function getCommentFields($dataSource): array
    {
        return array(
            'username' => $dataSource['username'] ?? '',
            'email' => $dataSource['email'] ?? '',
            'text' => $dataSource['text'] ?? '',
        );
    }
}
