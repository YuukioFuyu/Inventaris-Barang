 <!-- Content Header (Page header) -->
 <style type="text/css">
   .info {
    color: #666;
    font-style: italic;
   }

   .required {
    color: #E62020
   }
 </style>
      <section class="content-header">
        <h1>
          Wizzard setup 
          <small></small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Wizzard</a></li>
          <li class="">Setup</li>
          <li class="active">Database Setup</li>
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
                <img class="img-circle" src="<?= BASE_ASSET . 'img/cloud.png'; ?>" alt="User Avatar">
              </div>
              <!-- /.widget-user-image -->
              <h3 class="widget-user-username">Database & Site Configuration</h3>
            </div>
          </div>
          <!-- /.widget-user -->

          <?php if (isset($error) AND !empty($error)): ?>
            <div class="callout callout-danger">
              <h4>Warning!</h4>
              <p><?= $error; ?></p>
            </div>
          <?php endif; ?>
          <style type="text/css">
            .legend-title {
              border-bottom: 1px solid #f39c12 ;
              margin-bottom: 30px;
              margin-top: 30px;
              text-align: center;
            }
             .legend-title .title {
              background: #fff;
              font-size: 18px;
              position: relative;
              padding: 0 10px;
              bottom: -13px;
              color: #646464
             }
          </style>
          <?= form_open('', [
                   'name'    => 'form_wizzard', 
                   'class'   => 'form-horizontal', 
                   'id'      => 'form_wizzard', 
                   'method'  => 'POST'
                   ]); ?>
          <div class="legend-title"><span class="title">Database Configuration</span></div>
              <div class="form-group <?= form_error('database') ? 'has-error' :''; ?>">
                  <label for="database" class="col-md-3 control-label">Database Name <i class="required">*</i></label>

                  <div class="col-sm-6">
                    <input type="text" class="form-control" name="database" id="database" placeholder="Database Name" value="<?= set_value('database', $this->config->item('database', 'database')); ?>">
                    <small class="info help-block">The name of the database you want to connect to.</small>
                  </div>
              </div>
              <div class="form-group <?= form_error('username') ? 'has-error' :''; ?>">
                  <label for="username" class="col-md-3 control-label">Username <i class="required">*</i></label>

                  <div class="col-sm-6">
                      <input type="text" class="form-control" name="username" id="username" placeholder="Username" value="<?= set_value('username', 'root'); ?>">
                      <small class="info help-block">
                        The username used to connect to the database.
                      </small>
                  </div>
              </div>
              <div class="form-group input-password <?= form_error('password') ? 'has-error' :''; ?>">
                  <label for="password" class="col-md-3 control-label">Password </label>

                  <div class="col-sm-6">
                    <div class="input-group col-md-8">
                    <input type="password" class="form-control password input-password" name="password" id="password" placeholder="Password" value="<?= set_value('password', $this->config->item('password', 'database')); ?>">
                      <span class="input-group-btn">
                        <button type="button" class="btn btn-flat show-password"><i class="fa fa-eye eye"></i></button>
                      </span>
                    </div>
                     <small class="info help-block">
                       The password used to connect to the database.
                    </small>
                  </div>
              </div>
              <div class="form-group <?= form_error('hostname') ? 'has-error' :''; ?>">
                  <label for="hostname" class="col-md-3 control-label">Database Host <i class="required">*</i></label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" name="hostname" id="hostname" placeholder="Database Host" value="<?= set_value('hostname', 'localhost'); ?>">
                     <small class="info help-block">
                       The hostname of your database server.
                    </small>
                  </div>
              </div>
              <div class="legend-title"><span class="title">Site Configuration</span></div>
               <div class="form-group <?= form_error('site_name') ? 'has-error' :''; ?>">
                  <label for="site_name" class="col-md-3 control-label">Site Name <i class="required">*</i></label>

                  <div class="col-sm-6">
                    <input type="text" class="form-control" name="site_name" id="site_name" placeholder="Site Name" value="<?= set_value('site_name'); ?>">
                    <small class="info help-block">web or application name you want.</small>
                  </div>
              </div>
               <div class="form-group <?= form_error('site_email') ? 'has-error' :''; ?>">
                  <label for="site_email" class="col-md-3 control-label">Site Email <i class="required">*</i></label>

                  <div class="col-sm-6">
                    <input type="text" class="form-control" name="site_email" id="site_email" placeholder="Site Email" value="<?= set_value('site_email'); ?>">
                    <small class="info help-block">email will be used to access the web administrator.</small>
                  </div>
              </div>

               <div class="form-group input-password <?= form_error('site_password') ? 'has-error' :''; ?>">
                  <label for="site_password" class="col-md-3 control-label">Site Password <i class="required">*</i></label>
                  <div class="col-sm-6">
                    <div class="input-group col-md-8">
                      <input type="password" class="form-control password" type="site_password" name="site_password" id="site_password" placeholder="Site Password" value="<?= set_value('site_password'); ?>">
                      <span class="input-group-btn">
                        <button type="button" class="btn btn-flat show-password"><i class="fa fa-eye eye"></i></button>
                      </span>
                    </div>
                    <small class="info help-block">password will be used to access the web administrator.<br>
                    character length password must be 6 or more.
                    </small>
                  </div>
              </div>


              <hr>
              <div class="col-md-2" style="padding-left: 0px !important; ">
              <a class="btn bg-green margin btn-lg btn-block pull-left" href="<?= BASE_URL . 'wizzard/setup/2'; ?>" >Back</a>
              </div>
              <div class="col-md-8">
                  <center>
                    <div class="step">
                      <div class="line">
                        <div class="round-step success"></div>
                        <div class="round-step success" style="margin-left: 100px !important"></div>
                        <div class="round-step" style="margin-left: 200px !important"></div>
                      </div>
                    </div>
                  </center>
              </div>
              <div class="col-md-2" style="padding-left: 0px !important; ">
                <input type="submit" class="btn bg-green margin btn-lg btn-block" value="Next" >
              </div>

          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->

          <?= form_close(); ?>
      </section>
      <!-- /.content -->

       <script type="text/javascript">
        $(document).ready(function(){
            
            /*show  hide password*/
            $('.input-password').each(function(index, el) {
                var eye = $(this).parent().parent().find('.eye');
                $(this).find('.show-password').mousedown(function() {
                    $(this).parent().parent().find('.password').attr('type', 'text');
                    eye.addClass('fa-eye-slash');
                    eye.removeClass('fa-eye');
                });
                $(this).find('.show-password').mouseup(function() {
                    $(this).parent().parent().find('.password').attr('type', 'password');
                    eye.removeClass('fa-eye-slash');
                    eye.addClass('fa-eye');
                });
            });


            var connection =  $('#hostname, #database, #username, #password');
            var timeout = null;
            function checkConnection() {
                 $.ajax({
                  url: '<?= BASE_URL; ?>/wizzard/check_db_connection',
                  type: 'POST',
                  dataType: 'JSON',
                  data: $('#form_wizzard').serialize(),
                })
                .done(function(response) {
                  if (response.success) {
                    connection.parents('.form-group').removeClass('has-error');
                  } else {
                    connection.parents('.form-group').addClass('has-error');
                  }
                })
                .fail(function() {
                  console.log("error");
                })
                .always(function() {
                  console.log("complete");
                });
              
          }
            connection.keydown(function(event) {
             clearTimeout(timeout);
             timeout = setTimeout(checkConnection, 1000);
           });
        });
        </script>