<?php
//Функция создания shortcode. Регистрируем shortcode и определяем параметры вывода записей
//Подробнее в файле README
add_shortcode( 'network', 'network_func' );

function network_func( $atts ){
$params = array(
	'posts_per_page' => 10 // этот параметр не обязателен, так как get_posts() по умолчанию и так выводит 5 постов
);
$count=0;
$recent_posts_array = get_posts( $params );
if($recent_posts_array!==null){
    echo '<forma><table><tr><th>#</th><th>ID</th><th>Заголовок</th><th>Статус</th><th>Уникальный номер</th></tr>';
foreach( $recent_posts_array as $recent_post_single ) :
   if($count<11){
    echo '<tr><td>'.++$count.'</td>';
   }
   else{
       break;
   }
    echo '<td>'.$recent_post_single->ID.'</td>';
	echo '<td>'.'<a href="' . get_permalink( $recent_post_single ) . '">' . $recent_post_single->post_title . '</a></td>'; // выводим ссылку
 
    if($recent_post_single->post_status=='publish'){
        echo '<td><input type="checkbox" checked></td>';
    }
    else{
        echo '<td><input type="checkbox"></td>';
    }
	echo '<td><input type="text" name="'.$count.'" required></td></tr>';
endforeach;
    echo '<tr><td colspan="2"><input type="submit" value="submit"></td></tr>';
    echo '</table></forma>';
}
wp_reset_postdata(); // сбрасывает $post

}

?>