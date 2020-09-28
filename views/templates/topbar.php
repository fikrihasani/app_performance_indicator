<!-- TOP BAR -->
<div class="layout-header">
        <div class="navbar navbar-default">
          <div class="navbar-header">
            <a class="navbar-brand navbar-brand-center" href="#">
              <p style="font-size:10px; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: wheat; font-weight: bold;">PT. Angkasa Pura Supports Semarang</p>
            </a>
            <button class="navbar-toggler visible-xs-block collapsed" type="button" data-toggle="collapse" data-target="#sidenav">
              <span class="sr-only">Toggle navigation</span>
              <span class="bars">
                <span class="bar-line bar-line-1 out"></span>
                <span class="bar-line bar-line-2 out"></span>
                <span class="bar-line bar-line-3 out"></span>
              </span>
              <span class="bars bars-x">
                <span class="bar-line bar-line-4"></span>
                <span class="bar-line bar-line-5"></span>
              </span>
            </button>
            <button class="navbar-toggler visible-xs-block collapsed" type="button" data-toggle="collapse" data-target="#navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="arrow-up"></span>
              <span class="ellipsis ellipsis-vertical">
                <img class="ellipsis-object" width="32" height="32" src="img/0180441436.jpg" alt="Teddy Wilson">
              </span>
            </button>
          </div>
          <div class="navbar-toggleable">
            <nav id="navbar" class="navbar-collapse collapse">
              <button class="sidenav-toggler hidden-xs" title="Collapse sidenav ( [ )" aria-expanded="true" type="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="bars">
                  <span class="bar-line bar-line-1 out"></span>
                  <span class="bar-line bar-line-2 out"></span>
                  <span class="bar-line bar-line-3 out"></span>
                  <span class="bar-line bar-line-4 in"></span>
                  <span class="bar-line bar-line-5 in"></span>
                  <span class="bar-line bar-line-6 in"></span>
                </span>
              </button>
  
              <!-- NAVBAR -->
              <ul class="nav navbar-nav navbar-right">
                <li class="hidden-xs hidden-sm">
                  <form class="navbar-search navbar-search-collapsed">
                    <div class="navbar-search-group">
                      <input class="navbar-search-input" type="text" placeholder="Search for people, companies, and more&hellip;">
                      <button class="navbar-search-toggler" title="Expand search form ( S )" aria-expanded="false" type="submit">
                        <span class="icon icon-search icon-lg"></span>
                      </button>
                      <button class="navbar-search-adv-btn" type="button">Advanced</button>
                    </div>
                  </form>
                </li>
                <li class="dropdown hidden-xs">
                  <button class="navbar-account-btn" data-toggle="dropdown" aria-haspopup="true">
                  <img class="rounded" width="36" height="36" src="<?= base_url('assets/upload/profile/') . $user['image']; ?>"><?= $user['nama']; ?>
                    <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu dropdown-menu-right">
                    <li class="divider"></li>
                    <li class="divider"></li> 
                    <li><a href="<?= base_url(); ?>profile">Profile</a></li>
                    <li><a href="<?= base_url(); ?>auth/logout">Sign out</a></li>
                  </ul>
                </li>
                <li class="visible-xs-block">
                  <a href="contacts.html">
                    <span class="icon icon-users icon-lg icon-fw"></span>
                    Contacts
                  </a>
                </li>
                <li class="visible-xs-block">
                  <a href="profile.html">
                    <span class="icon icon-user icon-lg icon-fw"></span>
                    Profile
                  </a>
                </li>
                <li class="visible-xs-block">
                  <a href="login-1.html">
                    <span class="icon icon-power-off icon-lg icon-fw"></span>
                    Sign out
                  </a>
                </li>
              </ul>
            </nav>
          </div>
        </div>
      </div>
      <!-- AKHIR TOOGLE -->