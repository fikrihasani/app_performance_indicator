 <!-- SIDEBAR -->
 <div class="layout-main">
        <div class="layout-sidebar">
          <div class="layout-sidebar-backdrop"></div>
          <div class="layout-sidebar-body">
            <div class="custom-scrollbar">
              <nav id="sidenav" class="sidenav-collapse collapse">
  
                <!-- NAVIGATION -->
                <ul class="sidenav">
                  <li class="sidenav-search hidden-md hidden-lg">
                    <form class="sidenav-form" action="#">
                      <div class="form-group form-group-sm">
                        <div class="input-with-icon">
                          <input class="form-control" type="text" placeholder="Search…">
                          <span class="icon icon-search input-icon"></span>
                        </div>
                      </div>
                    </form>
                  </li>
                <?php if($this->session->userdata('level') == 1 || $this->session->userdata('level') == 2){ ?>
                  <li class="sidenav-item">
                    <a href="<?= base_url(); ?>dashboard" aria-haspopup="true">
                      <span class="sidenav-icon icon icon-home"></span>
                      <span class="sidenav-label">Dashboard</span>
                    </a>
                  </li>
                <?php } ?>
                <?php if($this->session->userdata('level') != 4){ ?>
                  <li class="sidenav-item">
                    <a href="<?= base_url(); ?>complains">
                      <span class="sidenav-icon icon icon-comment"></span>
                      <span class="sidenav-label">Complains</span>
                    </a>
                  </li>
                <?php } ?>
                <?php if($this->session->userdata('level') == 1 || $this->session->userdata('level') == 3){ ?>
                  <li class="sidenav-item">
                      <a href="<?= base_url(); ?>sca_dokumentasi" aria-haspopup="true">
                        <span class="sidenav-icon icon icon-keyboard-o"></span>
                        <span class="sidenav-label">SCA & Dokumentasi</span>
                      </a>
                    </li>
                  <?php } ?>   
                  <?php if($this->session->userdata('level') != 4){ ?>
                  <li class="sidenav-item">
                        <a href="<?= base_url(); ?>kerusakan" aria-haspopup="true">
                          <span class="sidenav-icon icon icon-unlink"></span>
                          <span class="sidenav-label">Kerusakan</span>
                        </a>
                  </li>
                  <?php } ?>
                  <?php if($this->session->userdata('level') == 1 || $this->session->userdata('level') == 3){ ?>
                  <li class="sidenav-item">
                      <a href="<?= base_url(); ?>lost_found" aria-haspopup="true">
                        <span class="sidenav-icon icon icon-search"></span>
                        <span class="sidenav-label">Lost & Found</span>
                      </a>
                  </li>
                  <?php } ?>
                  <?php if($this->session->userdata('level') == 1 || $this->session->userdata('level') == 3){ ?>
                  <li class="sidenav-item">
                    <a href="<?= base_url(); ?>absensi" aria-haspopup="true">
                      <span class="sidenav-icon icon icon-list-alt"></span>
                      <span class="sidenav-label">Absensi</span>
                    </a>
                  </li>
                  <?php } ?>
                <?php if($this->session->userdata('level') == 1){ ?>
                <li class="sidenav-item">
                    <a href="<?= base_url(); ?>user" aria-haspopup="true">
                      <span class="sidenav-icon icon icon-users"></span>
                      <span class="sidenav-label">User</span>
                    </a>
                </li>
                <?php } ?>
                <?php if($this->session->userdata('level') == 1){ ?>
                <li class="sidenav-item">
                    <a href="<?= base_url(); ?>materials" aria-haspopup="true">
                      <span class="sidenav-icon icon icon-gear"></span>
                      <span class="sidenav-label">Materials</span>
                    </a>
               </li>
               <?php } ?>
               <?php if($this->session->userdata('level') == 1){ ?>
                <li class="sidenav-item">
                    <a href="<?= base_url(); ?>pertanyaan" aria-haspopup="true">
                      <span class="sidenav-icon icon icon-question-circle-o"></span>
                      <span class="sidenav-label">Pertanyaan</span>
                    </a>
                </li>
                <?php } ?>
               <?php if($this->session->userdata('level') == 1){ ?>
               <li class="sidenav-item has-subnav">
                  <a href="#" aria-haspopup="true">
                    <span class="sidenav-icon icon icon-map-signs"></span>
                    <span class="sidenav-label">Areas</span>
                  </a>
                  <ul class="sidenav-subnav collapse">
                    <li><a href="<?= base_url(); ?>area">Area</a></li>
                    <li><a href="<?= base_url(); ?>subarea">Sub Area</a></li>
                  </ul>
                </li>
                <?php } ?>
                <?php $t=$this->session->userdata('level');
                if($t == 1 || $t == 4){ ?>
                <li class="sidenav-item">
                    <a href="<?= base_url(); ?>gudang" aria-haspopup="true">
                      <span class="sidenav-icon icon icon-briefcase"></span>
                      <span class="sidenav-label">Stok Gudang</span>
                    </a>
                </li>
                <?php } ?>
                <?php if($this->session->userdata('level') == 1){ ?>
                <li class="sidenav-item">
                    <a href="<?= base_url(); ?>history_system" aria-haspopup="true">
                      <span class="sidenav-icon icon icon-history"></span>
                      <span class="sidenav-label">History System</span>
                    </a>
                </li>
                <?php } ?>
                </ul>
              </nav>
            </div>
          </div>
        </div>
        <!-- AKHIR NAVIGATION -->