<section class="sidebar">
  <!-- sidebar menu: : style can be found in sidebar.less -->
  <ul class="sidebar-menu" data-widget="tree">
    <?php
        // chek settingan tampilan menu
        $setting = $this->db->get_where('tbl_setting', array('id_setting' => 1))->row_array();
        if ($setting['value'] == 'ya') {
            // cari level user
            $id_user_level = $this->session->userdata('id_user_level');
            $sql_menu = "SELECT * FROM tbl_menu 
            WHERE id_menu in(select id_menu from tbl_hak_akses where id_user_level='".$id_user_level."') and is_main_menu=0 and is_aktif='y' ORDER BY title";
        } else {
            $sql_menu = "select * from tbl_menu where is_aktif='y' and is_main_menu=0 ORDER BY title";
        }

        $main_menu = $this->db->query($sql_menu)->result();

        foreach ($main_menu as $menu) {
            // chek is have sub menu
            $this->db->where('is_main_menu', $menu->id_menu);
			$this->db->order_by('title', 'ASC');
            $this->db->where('is_aktif', 'y');
            $submenu = $this->db->get('tbl_menu');
            if ($submenu->num_rows() > 0) {
                // display sub menu
                echo "<li class='treeview'>
                        <a href='#'>
                            <i class='$menu->icon'></i> <span>" . $menu->title . "</span>
                            <span class='pull-right-container'>
                                <i class='fa fa-angle-left pull-right'></i>
                            </span>
                        </a>
                        <ul class='treeview-menu' style='display: none;'>";
                foreach ($submenu->result() as $sub) {
                    echo "<li>" . anchor($sub->url, "<i class='$sub->icon'></i> " . $sub->title) . "</li>";
                }
                echo " </ul>
                    </li>";
            } else {
                // display main menu
                echo "<li "; 
					if($this->uri->segment(1)=="" . $menu->url . "") {
				 		echo 'class="active"';
					}
				echo	">";
				//if($this->uri->segment(1)=="menu_name"){echo 'class="active"';}
                echo anchor($menu->url, "<i class='" . $menu->icon . "'></i><span> " . $menu->title  . "</span>" );
                echo "</li>";
            }
        }
        ?>
    <li><?php echo anchor('auth/logout', "<i class='fa fa-sign-out'></i><span>LOGOUT</span>"); ?></li>
  </ul>
</section>
<!-- /.sidebar -->