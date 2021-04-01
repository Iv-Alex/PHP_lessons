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
     * prepare single webpage contains adding form and comments list
     */
    public function addComment(): void
    {
        if (isset($_POST['addComment'])) {
            try {
                // will use Prepared Statements to insert data into SQL query
                $comment = Comment::addComment([
                    'username' => $_POST['username'],
                    'email' => $_POST['email'],
                    'text' => $_POST['text'],
                ]);
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
    private function setCommentsList()
    {
        $this->view->setVar('comments', Comment::getById(0, '>='));
        $this->view->setTemplatePart('commentsList', 'commentsList.php');
    }
}
