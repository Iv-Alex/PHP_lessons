<?php

namespace Ivalex\Controllers;

use Ivalex\Models\Tasks\Task;

use Ivalex\Views\View;

/**
 * @var int $cTasksOnPage tasks per page
 * @var int $cPage count of pages
 * @var int $page current page number
 */
class MainController extends BasicController
{

    public function main(int $page = 1, int $sortColumnNumber = 0, int $desc = 0)
    {

        $cTasks = Task::getRecordCount();
        $cTasksOnPage = self::getOption('countRecordsOnPage');
        $cPage = ceil($cTasks / $cTasksOnPage);
        $page = static::checkPageNum($page, $cPage);
        $indexedFields = Task::getFields();
        if (!array_key_exists($sortColumnNumber, $indexedFields)) {
            $sortColumnNumber = 0;
        }
        $sortColumn = $indexedFields[$sortColumnNumber];
        $tasksOffset = ($page - 1) * $cTasksOnPage;
        $tasks = Task::getRowsGroup($tasksOffset,$cTasksOnPage,$sortColumn,$desc);

        $htmlParams = [
            'tasks' => $tasks,
            'showPageNav' => ($cPage > 1),
            'activePage' => ($page),
            'cPage' => $cPage,
            'sortColumnNumber' => $sortColumnNumber,
            'sortDesc' => $desc,
            'indexedFields' => $indexedFields,
        ];

        $this->view->renderHtml('main.php', $htmlParams);
    }

    /**
     * check page number limits
     */
    private static function checkPageNum(int $page, int $cPage): int
    {
        if ($page < 2) {
            $page = 1;
        } elseif ($page > $cPage) {
            $page = $cPage;
        }

        return $page;
    }
}
