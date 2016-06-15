<?php
/*
function add_nguyenlieu_taxonomy_to_post(){

    $taxonomy = 'Ingredients';
    $object_type = 'post';
    
    $labels = array(
        'name'               => 'Ingredients',
        'singular_name'      => 'Ingredient',
        'search_items'       => 'Search Ingredients',
        'all_items'          => 'All Ingredients',
        'parent_item'        => 'Parent Ingredient',
        'parent_item_colon'  => 'Parent Ingredient:',
        'update_item'        => 'Update Ingredient',
        'edit_item'          => 'Edit Ingredient',
        'add_new_item'       => 'Add New Ingredient', 
        'new_item_name'      => 'New Ingredient Name',
        'menu_name'          => 'Ingredients'
    );
    
    $args = array(
        'labels'            => $labels,
        'hierarchical'      => true,
        'show_ui'           => true,
        'how_in_nav_menus'  => true,
        'public'            => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'nguyen-lieu')
    );
    
    register_taxonomy($taxonomy, $object_type, $args); 
}
add_action('init','add_nguyenlieu_taxonomy_to_post'); 

function add_menu_atgd_taxonomy_to_post(){

    $taxonomy = 'menu_atgd';
    $object_type = 'post';
    
    $labels = array(
        'name'               => 'menu_atgd',
        'singular_name'      => 'menu_atgd',
        'search_items'       => 'Search menu atgd',
        'all_items'          => 'All menu atgd',
        'parent_item'        => 'Parent menu atgd',
        'parent_item_colon'  => 'Parent menu atgd:',
        'update_item'        => 'Update menu atgd',
        'edit_item'          => 'Edit menu atgd',
        'add_new_item'       => 'Add New menu atgd', 
        'new_item_name'      => 'New menu atgd Name',
        'menu_name'          => 'menu_atgd'
    );
    
    $args = array(
        'labels'            => $labels,
        'hierarchical'      => true,
        'show_ui'           => true,
        'how_in_nav_menus'  => true,
        'public'            => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'atgd')
    );
    
    register_taxonomy($taxonomy, $object_type, $args); 
}
add_action('init','add_menu_atgd_taxonomy_to_post'); 
*/
?>