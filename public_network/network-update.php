<?php
//функция обновления записи. Получаем в форму текущую запись из базы. Обновляем её и отправляем с формы запрос на обновление записи в базе данных
function network_update() {
    global $wpdb;
    $table_name = $wpdb->prefix . "public_network";
    $id = $_GET["id"];
    $name = $_POST["name"];
    $foto = $_FILES['my_image_upload'];
    $foto = $foto['name'];
    $link = $_POST["link"];
   
//update
    if (isset($_POST['update'])) {
        $wpdb->update(
                $table_name, //table
                array('name' => $name,
                'foto' => $foto,
                'link'=> $link
                ), //data
                array('ID' => $id), //where
                array('%s'), //data format
                array('%d') //where format
        );
         $attachment_id = media_handle_upload( 'my_image_upload', $_POST['foto_id'] );
    }
//delete
    else if (isset($_POST['delete'])) {
        $wpdb->query($wpdb->prepare("DELETE FROM $table_name WHERE id = %d", $id));
    } else {//selecting value to update	
        $network  = $wpdb->get_results($wpdb->prepare("SELECT * from $table_name where id=%d", $id));
        foreach ($network as $s) {
            $name = $s->name;
            $foto = $s->foto;
            $link = $s->link;
            
        }
    }
    ?>
    <link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/public_network/style-admin.css" rel="stylesheet" />
    <div class="wrap">
        <h2>Сети</h2>

        <?php if ($_POST['delete']) { ?>
            <div class="updated"><p>Артист удалён</p></div>
            <a href="<?php echo admin_url('admin.php?page=network_list') ?>">&laquo; Вернуться к списку сетей</a>

        <?php } else if ($_POST['update']) { ?>
            <div class="updated"><p>Данные сети обновлены</p></div>
            <a href="<?php echo admin_url('admin.php?page=network_list') ?>">&laquo; Вернуться к списку сетей</a>

        <?php } else { ?>
            <form method="post" enctype="multipart/form-data" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
                <table class='wp-list-table widefat fixed'>
                    <tr><th>Название соцсети</th><td><input type="text" name="name" pattern="[а-яА-Яa-zA-Z-]{2,}" required value="<?php echo $name; ?>"/></td></tr>
                    <tr><th>Иконка соцсети</th>
                       <!-- <input type="text" name="foto" value="<?php //echo $foto; ?>"/> -->
                        <td><input type="file" name="my_image_upload" id="my_image_upload" multiple="false"/>
                	<input type="hidden" name="foto_id" value="0" /></td>
                        </tr>
                    
                    <tr><th>Ссылка на соцсеть</th><td><input type="text" name="link" required value="<?php echo $link; ?>"/></td></tr>
                </table>
                <input type='submit' name="update" value='Обновить' class='button'> &nbsp;&nbsp;
                <input type='submit' name="delete" value='Удалить' class='button' onclick="return confirm('Удалить сеть?')">
            </form>
        <?php } ?>

    </div>
    <?php
}