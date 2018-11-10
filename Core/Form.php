<?php
namespace Core;

class Form {
    private $_POST, $_form_content;
    public function __construct($post=false) {
        if($post) $this->_POST = $post;
    }


    public function add_warnings($warnings) {
        if($this->_POST) {
            $this->_form_content .= $warnings;
        }
    }

    public function get_form($action = "", $method = "post", $id = null, $enctype = null, $target = null) {

        $form_attributes = "action=\"$action\" method=\"$method\"";
        if($id) {
            switch ($id) {
                case '-':
                    $form_attributes .= " ";
                    break;
                default:
                    $form_attributes .= " id=\"form_$id\"";
                    break;
            }
        }

        if($enctype) {
            switch ($enctype) {
                case 'upload':
                    $form_attributes .= " enctype=\"multipart/form-data\"";
                    break;
                case 'text':
                    $form_attributes .= " enctype=\"text/plain\"";
                    break;
                case 'url':
                    $form_attributes .= " enctype=\"application/x-www-form-urlencoded\"";
                    break;
                case "-":
                    $form_attributes .= " ";
                    break;
            }
        }
        return "<form $form_attributes>". $this->_form_content ."</form>\n";
    }

    public function start_box($id, $label, $direction = "top-to-bottom") {
        if($direction == "top-to-bottom") {
            $groupClass = "";
        }elseif($direction == "left-to-right") {
            $groupClass = "input-group";
        }

        $this->_form_content .= "<label>$label : </label>";
        $this->_form_content .= "<div id = \"$id\" class =\"form-control mb-3 $groupClass\">";
    }

    public function end_box() {
        $this->_form_content .= "</div>";
    }


    public function add_text($name, $label, $placeholder = null, $value = null, $autocomplete = "true") {
        $input_attributes = "\n\t\t<input class=\"form-control\" type=\"text\" name=\"". $name ."\" id=\"". $name ."\"";

        if($this->_POST) {
            $input_attributes .= " value=\"". $this->_POST[$name] ."\"";
        }elseif($value){
            $input_attributes .= " value=\"". $value ."\"";
        }

        if($placeholder) {
            $input_attributes .= " placeholder=\"". $placeholder ."\"";
        }

        $input_attributes .= " autocomplete=\"$autocomplete\"/>";
        $input = "\n\t<div class=\"form-group\">";
        $input .= "\n\t\t <label for=\"". $name ."\">" . $label . " : </label>";
        $input .= $input_attributes;
        $input .= "\n\t</div>\n";
        $this->_form_content .= $input;
    }

    public function add_textarea($name, $label, $placeholder = null, $value = null) {
        $input_attributes = "\n\t\t<textarea class=\"form-control\" name=\"". $name ."\" id=\"". $name ."\"";

        if($placeholder) {
            $input_attributes .= " placeholder=\"". $placeholder ."\"";
        }
        $input_attributes .= ">";

        $input = "\n\t<div class=\"form-group\">";
        $input .= "\n\t\t <label for=\"". $name ."\">" . $label . " : </label>";
        if($this->_POST) {
            $input .= $input_attributes . $this->_POST[$name] ."</textarea>";
        }elseif($value){
            $input .= $input_attributes . $value . "</textarea>";
        }

        $input .= "\n\t</div>\n";
        $this->_form_content .= $input;
    }

    public function add_password($name, $label, $placeholder = null, $default_char_count = 6) {
        if($this->_POST) {
            $value = $this->_POST[$name];
        }else{
            $value = "";
            for($i=0;$i<$default_char_count;$i++)
                $value .= "*";
        }

        $input_attributes = "\n\t\t<input class=\"form-control\" type=\"password\" name=\"". $name ."\" id=\"". $name ."\" value=\"". $value ."\"";
        if($placeholder) {
            $input_attributes .= " placeholder=\"". $placeholder ."\"";
        }
        $input_attributes .= "/>";
        $input = "\n\t<div class=\"form-group\">";
        $input .= "\n\t\t <label for=\"". $name ."\">" . $label . " : </label>";
        $input .= $input_attributes;
        $input .= "\n\t</div>\n";
        $this->_form_content .= $input;
    }

    public function add_date($name, $label, $value = null ) {
        $input_attributes = "\n\t\t<input class=\"form-control\" type=\"date\" name=\"". $name ."\" id=\"". $name ."\"";

        if($this->_POST) {
            $input_attributes .= " value=\"". $this->_POST[$name] ."\"";
        }elseif($value){
            $input_attributes .= " value=\"". $value ."\"";
        }

        $input_attributes .= "/>";
        $input = "\n\t<div class=\"form-group\">";
        $input .= "\n\t\t <label for=\"". $name ."\">" . $label . " : </label>";
        $input .= $input_attributes;
        $input .= "\n\t</div>\n";
        $this->_form_content .= $input;
    }

    public function add_time($name, $label, $value = null ) {
        $input_attributes = "\n\t\t<input class=\"form-control\" type=\"time\" name=\"". $name ."\" id=\"". $name ."\"";
        if($this->_POST) {
            $input_attributes .= " value=\"". $this->_POST[$name] ."\"";
        }elseif($value){
            $input_attributes .= " value=\"". $value ."\"";
        }

        $input_attributes .= "/>";
        $input = "\n\t<div class=\"form-group\">";
        $input .= "\n\t\t <label for=\"". $name ."\">" . $label . " : </label>";
        $input .= $input_attributes;
        $input .= "\n\t</div>\n";
        $this->_form_content .= $input;
    }


