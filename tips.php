<?php
/*
 * Plugin Name: Tips
 * Version: 1.0
 * Plugin URI: http://icode.it.tc/
 * Description: An extreamly useful widget which previews tips you write.
 * Author: Nulled_Icode
 * Author URI: http://icode.it.tc/
 */
 
 /*
 
     This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 

 
 */
 
class Tips extends WP_Widget
{
 // Parent::WP_WIDGET !_!
    function Tips(){
    $widget_ops = array('classname' => 'widget_tips', 'description' => __( "An extreamly useful widget which previews tips you write.") );
    $control_ops = array('width' => 300, 'height' => 300);
    $this->WP_Widget('tips', __('Tips'), $widget_ops, $control_ops);
    }


    function widget($args, $instance){
      extract($args);
      $title = apply_filters('widget_title', empty($instance['title']) ? '&nbsp;' : $instance['title']);

	  if(!empty($instance['tips'])){
	  $tips_array = explode("\n",$instance['tips']);
	  $picked = $tips_array[mt_rand(0,count($tips_array)-1)];
	  }else{
	  $picked = "Commenting is not a crime.";
	  }
	  
   
      echo $before_widget;

      if ( $title )
      echo $before_title . $title . $after_title;

      echo '<div style="text-align:center;padding:10px;">' . $picked. '</div>';

      echo $after_widget;
  }
    function update($new_instance, $old_instance){
      $instance = $old_instance;
      $instance['title'] = strip_tags(stripslashes($new_instance['title']));
      $instance['tips'] = strip_tags(stripslashes($new_instance['tips']));
    return $instance;
  }
    function form($instance){
      $instance = wp_parse_args( (array) $instance, array('title'=>'', 'tips'=>'' ));
      $title = htmlspecialchars($instance['title']);
      $tips = htmlspecialchars($instance['tips']);
      echo '<p style="text-align:right;"><label for="' . $this->get_field_name('title') . '">' . __('Title:') . ' <input style="width: 200px;" id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" type="text" value="' . $title . '" /></label></p>';
      echo '<p style="text-align:right;"><label for="' . $this->get_field_name('tips') . '">' . __('Each line goes a tip:') . '<br> <textarea style="width: 200px;" id="' . $this->get_field_id('tips') . '" name="' . $this->get_field_name('tips') . '"  >'.$tips.'</textarea></label></p>';
	  
  }

}

  function TipsInit() {
  register_widget('Tips');
  }
  add_action('widgets_init', 'TipsInit');
?>
