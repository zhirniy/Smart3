<?php
//Функция отображения списка артистов для редактирования
//Связываемся с базой данных, получаем данные об артисте и выводим информацию в таблицу
function network_list() {
    ?>
    <link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/artist/style-admin.css" rel="stylesheet" />
    <div class="wrap">
        <h2>Артисты</h2>
        <div class="tablenav top">
            <div class="alignleft actions">
                <a href="<?php echo admin_url('admin.php?page=network_create'); ?>">Добавить сеть</a>
            </div>
            <br class="clear">
        </div>
        <?php
        global $wpdb;
        $table_name = $wpdb->prefix . "public_network";

        $rows = $wpdb->get_results("SELECT * from $table_name");
        ?>
        <table class='wp-list-table widefat fixed striped posts'>
            <tr>
                <th class="manage-column ss-list-width">Номер</th>
                <th class="manage-column ss-list-width">Название</th></th>
                <th class="manage-column ss-list-width">Ссылка</th></th>
                <th class="manage-column ss-list-width">Иконка</th></th>
               
                                <th>&nbsp;</th>
            </tr>
            <?php foreach ($rows as $row) { ?>
                <tr>
                    <td class="manage-column ss-list-width"><?php echo $row->id; ?></td>
                    <td class="manage-column ss-list-width"><?php echo $row->name; ?></td>
                    <td class="manage-column ss-list-width"><?php echo '<img width="100" height="100"  src="http://p96278i3.beget.tech/WordPress/wp-content/uploads/2018/02/'.$row->foto .'"/>';?></td> 
                    <td class="manage-column ss-list-width"><?php echo $row->link; ?></td>
                    
                </tr>
            <?php } ?>
        </table>
    </div>
    <?php
}