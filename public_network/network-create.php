<?php
//Страница создания записи
//Выводим форму и данные с нёё записываем в базу данных
function network_create() {
    $name_network = $_POST["name_network"];
    $link = $_POST["link"];
    $foto = $_FILES['my_image_upload'];
     $foto = $foto['name'];
    
   
    //insert
    if (isset($_POST['insert'])) {
        global $wpdb;
        $table_name = $wpdb->prefix."public_network";

        $wpdb->insert(
                $table_name, //table
                array( 
                'name' => $name_network,
                'foto' => $foto,
                'link' => $link,
                
                ), //data
                array('%s', '%s') //data format			
        );
        $message.="Сеть добавлена";
     
      $attachment_id = media_handle_upload( 'my_image_upload', $_POST['foto_id'] );

	if ( is_wp_error( $attachment_id ) ) {
		$message.=" Без фото!";
	} else {
		$message. "Фото добавлено!";
	}

  
    }
    ?>
    <link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/public_network/style-admin.css" rel="stylesheet" />
    <div class="wrap">
        <h2>Добавить сеть</h2>

        <?php if (isset($message)): ?><div class="updated"><p><?php echo $message; ?></p></div><?php endif; ?>
        <form method="post" enctype="multipart/form-data" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
            <p></p>
            <table class='wp-list-table widefat fixed'>

                    <th class="ss-th-width">Название сети</th>
                    <td><input type="text" id="name_network" name="name_network" value="<?php echo $name_network; ?>" class="ss-field-width" pattern="[а-яА-Яa-zA-Z-]{2,}" required/></td>
                </tr>
                    <tr>
                   
                </tr>
                                    <tr>
                                                        <th class="ss-th-width">Ссылка на соцсеть</th>
                    <td><input type="link" name="link" value="<?php echo  $link; ?>" class="ss-field-width" required /></td>
                </tr>
                <tr>
                    <th class="ss-th-width">Иконка соцсети</th>
                    <td><input type="file" name="my_image_upload" id="my_image_upload" multiple="false"/>
                	<input type="hidden" name="foto_id" value="0" /></td>
                	
                <!--	<td><input type="text" name="id_"  />-->
                	<?php wp_nonce_field( 'my_image_upload', 'my_image_upload_nonce' ); ?>
                </tr>
                
            </table>
            <input type='submit' name="insert" value='Сохранить' class='button'>
        </form>
    </div>
    <?php
}