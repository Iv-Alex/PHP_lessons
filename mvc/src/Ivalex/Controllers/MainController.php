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

    private static function getTableHeaders(array $indexedFields, int $sortFieldId, int $isSortDesc): array
    {
        $sortIconStyle = ['fa-sort-up', 'fa-sort-down', 'default' => 'fa-sort'];
        $tableHeaders = [
            'id' => [
                'caption' => '#',
                'title' => 'id задачи',
            ],
            'name' => [
                'caption' => 'Имя',
                'title' => 'Имя пользователя',
            ],
            'email' => [
                'caption' => 'email',
                'title' => 'Адрес электронной почты',
            ],
            'text' => [
                'caption' => 'Текст задачи',
                'title' => 'Текст задачи',
            ],
            'status' => [
                'caption' => 'Статус',
                'title' => 'Статус задачи'
            ],
        ];
        foreach ($tableHeaders as $fieldName => $fieldAttributes) {
            if ($indexedFields[$fieldName] == $sortFieldId) {
                $sortDesc = !$isSortDesc;
                $tableHeaders[$fieldName]['sortIconStyle'] = $sortIconStyle[$isSortDesc];
            } else {
                $sortDesc = 0;
                $tableHeaders[$fieldName]['sortIconStyle'] = $sortIconStyle['default'];
            }
            $tableHeaders[$fieldName]['sortHref'] = '/page/0/' . $indexedFields[$fieldName] . '/' . $sortDesc;
        }
        return $tableHeaders;
    }
}
