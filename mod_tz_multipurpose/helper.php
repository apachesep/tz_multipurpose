<?php
/**
 * Created by PhpStorm.
 * User: Thuong
 * Date: 5/7/14
 * Time: 10:40 AM
 */

defined('_JEXEC') or die();

class modTZMultipurposeHelper{

    static public function getField($field) {
        $db		= JFactory::getDbo();
        $query	= $db->getQuery(true);
        $query -> select('*');
        $query -> from('#__tz_multipurpose_fields');
        $query -> where('id = '.$field);
        $db -> setQuery($query);
        $items  = $db -> loadObjectList();

        foreach($items as $i => $v_field) {

        }
        return $v_field;
    }

    static public function getFieldValue($value_field,$value,$option_stm) {

        $a = json_decode($value_field,true);
        $arr_value = explode(',',$value);
        $html = '';

        $html .= '<ul class="tz_multi_list">';
        foreach($arr_value as $key => $value_arr) {
            foreach($a as $j => $item) {
                if($value_arr == $item['name']) {
                    $html .= '<li>';
                    if($option_stm == 2 && ($item['image'] != "")) {
                        $html .= '<img src="'.$item['image'].'" alt="'.$value_arr.'" />';
                        $html .= '<span>'.$item['name'].'</span>';
                    }elseif($option_stm == 1 && ($item['image'] != "")) {
                        $html .= '<img src="'.$item['image'].'" alt="'.$value_arr.'" />';
                    }else {
                        $html .= '<span>'.$item['name'].'</span>';
                    }
                    $html .= '</li>';
                }
            }
        }
        $html .= '</ul>';

        return $html;
    }

    static public function getFieldGroup($id_group,$id_field_avd) {
        $query_adv  = '';
        if($id_field_avd != '') {
            $query_adv  = ' AND f.id IN ('.$id_field_avd.')';
        }
        $db		= JFactory::getDbo();
        $query  = $db -> getQuery(true);
        $query -> select('f.*');
        $query -> from('#__tz_multipurpose_fields AS f');
        $query -> join('LEFT','#__tz_multipurpose_groupfield AS x ON f.id=x.fieldsid');
        $query -> join('INNER','#__tz_multipurpose_groups AS fg ON fg.id=x.groupid');
        $query -> where('fg.id = '.$id_group.' AND f.published = 1'.$query_adv);
        $query -> order('f.ordering ASC');
        $db    -> setQuery($query);
        $list_field   = $db -> loadObjectList();
        $arr_field_id = array();
        $i = 0;
        foreach($list_field as $k => $v_list_field) {
            $arr_field_id[$i] = $v_list_field -> id;
            $i++;
        }
        return $arr_field_id;
    }

    public static function getList(&$params){
        $multi   = $params -> get('multipurpose');
        foreach($multi as $key => $arr) {
            foreach($arr as $n => $value){
                if($n != 'group'){
                        if(is_numeric($n)) {
                            $field = self::getField($n);
//                            $multi -> type  = $field -> type;
                        }
                    }
            }
        }
        return $multi;
    }

    public static function getlink($arr,$a) {
        $get_a_t = $a.'_text';
        $get_a_l = $a.'_link';
        $get_a_o = $a.'_open';
        $title_link = $arr -> $get_a_t;
        $link       = $arr -> $get_a_l;
        $link_open  = $arr -> $get_a_o;
        $link_o = 'target="_self"';
        if($link_open == 'Same Window') {
            $link_o = 'target="_blank"';
        }
        $field_a = self::getField($a);
        $value      = $field_a -> value;
        $value      = json_decode($value);
        $value      = $value[0];
        $value_img  = $value->image;
        $link_option    = new stdClass();
        $link_option      -> link         = $link;
        $link_option      -> link_o       = $link_o;
        $link_option      -> title_link   = $title_link;
        $link_option      -> img          = $value_img;

        return $link_option;
    }

    // isotope
    // function get value field isotope
    public static function getValueFIS ($arr,$arr_filter) {
        $value_fis = '';
        foreach($arr_filter as $key => $value) {
            
        }
    }

    // function get value in params follow fields
    public static function getValueFields($arr,$get_field_id) {
        $value = $arr->$get_field_id;
        return $value;
    }

    // function get value in params follow list fields
    public static function getValueFieldsIsotope($arr,$arr_filter) {
        $count_arrf  = count($arr_filter);
        $value_filter = array();
        if($count_arrf > 1) {
            foreach($arr_filter as $key => $value) {
                $value_filter[]  =   $arr -> $value;
            }
        }else {
            $value_filter[]  =   $arr -> $value;
        }
        $value_filter   = implode(',',$value_filter);
        $value_filter   = str_replace(',',' ',$value_filter);

        return $value_filter;
    }

    // isotope
    // get value
}