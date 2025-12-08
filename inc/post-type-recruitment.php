<?php
/**
 * Register Custom Post Type: Recruitment
 */
function register_recruitment_post_type()
{
    $labels = array(
        'name'                  => _x('Tuyển dụng', 'Post Type General Name', 'canhcamtheme'),
        'singular_name'         => _x('Tuyển dụng', 'Post Type Singular Name', 'canhcamtheme'),
        'menu_name'             => __('Tuyển dụng', 'canhcamtheme'),
        'name_admin_bar'        => __('Tuyển dụng', 'canhcamtheme'),
        'archives'              => __('Danh sách tuyển dụng', 'canhcamtheme'),
        'attributes'            => __('Thuộc tính', 'canhcamtheme'),
        'parent_item_colon'     => __('Mục cha:', 'canhcamtheme'),
        'all_items'             => __('Tất cả', 'canhcamtheme'),
        'add_new_item'          => __('Thêm mới', 'canhcamtheme'),
        'add_new'               => __('Thêm mới', 'canhcamtheme'),
        'new_item'              => __('Việc làm mới', 'canhcamtheme'),
        'edit_item'             => __('Chỉnh sửa', 'canhcamtheme'),
        'update_item'           => __('Cập nhật', 'canhcamtheme'),
        'view_item'             => __('Xem', 'canhcamtheme'),
        'view_items'            => __('Xem tất cả', 'canhcamtheme'),
        'search_items'          => __('Tìm kiếm', 'canhcamtheme'),
        'not_found'             => __('Không tìm thấy', 'canhcamtheme'),
        'not_found_in_trash'    => __('Không có trong thùng rác', 'canhcamtheme'),
        'featured_image'        => __('Ảnh đại diện', 'canhcamtheme'),
        'set_featured_image'    => __('Đặt ảnh đại diện', 'canhcamtheme'),
        'remove_featured_image' => __('Xóa ảnh đại diện', 'canhcamtheme'),
        'use_featured_image'    => __('Sử dụng làm ảnh đại diện', 'canhcamtheme'),
        'insert_into_item'      => __('Chèn vào', 'canhcamtheme'),
        'uploaded_to_this_item' => __('Tải lên', 'canhcamtheme'),
        'items_list'            => __('Danh sách', 'canhcamtheme'),
        'items_list_navigation' => __('Điều hướng', 'canhcamtheme'),
        'filter_items_list'     => __('Lọc', 'canhcamtheme'),
    );
    $args = array(
        'label'                 => __('Tuyển dụng', 'canhcamtheme'),
        'description'           => __('Quản lý tin tuyển dụng', 'canhcamtheme'),
        'labels'                => $labels,
        'supports'              => array('title', 'thumbnail', 'editor'),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-businessman',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
        'rewrite'               => array('slug' => 'recruitment'),
    );
    register_post_type('recruitment', $args);
}
add_action('init', 'register_recruitment_post_type', 0);
