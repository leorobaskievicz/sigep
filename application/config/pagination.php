<?php
$config['page_query_string'] = TRUE;

$config["per_page"] = 20;
$config["uri_segment"] = 3;

$config['full_tag_open'] = '<nav id="navPages"><ul class="pagination">';
$config['full_tag_close'] = '</ul></nav>';

$config['first_link'] = '&larr;';
$config['first_tag_open'] = "<li>";
$config['first_tag_close'] = "</li>";

$config['last_link'] = '&rarr;';
$config['last_tag_open'] = "<li>";
$config['last_tag_close'] = "</li>";

$config['next_link'] = '<span aria-hidden="true">&raquo;</span>';
$config['next_tag_open'] = '<li>';
$config['next_tag_close'] = '</li>';

$config['prev_link'] = '<span aria-hidden="true">&laquo;</span>';
$config['prev_tag_open'] = '<li>';
$config['prev_tag_close'] = '</li>';

$config['cur_tag_open'] = '<li class="active"><a href="#" target="_self">';
$config['cur_tag_close'] = '</a></li>';

$config['num_tag_open'] = '<li>';
$config['num_tag_close'] = '</li>';