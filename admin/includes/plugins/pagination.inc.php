<?php

include_once __DIR__.'/../../model/pagination.class.php';


function pagination($table_name, $results_per_page){
    
    $pagination = new Pagination();
    
    // find out the number of results stored in database
    $number_of_results = $pagination->ResultCount($table_name, $results_per_page);

    $number_of_results = $number_of_results->num_rows;
    
    
    // determine number of total pages required
    $number_of_pages = ceil($number_of_results/$results_per_page);
    
    // determine which page number visitor is currently on
    if (!isset($_GET['page'])) {
      $page = 1;
    } else {
      $page = $_GET['page'];
    }
    
    // determine the sql LIMIT starting number for the results on the displaying page
    $current_page_first_result = ($page-1)*$results_per_page;
    
    // retrieve selected results from database and display them on page
    $result = $pagination->GetRecords($table_name, $results_per_page, $current_page_first_result, "date");
    
    // display the links to the pages
    for ($page=1;$page<=$number_of_pages;$page++) {
      echo '<a href="index.php?page=' . $page . '">' . $page . '</a> ';
    }

    return $result;
}