<?php

//добавление своего метабокса start
function wph_add_metabox(){
    add_meta_box('before_publish', 'Метабокс', 
    'wph_metabox_content', 'post', 'side', 'high');
}
function wph_metabox_content() {
    global $wpdb;
    $table_name = $wpdb->prefix . "public_network";
    $rows = $wpdb->get_results("SELECT * from $table_name");
    foreach ($rows as $row) {
   ?>
    <label><?php echo $row->link; ?></label><input id="checkBox" type="checkbox" value="<?php echo $row->link; ?>">
    
<?php } }
add_action('add_meta_boxes', 'wph_add_metabox');
//добавление своего метабокса end*/


?>