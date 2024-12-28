 <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Wizzard setup 
          <small></small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Wizzard</a></li>
          <li class="">Setup</li>
          <li class="active">Permissions & Requirements</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="box box-warning">
        

          <div class="box-body">

          <div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-yellow">
              <div class="widget-user-image">
                <img class="img-circle" src="<?= BASE_ASSET . 'img/folder.jpg'; ?>" alt="User Avatar">
              </div>
              <!-- /.widget-user-image -->
              <h3 class="widget-user-username">Directory permissions & requirements</h3>
            </div>
          </div>
          <!-- /.widget-user -->

          <?php if (!$directory_requirement_is_ok): ?>
            <div class="callout callout-danger">
              <h4>Warning!</h4>
              <p>there are some files can not be read by the system, make sure the file in write mode 0666.</p>
            </div>
          <?php endif; ?>
            <table width="100%" class="table table-striped">
              <thead>
                <tr>
                  <th width="80%">Directory & Permissions</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>../application/config/database.php is writeable</td>
                  <td>
                    <?php if ($database_is_writable): ?>
                    <span class="badge bg-green">success</span>
                    <?php else: ?>
                    <span class="badge bg-orange">warning</span>
                    <?php endif; ?>
                    </td>
                </tr>
                <tr>
                  <td>../application/config/config.php is writeable</td>
                  <td>
                    <?php if ($config_is_writable): ?>
                    <span class="badge bg-green">success</span>
                    <?php else: ?>
                    <span class="badge bg-orange">warning</span>
                    <?php endif; ?>
                  </td>
                </tr>
                <tr>
                  <td>../application/migrations/001_cicool.php is writeable</td>
                  <td>
                    <?php if ($migrations_is_writable): ?>
                    <span class="badge bg-green">success</span>
                    <?php else: ?>
                    <span class="badge bg-orange">warning</span>
                    <?php endif; ?>
                  </td>
                </tr>
              </tbody>
            </table>

             <div class="box box-widget widget-user-2" style="margin-top: 20px;">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-yellow">
              <div class="widget-user-image">
                <img class="img-circle" src="<?= BASE_ASSET . 'img/server.jpg'; ?>" alt="User Avatar">
              </div>
              <!-- /.widget-user-image -->
              <h3 class="widget-user-username">Server requirements</h3>
            </div>
          </div>
          <!-- /.widget-user -->

          <?php if (!$server_requirement_is_ok): ?>
            <div class="callout callout-danger">
              <h4>Warning!</h4>
              <p>there are several server systems that are not fulfilled, please solve this problem.</p>
            </div>
          <?php endif; ?>
            <table width="100%" class="table table-striped">
              <thead>
                <tr>
                  <th>Server Requirements</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                               
                <tr>
                  <td width="80%">You have PHP 5.5 (or greater; Current Version: <b><?= phpversion(); ?></b>)</td>
                  <td>
                    <?php if ($php_version_is_greater): ?>
                    <span class="badge bg-green">success</span>
                    <?php else: ?>
                    <span class="badge bg-orange">warning</span>
                    <?php endif; ?>
                  </td>
                </tr>    
                <tr>
                  <td>You have MySQL 4.1.13 (or greater; Current Version: <b><?= $mysql_version_number; ?></b>)</td>
                  <td>
                    <?php if ($mysql_version_is_greater): ?>
                    <span class="badge bg-green">success</span>
                    <?php else: ?>
                    <span class="badge bg-orange">warning</span>
                    <?php endif; ?>
                  </td>
                </tr>
                <tr>
                  <td>You have the mysqli extension</td>
                  <td>
                    <?php if ($mysqli_extension_installed): ?>
                    <span class="badge bg-green">success</span>
                    <?php else: ?>
                    <span class="badge bg-orange">warning</span>
                    <?php endif; ?>
                  </td>
                </tr>
                <tr>
                  <td>You have the session extension</td>
                  <td>
                    <?php if ($session_extension_installed): ?>
                    <span class="badge bg-green">success</span>
                    <?php else: ?>
                    <span class="badge bg-orange">warning</span>
                    <?php endif; ?>
                  </td>
                </tr>
                <tr>
                  <td>You have the mcrypt extension</td>
                  <td>
                    <?php if ($mcrypt_extension_installed): ?>
                    <span class="badge bg-green">success</span>
                    <?php else: ?>
                    <span class="badge bg-orange">warning</span>
                    <?php endif; ?>
                  </td>
                </tr>
              </tbody>
            </table>
            <hr>
            <div class="col-md-2">
            </div>
            <div class="col-md-8">
              <center>
                <div class="step">
                  <div class="line">
                    <div class="round-step"></div>
                    <div class="round-step" style="margin-left: 100px !important"></div>
                    <div class="round-step" style="margin-left: 200px !important"></div>
                  </div>
                </div>
              </center>
            </div>
            <div class="col-md-2" style="padding-left: 0px !important; ">
              <a class="btn bg-green margin btn-lg btn-block" href="<?= BASE_URL . 'wizzard/setup/2'; ?>" >Next</a>
            </div>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->

      </section>
      <!-- /.content -->