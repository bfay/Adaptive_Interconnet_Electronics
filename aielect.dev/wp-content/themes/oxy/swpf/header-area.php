<?php

class Oxy_header_area{    
    static $sds_header_section = array();
    
    static function populate_header_area(){
        global $smof_data;
        $logo_pos = $smof_data->oxy_general_settings['oxy_logo_position'];
        $search_pos = $smof_data->oxy_general_settings['oxy_search_bar_position'];
        $pos_arr = array(
                'left' => 0 , 
                'center' => 1,
                'right' => 2
            );
        
        $logo_markup = '<div id="logo">
				<a href="'.home_url().'"><img src="'.$smof_data->oxy_general_settings['oxy_sitelogo'].'" title="OXY" alt="OXY" /></a>
			</div>';
        $search_markup = '<div id="search">      
                        <form role="search" method="get" id="searchform" class="searchform" action="'.home_url().'">      
                            <div class="button-search"></div>
                            <input type="text" name="s" id="s" placeholder="'.__('Search','oxy').'" value="" />                
                        </form>      
                    </div>';
        
        foreach($pos_arr as $pos => $val){
            self::$sds_header_section[$val] = '';
            if($pos == $logo_pos){
                self::$sds_header_section[$val] .= $logo_markup;
            }
            if($pos == $search_pos){
                if($smof_data->oxy_general_settings['oxy_search_bar_status'] == 1)
                    self::$sds_header_section[$val] .= $search_markup;
                else 
                    self::$sds_header_section[$val] .= '';
            }
            
        }
        
    }
    
}
if(!is_admin())
    Oxy_header_area::populate_header_area();