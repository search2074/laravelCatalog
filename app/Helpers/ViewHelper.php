<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Request;

/**
 * Для представлений
 *
 * @author User
 */
class ViewHelper {
    /**
     * Шаблон кнопки сортировки сверху вниз
     */
    const SortUpBtnTempate = '<i class="fa fa-caret-up" aria-hidden="true" title="Отсортировать от меньшего к большему"></i>';
    /**
     * Шаблон кнопки сортировки снизу вверх
     */
    const SortDownBtnTempate = '<i class="fa fa-caret-down" aria-hidden="true" title="Отсортировать от большего к меньшему"></i>';
    
    /**
     * Рисует колонку с кнопками сортировки
     * @param string $field имя поля
     * @param string $title Название колонки
     * @return string
     */
    public static function renderSortColumn($field, $title) {
        $sort_by = strip_tags(Request::input('sort_by'));
        $direction = Request::input('direction') == 'asc' ? 'desc' : 'asc';

//        if($sort_by || $direction){
//            echo "sort by {$sort_by} {$direction}";
//        }
        
        // TODO: проверка нажатых кнопок, если нажата то ссылку не выводить
        $up = $sort_by === $field && $direction === 'desc' ? self::SortUpBtnTempate : sprintf('<a href="%s">%s</a>', action('ProductController@index', ['sort_by' => $field, 'direction' => 'asc']), self::SortUpBtnTempate);
        $down = $sort_by === $field && $direction === 'asc' ? self::SortDownBtnTempate : sprintf('<a href="%s">%s</a>', action('ProductController@index', ['sort_by' => $field, 'direction' => 'desc']), self::SortDownBtnTempate);
        
        return sprintf("<span>%s</span> %s %s", $title, $up, $down);
    }
}
