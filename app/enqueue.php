<?php namespace MyPlugin;

/** @var \Herbert\Framework\Enqueue $enqueue */

$enqueue->admin([
    'as'  => 'Jquery',
    'src' => Helper::assetUrl('/js/jquery.js'),
    'filter' => [ 'panel' => '*' ]
]);
$enqueue->admin([
    'as'  => 'bootstrapCSS',
    'src' => 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css',
    'filter' => [ 'panel' => '*' ]
]);

$enqueue->admin([
    'as'  => 'bootstrapJS',
    'src' => 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js',
    'filter' => [ 'panel' => '*' ]
]);
$enqueue->admin([
    'as'  => 'DataTableCSS',
    'src' => 'https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css',
    'filter' => [ 'panel' => '*' ]
]);
$enqueue->admin([
    'as'  => 'DataTableButtonCSS',
    'src' => 'https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css',
    'filter' => [ 'panel' => '*' ]
]);
$enqueue->admin([
    'as'  => 'DataTableJS',
    'src' => 'https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js',
    'filter' => [ 'panel' => '*' ]
]);
$enqueue->admin([
    'as'  => 'DataTableButtonJS',
    'src' => 'https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js',
    'filter' => [ 'panel' => '*' ]
]);
$enqueue->admin([
    'as'  => 'Library1',
    'src' => 'https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js',
    'filter' => [ 'panel' => '*' ]
]);
$enqueue->admin([
    'as'  => 'Library2',
    'src' => 'https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js',
    'filter' => [ 'panel' => '*' ]
]);
$enqueue->admin([
    'as'  => 'Library3',
    'src' => 'https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js',
    'filter' => [ 'panel' => '*' ]
]);
$enqueue->admin([
    'as'  => 'Library4',
    'src' => 'https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js',
    'filter' => [ 'panel' => '*' ]
]);
$enqueue->admin([
    'as'  => 'Library5',
    'src' => 'https://cdn.datatables.net/buttons/1.2.2/js/buttons.colVis.min.js',
    'filter' => [ 'panel' => '*' ]
]);
$enqueue->admin([
    'as'  => 'Library6',
    'src' => 'https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js',
    'filter' => [ 'panel' => '*' ]
]);

$enqueue->admin([
    'as'  => 'StyeCSS',
    'src' => Helper::assetUrl('/css/style.css'),
    'filter' => [ 'panel' => '*' ]
]);

$enqueue->admin([
    'as'  => 'ScriptJS',
    'src' => Helper::assetUrl('/js/script.js'),
    'filter' => [ 'panel' => '*' ]
]);

$enqueue->admin([
    'as'  => 'SweetCSS',
    'src' => Helper::assetUrl('/css/sweetalert.css'),
    'filter' => [ 'panel' => '*' ]
]);

$enqueue->admin([
    'as'  => 'SweetJS',
    'src' => Helper::assetUrl('/js/sweetalert.min.js'),
    'filter' => [ 'panel' => '*' ]
]);