    public function start_select($name, $label, $multiple = false, $size = 3) {
        $input_attributes = "\n\t\t<select class=\"form-control mb-3\" name=\"". $name ."\" id=\"". $name ."\"";

        if($multiple) {
            $input_attributes .= " multiple";
            if($size) {
                $input_attributes .= " size=\"". $size ."\"";
            }
        }

        $input_attributes .= ">";

        $input = "\n\t<div class=\"form-group\">";
        $input .= "\n\t\t<label for=\"". $name ."\">" . $label . " : </label>";
        $input .= $input_attributes;
        $input .= "\n\t</div>\n";
        $this->_form_content .= $input;
    }

    public function end_select() {
        $this->_form_content .= "</select>";
    }

    public function add_option($select_name, $value, $label, $selected = false) {
        $option = "<option value = \"$value\"";

        if($this->_POST) {
            if(isset($this->_POST[$select_name])) {
                $val = $this->_POST[$select_name];
                if($value == $val) {
                    $option .= " selected";
                }
            }
        }else{
            if($selected) $option .= " selected";
        }

        $option .= ">$label</option>";
        $this->_form_content .=  $option;
    }


    public function add_checkbox($name, $id, $label, $value, $checked = false) {
        $input_attributes = "\n\t\t\t<input class=\"form-check-input  p-3\" type=\"checkbox\" name=\"". $name ."\" id=\"". $id ."\" value=\"$value\"";
        $tempName = rtrim($name, "[]");
        if($this->_POST) {
            if(isset($this->_POST[$tempName])){
                $values = $this->_POST[$tempName];
                foreach($values as $v) {
                    if($v == $value) {
                        $input_attributes .= " checked";
                    }
                }
            }
        }else{
            if($checked) $input_attributes .= " checked";
        }

        $input_attributes .= "> $label";

        $input = "\n\t<div class=\"form-check mr-4\">";
        $input .= "\n\t\t<label class=\"form-check-label\" for=\"". $id ."\">";
        $input .= $input_attributes;
        $input .= "\n\t\t</label>\n\t</div>\n";
        $this->_form_content .= $input;
    }

    public function add_radio($name, $id, $label, $value, $checked = false) {
        $input_attributes = "\n\t\t\t<input class=\"form-check-input p-3\" type=\"radio\" name=\"". $name ."\" id=\"". $id ."\" value=\"$value\"";

        if($this->_POST) {

            if(isset($this->_POST[$name])) {
                $val = $this->_POST[$name];
                if($value == $val) {
                    $input_attributes .= " checked";
                }
            }
        }else{
            if($checked) $input_attributes .= " checked";
        }

        $input_attributes .= ">  $label";
        $input = "\n\t<div class=\"form-check mr-4\">";
        $input .= "\n\t\t<label class=\"form-check-label\" for=\"". $id ."\">";
        $input .= $input_attributes;
        $input .= "\n\t\t</label>\n\t</div>\n";
        $this->_form_content .= $input;
    }

    public function add_image() {

    }

    public function add_file($name, $label, $value = null, $type = "text") {
        $input_attributes = "\n\t\t\t<input class=\"form-control\" type = \"file\" name=\"".$name."\" id=\"".$name."\">";

        $input = "<div class=\"form-group mb-3\">";
        $input .= "<label class=\"w-100\">" . $label ." : </label>";

        if($value) {

            switch ($type) {
                case 'image':
                    $input .= "<label class=\"w-100\"><img src=\"" . $value ."\" width=\"250px\"></label>";
                    break;
                default:
                    $input .= "<label class=\"w-100 bg-light border p-2\">" . $value . "</label>";
                    break;
            }
            $input .= "<label class=\"w-100 text-secondary\">veya değiştir</label>";
        }
        $input .= $input_attributes;
        $input .= "</div>";

        $this->_form_content .= $input;

        /*
        $this->_form_content .= "
            <div class=\"form-group\">
                <label class=\"w-100\">dsa</label>
                <label class=\"w-100 text-secondary\">dsa</label>
                <label for=\"file\">Select list:</label>
                <input type = \"file\" class = \"form-control" id = \"file\">
            </div>
        ";
        */
    }

    public function add_link($href, $label, $class = false, $target = false) {
        $link = "<a href=\"". $href ."\"";
        if($target) {
            $link .= " target = \"" . $target . "\"";
        }
        $link .= " class = \"mb-3";
        if($class) {
            $link .=  " ". $class;
        }
        $link .= "\"";

        $link .= ">" . $label ."</a>";

        $this->_form_content .= $link;
    }

    public function add_submit($value, $align  = "left", $w = false) {
        $width = null;
        if($w) {
            $width = "w-".$w;
        }
        $input_attributes = "\n\t\t<input class=\"btn btn-primary $width\" type=\"submit\" value=\"$value\"/>";

        $input = "\n\t<div class=\"form-group text-$align\">";
        $input .= $input_attributes;
        $input .= "\n\t</div>\n";
        $this->_form_content .= $input;
    }

    public function start_div($sm = 12, $md = 12, $lg = 12, $xl = 12) {
        $this->_form_content .= "<div class = \"float-left col-sm-$sm col-md-$md col-lg-$lg col-xl-$xl\">";
    }

    public function end_div() {
        $this->_form_content .= "</div>";
    }
}
