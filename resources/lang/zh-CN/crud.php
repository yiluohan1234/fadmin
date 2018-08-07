<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Backpack Crud Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used by the CRUD interface.
    | You are free to change them to anything
    | you want to customize your views to better match your application.
    |
    */

    // Forms
    'save_action_save_and_new' => '保存并添加新项',
    'save_action_save_and_edit' => '保存并编辑此项',
    'save_action_save_and_back' => '保存返回',
    'save_action_changed_notification' => '默认操作已经被更改.',

    // Create form
    'add'                 => '添加',
    'back_to_all'         => '返回列表 ',
    'cancel'              => '取消',
    'add_a_new'           => '添加一个新 ',

    // Edit form
    'edit'                 => '编辑',
    'save'                 => '保存',

    // Revisions
    'revisions'            => 'Revisions',
    'no_revisions'         => 'No revisions found',
    'created_this'         => 'created this',
    'changed_the'          => 'changed the',
    'restore_this_value'   => 'Restore this value',
    'from'                 => 'from',
    'to'                   => 'to',
    'undo'                 => 'Undo',
    'revision_restored'    => 'Revision successfully restored',
    'guest_user'           => 'Guest User',

    // Translatable models
    'edit_translations' => 'EDIT TRANSLATIONS',
    'language'          => 'Language',

    // CRUD table view
    'all'                       => '所有',
    'in_the_database'           => '在数据库中',
    'list'                      => '列表',
    'actions'                   => '操作',
    'preview'                   => '查看',
    'delete'                    => '删除',
    'admin'                     => 'Admin',
    'details_row'               => '这是数据的详细信息,可以按您要求更改.',
    'details_row_loading_error' => '在加载详细信息时出错. 请重试.',

        // Confirmation messages and bubbles
        'delete_confirm'                              => '你确定要删除此项吗?',
        'delete_confirmation_title'                   => '此项被删除',
        'delete_confirmation_message'                 => '此项已经被成功删除.',
        'delete_confirmation_not_title'               => '没有删除',
        'delete_confirmation_not_message'             => "存在错误. 此项也许没有被删除.",
        'delete_confirmation_not_deleted_title'       => '没有删除',
        'delete_confirmation_not_deleted_message'     => '什么也没有发生. 此项是安全的.',

        'ajax_error_title' => '错误',
        'ajax_error_text'  => '加载页面时出错. 请刷新页面.',

        // DataTables translation
        'emptyTable'     => '数据表中没有数据',
        'info'           => '显示 _START_ 到 _END_ 页共 _TOTAL_ 条',
        'infoEmpty'      => '显示 0 到 0 页共 0 条',
        'infoFiltered'   => '(过滤 从 _MAX_ 共 条数)',
        'infoPostFix'    => '',
        'thousands'      => ',',
        'lengthMenu'     => '每页显示 _MENU_  ',
        'loadingRecords' => '加载中...',
        'processing'     => '执行中...',
        'search'         => 'Search: ',
        'zeroRecords'    => '没有匹配的数据',
        'paginate'       => [
            'first'    => '第一页',
            'last'     => '最后一页',
            'next'     => '下一页',
            'previous' => '前一页',
        ],
        'aria' => [
            'sortAscending'  => ': activate to sort column ascending',
            'sortDescending' => ': activate to sort column descending',
        ],
        'export' => [
            'copy'              => '复制',
            'excel'             => 'Excel',
            'csv'               => 'CSV',
            'pdf'               => 'PDF',
            'print'             => '打印',
            'column_visibility' => '显示列',
        ],

    // global crud - errors
        'unauthorized_access' => '未授权 - 你没有权限来查看此页.',
        'please_fix' => '请解决如下错误:',

    // global crud - success / error notification bubbles
        'insert_success' => '此项已经被成功添加.',
        'update_success' => '此项已经被成功修改.',

    // CRUD reorder view
        'reorder'                      => 'Reorder',
        'reorder_text'                 => 'Use drag&drop to reorder.',
        'reorder_success_title'        => 'Done',
        'reorder_success_message'      => 'Your order has been saved.',
        'reorder_error_title'          => 'Error',
        'reorder_error_message'        => 'Your order has not been saved.',

    // CRUD yes/no
        'yes' => 'Yes',
        'no' => 'No',

    // CRUD filters navbar view
        'filters' => 'Filters',
        'toggle_filters' => 'Toggle filters',
        'remove_filters' => 'Remove filters',

    // Fields
        'browse_uploads' => 'Browse uploads',
        'select_all' => 'Select All',
        'select_files' => 'Select files',
        'select_file' => 'Select file',
        'clear' => 'Clear',
        'page_link' => 'Page link',
        'page_link_placeholder' => 'http://example.com/your-desired-page',
        'internal_link' => 'Internal link',
        'internal_link_placeholder' => 'Internal slug. Ex: \'admin/page\' (no quotes) for \':url\'',
        'external_link' => 'External link',
        'choose_file' => 'Choose file',

    //Table field
        'table_cant_add' => 'Cannot add new :entity',
        'table_max_reached' => 'Maximum number of :max reached',

    // File manager
    //'file_manager' => 'File Manager',
];
