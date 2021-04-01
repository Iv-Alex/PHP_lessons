<?php

namespace Ivalex\Controllers;

use Ivalex\Models\Comments\Comment;
use Ivalex\Views\View;

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
        $this->view->setTemplatePart('commentsList', 'commentsList.php');
        $this->view->renderHtml('comments.php');
    }

/*

    public function main(int $page = 1, int $sortFieldId = 0, int $sortDesc = 0)
    {

        $cTasks = Task::getRecordCount();
        $cTasksOnPage = self::getOption('countRecordsOnPage');
        $cPage = ceil($cTasks / $cTasksOnPage);
        $page = static::checkPageNum($page, $cPage);
        $indexedFields = Task::getFields(true);
        $sortFieldName = array_search($sortFieldId, $indexedFields, true) ?? 'id';
        $sortFieldId = $indexedFields[$sortFieldName];
        $tableHeaders = $this->getTableHeaders($indexedFields, $sortFieldId, $sortDesc);
        $cTasksOffset = ($page - 1) * $cTasksOnPage;
        $tasks = Task::getRowsGroup($cTasksOffset, $cTasksOnPage, $sortFieldName, $sortDesc);

        $htmlParams = [
            'tableHeaders' => $tableHeaders,
            'tasks' => $tasks,
            'showPageNav' => ($cPage > 1),
            'activePage' => ($page),
            'cPage' => $cPage,
            'sortColumnNumber' => $sortFieldId,
            'sortDesc' => $sortDesc,
        ];

        $this->view->renderHtml('main.php', $htmlParams);
    }
*/
}
