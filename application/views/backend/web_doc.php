

<link rel="alternate" type="application/rss+xml" title="frittt.com" href="feed/index.html">
<link href="http://fonts.googleapis.com/css?family=Raleway:700,300" rel="stylesheet"
   type="text/css">
<link rel="stylesheet" href="<?= BASE_ASSET; ?>web-doc/css/style.css">
<link rel="stylesheet" href="<?= BASE_ASSET; ?>web-doc/css/prettify.css">
<link rel="stylesheet" href="<?= BASE_ASSET; ?>prism/prism.css">
<style type="text/css">
</style>
<script type="text/javascript" src="<?= BASE_ASSET; ?>prism/prism.js"></script>

<script type="text/javascript">
   $(document).ready(function() {
       $(".doc-content a").click(function() {
           var to = $(this).attr('href');
           $('html, body').animate({
               scrollTop: $(to).offset().top 
           }, 500);
       });
   });
</script>
<div class="wrapper">
   <header class="doc-header">
      <div class="container">
         <h2 class="lone-header">Cicool WEB Documentation V-1.18</h2>
      </div>
   </header>
   <section class="doc-content">
      <div class="container">
         <ul class="docs-nav">
            <li><strong>Getting Started</strong></li>
            <li><a href="#welcome" class="cc-active">Welcome</a></li>
            <li><a href="#features" class="cc-active">Features</a></li>
            <li class="separator"></li>
            <li><strong>Installation</strong></li>
            <li><a href="#requirement" class="cc-active">Requirement</a></li>
            <li><a href="#installation" class="cc-active">Installation</a></li>
            <li class="separator"></li>
            <li><strong>CRUD Builder</strong></li>
            <li><a href="#how_to_build_a_crud" class="cc-active">How to build a CRUD</a></li>
            <li><a href="#tutorial_make_blog_with_crud_builder" class="cc-active">Video tutorial how to make a blog with crud builder</a></li>

            <li class="separator"></li>
            <li><strong>REST Builder</strong></li>
            <li><a href="#how_to_build_a_rest" class="cc-active">How to build a REST</a></li>
            <li><a href="#video_tutorial_make_rest_api" class="cc-active">Video tutorial how to make blog rest api with Rest API builder</a></li>
            <li><a href="#how_to_get_a_token" class="cc-active">How to Get a Token</a></li>
            <li class="separator"></li>
            <li><strong>Page Builder</strong></li>
            <li><a href="#how_to_build_a_page" class="cc-active">How to build a Page</a></li>
            <li><a href="#tutorial_make_page_with_page_builder" class="cc-active">Video tutorial how to make responsive page with page builder</a></li>
            <li><a href="#how_to_embed_form_in_page" class="cc-active">How to embed form on the page</a></li>
            <li><a href="#tutorial_how_to_embed_form_on_page" class="cc-active">Video tutorial how toembed contact form on page builder</a></li>
            <li class="separator"></li>
            <li><strong>Form Builder</strong></li>
            <li><a href="#how_to_build_a_form" class="cc-active">How to build a Form</a></li>
            <li><a href="#tutorial_how_to_make_form" class="cc-active">Video tutorial how to make contact form with form builder</a></li>

            <li><a href="#manage_your_form" class="cc-active">Manage Your Form</a></li>
            <li><a href="#updating_your_form" class="cc-active">Updating Your Form</a></li>
            <li class="separator"></li>
            <li><strong>Library</strong></li>
            <li><a href="#template" class="cc-active">Template</a></li>
            <li><a href="#auth" class="cc-active">Auth</a></li>
            <li><a href="#cc_app" class="cc-active">Cicool App</a></li>
            <li class="separator"></li>
            <li><strong>Helper</strong></li>
            <li><a href="#app_helper" class="cc-active">App helper</a></li>
         </ul>
         <div class="docs-content">
            <h2> Getting Started</h2>
            <h3 id="welcome"> Welcome</h3>
            <p> Cicool is a multifunctional application that is used to facilitate your work in creating a system, CMS, E-Comerce and others</p>
            <h3 id="features"> Features</h3>
            <ul>
               <li>Facility to customize to match your website theme</li>
               <li>Easy install; 100% integration with wizzard installation</li>
               <li>Frontend modular, easy to change theme</li>
               <li>There extension to make easy to custom, add feature etc</li>
               <li>Make Rest API builder just one click, and get auto generate documentation.</li>
               <li>You can make dinamic pages by dragging, more than <b>50+</b> components and elements avaiable.</li>
               <li>By dragging form into canvas you can make dinamic form.</li>
               <li>Build your CRUD in one click, with <b>35+</b> custom validation and 20+ input type.</li>
               <li>Awesome AdminLTE theme by Abdullah Almsaeed.</li>
            </ul>
            <hr>
            <h3 id="requirement"> Requirement</h3>
            <p> System requirements for running this web application</p>
            <ul>
               <li>PHP 5.5 or higher</li>
               <li>Mysql Server 4.1.13 or higher</li>
               <li>Apache / Nginx </li>
               <li>Mysqli extension</li>
               <li>Session Extension</li>
               <li>mcrypt  Extension</li>
            </ul>
            <h3 id="installation"> Installation</h3>
            <p> easy to install with the installation wizard, just by clicking the Next button and you are asked to fill in the configuration</p>
            <ul>
               <li>Wizzard Page One</li>
            </ul>
            <p> on pages one, there is a demand server that you must meet to perform the installation, such as Directory and Permissions and Server Requirements.</p>
            <ul>
               <li>Wizzard page two</li>
            </ul>
            <p> in the second page you are requested to fill in the configuration of the system, there are default configurations that have been made, if you do not want hired him press the next button to proceed to the third page wizzard</p>
            <ul>
               <li>Wizzard Page Theree</li>
            </ul>
            <p>wizzard this last step to configure your system, you are asked to configure the database that you created on the server, we recommend no table system that has been created in the database</p>
            <p> in the second section of this part of the site configuration, you are asked to fill in the site name, site email and site passwords, email and password is used to access the admin page as administrator</p>
            <p> after installation is complete there is a notification that the application has been successfully installed and ready for use, and then you click the finish button to access the page administrator</p>
            <hr>
            <h2>CRUD Builder</h2>
            <h3 id="how_to_build_a_crud"> How to Build a CRUD</h3>
            <p> Build your CRUD in one click, with 35+ custom validation and 20+ input type, </p>
            <ul>
               <li>Select The Table</li>
            </ul>
            <p> select the table you want to use to create a CRUD</p>
            <ul>
               <li>Fill Subject And Title</li>
            </ul>
            <ul>
               <li>Checked Module</li>
            </ul>
            <p> module select what you want to do, such as create, read and update </p>
            <ul>
               <li>Customize a Contents</li>
            </ul>
            <p> You can do a reorder for field placements. <br>
               You also set the field anywhere that you want to display on a page module. <br>
               There are more than 20 types of input type that you can use. <br>
               There are more than 35 input validation you can use, so that your web applications become more secure.
               <br>Click save button to build your CRUD
            </p>
           
            <h3 id="tutorial_make_blog_with_crud_builder">Video tutorial how to make a blog with crud builder</h3>
            <iframe width="100%" height="350" src="https://www.youtube.com/embed/fQJZSgLCz04" frameborder="0" allowfullscreen></iframe>
            <hr>
            <h2>REST Builder</h2>
            <h3 id="how_to_build_a_rest"> How to Build a REST</h3>
            <p> Make Rest API builder just one click, and get auto generate documentation, </p>
            <ul>
               <li>Select The Table</li>
            </ul>
            <p> select the table you want to use to create a CRUD</p>
            <ul>
               <li>Fill Subject And Title</li>
            </ul>
            <ul>
               <li>Header Required</li>
            </ul>
            <p> In no demand for the required header in select X-Token, Reviews
               X-Token is used for your API securing with user Auth.
               if you access these APIs, then you must get a <a href="#how_to_get_a_token">token</a>
            </p>
            <ul>
               <li>Customize a Contents</li>
            </ul>
            <p>
               There are two input type text or file. <br>
               There are more than 35 input validation you can use, so that your web applications become more secure.
               <br>Click save button to build your REST APIs
            </p>
            <h3 id="video_tutorial_make_rest_api">Video tutorial how to make blog Rest API</h3>
            <p>
               <iframe width="100%" height="350" src="https://www.youtube.com/embed/PI07LbPwEds" frameborder="0" allowfullscreen></iframe>
            </p>
            <ul>
               <li>View Your Rest Module</li>
            </ul>
            <p>
               After you create a REST API you can directly view  the documentation that automatically created <a href="<?= site_url('doc/api'); ?>">See API Documentations</a>.
               <br>
               you can also do your API testing with the click of a button view on REST builder.
            </p>
            <h3 id="how_to_get_a_token">
               How to Get X-Token
            </h3>
            <p>
               to get tokens you can see more at documentation,  <a href="<?= site_url('doc/api'); ?>">See API Documentations</a>.
               <br>
               or you can visit <a href="<?= site_url('rest/tool/get-token'); ?>">this link</a> there you can get a token directly by following the instructions provided.
            </p>
            <ul id="token_is_generated">
               <li>Token is generated</li>
            </ul>
            <p>
               After you successfully generate the token then there is a JSON response like this you get.
               <br>
            </p>
            <pre data-codetype="json response"><code class="language-css">{
    "status": true,
    "message": "Token generated",
    "data": {
        "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9..more",
        "expiration": {
            "seconds": 43200,
            "hours": 12
        }
    }
}</code></pre>
            <p>
               if you get a response like that then you've managed to get tokens
            </p>
            <hr>
            <h2>Page Builder</h2>
            <h3 id="how_to_build_a_page">How To Build A Page</h3>
            <p>You can make dinamic pages by dragging, more than <b>50+</b> components and elements avaiable.</p>
            <ul id="token_is_generated">
               <li>Build a Administrator Page</li>
            </ul>
            <p>
               To create a page you select the type of page to <b>backend</b>.<br>
               enter the link to the user can access your page, <br>
               Your administrator can access the page that you created in <b><?= base_url(); ?>page/<b class="text-danger">(your-page-link)</b></b>
               <br>
            <ul id="token_is_generated">
               <li>Build a Administrator Page</li>
            </ul>
            <ul id="token_is_generated">
               <li>Build a Frontend Page</li>
            </ul>
            <p>
               To create a page you select the type of page to <b>frontend</b>.<br>
               enter the link to the user can access your page, <br>
               Your can access frontend page that you created in <b><?= base_url(); ?>page/<b class="text-danger">(your-page-link)</b></b>
               <br>
            <hr>
            <h3 id="tutorial_make_page_with_page_builder">Video tutorial how to make responsive page</h3>
            <p>
               <iframe width="100%" height="350" src="https://www.youtube.com/embed/O9-vFtFciEM" frameborder="0" allowfullscreen></iframe>
            </p>
            <hr>
            <h3 id="how_to_embed_form_in_page">How To Embed Form on The Page</h3>
            <p>you can mengembed form, which you made into a section page builder, by attaching a code snippet as follows : <b>{form_builder(<b class="text-danger">1</b>)}</b>.<br>
               * <b class="text-danger">1</b> is a id of form 
            </p>
            <hr>
            <h3 id="how_to_embed_form_in_page">How to embed contact form on page</h3>
            <p>
               <iframe width="100%" height="350" src="https://www.youtube.com/embed/OoK8XeHcErc" frameborder="0" allowfullscreen></iframe>
            </p>
            <h2>Form Builder</h2>
            <h3 id="how_to_build_a_form">How To Build A Form</h3>
            <p>By dragging form into canvas you can make dinamic form.</p>
            <ul>
               <li>Fill Subject And Title</li>
            </ul>
            <p>Subject used as a form of identity, when men generate form will automatically create a table with formatting form_(subject form).
            <ul>
               <li>Creating Form Field</li>
            </ul>
            to create a form, you can drag the input type to the canvas form, there are more than <b> 20 </b> field type.<br>
            You can also change the field name, field style, custom attributes, and other helpblock
            </p>
            <hr>
            <h3 id="tutorial_how_to_make_form">Video tutorial how to make contact form</h3>
            <p>
               <iframe width="100%" height="350" src="https://www.youtube.com/embed/7nQwLjpOtnE" frameborder="0" allowfullscreen></iframe>
            </p>
            <h3 id="manage_your_form">Manage Your Form</h3>
            <p>
               Once you've finished creating your form can me manage the form that you created, to manage the information that has been submitted
            </p>
            <h3 id="updating_your_form">Updating a Form</h3>
            <p>
               You can also update the fields of the form, the form builder in the menu update, but the data form that you created earlier will be automatically deleted
            </p>
            <hr>
            <h2>Library</h2>
            <h3 id="template">Template</h3>
            <p>Library for creating a partial template for web.</p>
            <ul>
               <li>Set data using a chainable metod. Provide two strings or an array of data.</li>
            </ul>
            <p>
            <pre data-codetype="json response"><code class="language-php"> $this->template->set($name, $value)</code></pre>
            </p>
            <ul>
               <li>
                  Parameters
                  <ul>
                     <li><b>$name</b> String - name of data key</li>
                     <li><b>$value</b> String - value of variable</li>
                  </ul>
               </li>
            </ul>
            <!-- section -->
            <hr>
            <ul>
               <li>Build the entire HTML output combining partials, layouts and views.</li>
            </ul>
            <p>
            <pre data-codetype="json response"><code class="language-php"> $this->template->build($view, $data = array(), $return = false)</code></pre>
            </p>
            <ul>
               <li>
                  Parameters
                  <ul>
                     <li><b>$view</b> String - view name</li>
                     <li><b>$data</b> Array - Data to view  </li>
                     <li><b>$return</b> Boolean - if true output stored in variable </li>
                  </ul>
               </li>
            </ul>
            <!-- section -->
            <hr>
            <ul>
               <li>Set the title of the page.</li>
            </ul>
            <p>
            <pre data-codetype="json response"><code class="language-php"> $this->template->set_partial($name, $view, $data = array())</code></pre>
            </p>
            <ul>
               <li>
                  Parameters
                  <ul>
                     <li><b>$name</b> String - name variable of partial</li>
                     <li><b>$view</b> Array - View name  </li>
                     <li><b>$data</b> array - Data to view </li>
                  </ul>
               </li>
            </ul>
            <!-- section -->
            <hr>
            <ul>
               <li>Set the title of the page.</li>
            </ul>
            <p>
            <pre data-codetype="json response"><code class="language-php"> $this->template->title($title)</code></pre>
            </p>
            <ul>
               <li>
                  Parameters
                  <ul>
                     <li><b>$title</b> String - the title of web</li>
                  </ul>
               </li>
            </ul>
            <!-- library auth -->
            <hr>
            <h3 id="auth">Auth</h3>
            <!-- section -->
            <ul>
               <li>Check provided details against the database. Add items to error array on fail, create session if success.</li>
            </ul>
            <p>
            <pre data-codetype="json response"><code class="language-php"> $this->aauth->login($identifier, $pass, $remember = false, $totp_code = NULL, $set_userdata = true)</code></pre>
            </p>
            <ul>
               <li>
                  Parameters
                  <ul>
                     <li><b>$identifier</b> String - the indentifier of user (email or username)</li>
                     <li><b>$pass</b> String - the password of user</li>
                     <li><b>$remember</b> Boolean - session save is remember <b class="text-danger">true</b> or <b class="text-danger">false</b></li>
                     <li><b>$totp_code</b> String - totp code veryfication</li>
                     <li><b>$set_userdata</b> Boolean - save the session to userdata <b class="text-danger">true</b> or <b class="text-danger">false</b></li>
                  </ul>
               <li>
                  Response
                  <ul>
                     <li>Boolean <b class="text-danger">true</b> or <b class="text-danger">false</b></li>
                  </ul>
               </li>
               </li>
            </ul>
            <hr>
            <!-- section -->
            <ul>
               <li>Updates permission name and description.</li>
            </ul>
            <p>
            <pre data-codetype="json response"><code class="language-php"> $this->aauth->update_perm($perm_par, $perm_name = false, $definition = false)</code></pre>
            </p>
            <ul>
               <li>
                  Parameters
                  <ul>
                     <li><b>$perm_par</b> Int | String - Permission id or permission name</li>
                     <li><b>$perm_name</b> String - New permission name</li>
                     <li><b>$definition</b> String - Permission description</li>
                  </ul>
               <li>
                  Response
                  <ul>
                     <li>Boolean <b class="text-danger">true</b> or <b class="text-danger">false</b></li>
                  </ul>
               </li>
               </li>
            </ul>
            <hr>
            <!-- section -->
            <ul>
               <li>Delete a permission from database. WARNING Can't be undone.</li>
            </ul>
            <p>
            <pre data-codetype="json response"><code class="language-php"> $this->aauth->delete_perm($perm_par, $perm_name = false, $definition = false)</code></pre>
            </p>
            <ul>
               <li>
                  Parameters
                  <ul>
                     <li><b>$perm_par</b> Int | String - Permission id or permission name</li>
                  </ul>
               <li>
                  Response
                  <ul>
                     <li>Boolean <b class="text-danger">true</b> or <b class="text-danger">false</b></li>
                  </ul>
               </li>
               </li>
            </ul>
            <hr>
            <!-- section -->
            <ul>
               <li>Check if user allowed to do specified action, admin always allowed.</li>
            </ul>
            <p>
            <pre data-codetype="json response"><code class="language-php"> $this->aauth->is_allowed($perm_par, $user_id = false)</code></pre>
            </p>
            <ul>
               <li>
                  Parameters
                  <ul>
                     <li><b>$perm_par</b> Int | String - Permission id or permission name</li>
                     <li><b>$user_id</b> Int | Boolean - User id to check, or if FALSE checks current user</li>
                  </ul>
               <li>
                  Response
                  <ul>
                     <li>Boolean <b class="text-danger">true</b> or <b class="text-danger">false</b></li>
                  </ul>
               </li>
               </li>
            </ul>
            <hr>
            <!-- section -->
            <ul>
               <li>Check if group is allowed to do specified action, admin always allowed.</li>
            </ul>
            <p>
            <pre data-codetype="json response"><code class="language-php"> $this->aauth->is_group_allowed($perm_par, $group_par = false)</code></pre>
            </p>
            <ul>
               <li>
                  Parameters
                  <ul>
                     <li><b>$perm_par</b> Int | String - Permission id or permission name</li>
                     <li><b>$group_par</b> Int | Boolean - Group id or name to check, or if FALSE checks all user groups</li>
                  </ul>
               <li>
                  Response
                  <ul>
                     <li>Boolean <b class="text-danger">true</b> or <b class="text-danger">false</b></li>
                  </ul>
               </li>
               </li>
            </ul>
            <hr>
            <!-- section -->
            <ul>
               <li>Add User to permission.</li>
            </ul>
            <p>
            <pre data-codetype="json response"><code class="language-php"> $this->aauth->allow_user($user_id, $perm_par)</code></pre>
            </p>
            <ul>
               <li>
                  Parameters
                  <ul>
                     <li><b>$perm_par</b> Int - User id to deny</li>
                     <li><b>$perm_par</b> Int - Permission id or name to allow</li>
                  </ul>
               <li>
                  Response
                  <ul>
                     <li>Boolean <b class="text-danger">true</b> or <b class="text-danger">false</b></li>
                  </ul>
               </li>
               </li>
            </ul>
            <hr>
            <!-- section -->
            <ul>
               <li>Remove user from permission.</li>
            </ul>
            <p>
            <pre data-codetype="json response"><code class="language-php"> $this->aauth->deny_user($user_id, $perm_par)</code></pre>
            </p>
            <ul>
               <li>
                  Parameters
                  <ul>
                     <li><b>$user_id</b> Int - User id to deny</li>
                     <li><b>$perm_par</b> Int - Permission id or name to allow</li>
                  </ul>
               <li>
                  Response
                  <ul>
                     <li>Boolean <b class="text-danger">true</b> or <b class="text-danger">false</b></li>
                  </ul>
               </li>
               </li>
            </ul>
            <hr>
            <!-- section -->
            <ul>
               <li>Add group to permission.</li>
            </ul>
            <p>
            <pre data-codetype="json response"><code class="language-php"> $this->aauth->allow_group($group_par, $perm_par)</code></pre>
            </p>
            <ul>
               <li>
                  Parameters
                  <ul>
                     <li><b>$group_par</b> int | string | boolean -  Group id or name to allow</li>
                     <li><b>$perm_par</b> Int - Permission id or name to allow</li>
                  </ul>
               <li>
                  Response
                  <ul>
                     <li>Boolean <b class="text-danger">true</b> or <b class="text-danger">false</b></li>
                  </ul>
               </li>
               </li>
            </ul>
            <hr>
            <!-- section -->
            <ul>
               <li>Remove group from permission.</li>
            </ul>
            <p>
            <pre data-codetype="json response"><code class="language-php"> $this->aauth->deny_group($group_par, $perm_par)</code></pre>
            </p>
            <ul>
               <li>
                  Parameters
                  <ul>
                     <li><b>$group_par</b> int | string | boolean -  Group id or name to allow</li>
                     <li><b>$perm_par</b> Int - Permission id or name to allow</li>
                  </ul>
               <li>
                  Response
                  <ul>
                     <li>Boolean <b class="text-danger">true</b> or <b class="text-danger">false</b></li>
                  </ul>
               </li>
               </li>
            </ul>
            <hr>
            <!-- section -->
            <ul>
               <li>List all permissions.</li>
            </ul>
            <p>
            <pre data-codetype="json response"><code class="language-php"> $this->aauth->list_perms()</code></pre>
            </p>
            <ul>
               <li>
                  Response
                  <ul>
                     <li>Array object</li>
                  </ul>
               </li>
            </ul>
            <hr>
            <!-- section -->
            <ul>
               <li>Get permission id from permisison name or id.</li>
            </ul>
            <p>
            <pre data-codetype="json response"><code class="language-php"> $this->aauth->get_perm_id($perm_par)</code></pre>
            </p>
            <ul>
               <li>
                  Parameters
                  <ul>
                     <li><b>$perm_par</b> Int - Permission id or name to allow</li>
                  </ul>
               <li>
                  Response
                  <ul>
                     <li>int Permission id or NULL if perm does not exist</li>
                  </ul>
               </li>
               </li>
            </ul>
            <!-- library auth -->
            <hr>
            <h3 id="cc_app">Cc App</h3>
            <!-- section -->
            <ul>
               <li>Librarry for cicool app.</li>
            </ul>
            <p>
            <pre data-codetype="json response"><code class="language-php"> $this->cc_app->getOption($option_name, $default = null)</code></pre>
            </p>
            <ul>
               <li>
                  Parameters
                  <ul>
                     <li><b>$option_name</b> String - option name</li>
                     <li><b>$default</b> String - default option value if option nt exist on the database</li>
                  </ul>
               <li>
                  Response
                  <ul>
                     <li>String - Option Value</li>
                  </ul>
               </li>
               </li>
            </ul>
            <!-- section -->
            <hr>
            <ul>
               <li>Set option value.</li>
            </ul>
            <p>
            <pre data-codetype="json response"><code class="language-php"> $this->cc_app->setOption($option_name =  null, $option_value = null)</code></pre>
            </p>
            <ul>
               <li>
                  Parameters
                  <ul>
                     <li><b>$option_name</b> String - option name</li>
                     <li><b>$option_value</b> String - value of option you add</li>
                  </ul>
               <li>
                  Response
                  <ul>
                     <li>Boolean - Option Value <b class="text-danger">true</b> or <b class="text-danger">false</b></li>
                  </ul>
               </li>
               </li>
            </ul>
            <!-- section -->
            <hr>
            <ul>
               <li>Delete option from database.</li>
            </ul>
            <p>
            <pre data-codetype="json response"><code class="language-php"> $this->cc_app->deleteOption($option_name =  null)</code></pre>
            </p>
            <ul>
               <li>
                  Parameters
                  <ul>
                     <li><b>$option_name</b> String - option name</li>
                  </ul>
               <li>
                  Response
                  <ul>
                     <li>Boolean - Option Value <b class="text-danger">true</b> or <b class="text-danger">false</b></li>
                  </ul>
               </li>
               </li>
            </ul>
            <!-- section -->
            <hr>
            <ul>
               <li>check whether the option is there or not.</li>
            </ul>
            <p>
            <pre data-codetype="json response"><code class="language-php"> $this->cc_app->optionExists($option_name =  null)</code></pre>
            </p>
            <ul>
               <li>
                  Parameters
                  <ul>
                     <li><b>$option_name</b> String - option name</li>
                  </ul>
               <li>
                  Response
                  <ul>
                     <li>Boolean - Option Value <b class="text-danger">true</b> or <b class="text-danger">false</b></li>
                  </ul>
               </li>
               </li>
            </ul>
            <!-- section -->
            <hr>
            <ul>
               <li>Hook for listen a atatement in a section.</li>
            </ul>
            <p>
            <pre data-codetype="json response"><code class="language-php"> $this->cc_app->eventListen($eventName = null, $params = [])</code></pre>
            </p>
            <ul>
               <li>
                  Parameters
                  <ul>
                     <li><b>$eventName</b> String - the event name uniq to in the call in a particular section</li>
                  </ul>
               <li>
                  Response
                  <ul>
                     <li>Mixed Closure | String</li>
                  </ul>
               </li>
               </li>
            </ul>
            <!-- section -->
            <hr>
            <ul>
               <li>Get event header returned html of header section frontend.</li>
            </ul>
            <p>
            <pre data-codetype="json response"><code class="language-php"> $this->cc_app->getHeader()</code></pre>
            </p>
            <ul>
               <li>
                  Response
                  <ul>
                     <li>Mixed Closure | String</li>
                  </ul>
               </li>
            </ul>
            <!-- section -->
            <hr>
            <ul>
               <li>Get event footer returned html of footer section frontend.</li>
            </ul>
            <p>
            <pre data-codetype="json response"><code class="language-php"> $this->cc_app->getFooter()</code></pre>
            </p>
            <ul>
               <li>
                  Response
                  <ul>
                     <li>Mixed Closure | String</li>
                  </ul>
               </li>
            </ul>
            <!-- section -->
            <hr>
            <ul>
               <li>Get event navigation returned html of navigation section frontend.</li>
            </ul>
            <p>
            <pre data-codetype="json response"><code class="language-php"> $this->cc_app->getNavigation()</code></pre>
            </p>
            <ul>
               <li>
                  Response
                  <ul>
                     <li>Mixed Closure | String</li>
                  </ul>
               </li>
            </ul>
            <hr>
            <h2>Helper</h2>
            <h3 id="app_helper">App Helper</h3>
            <p>Redirecting to $_SERVER['HTTP_REFERER'].</p>
            <ul>
               <li>Redirecting page to http_referer.</li>
            </ul>
            <p>
            <pre data-codetype="json response"><code class="language-php"> redirect_back()</code></pre>
            </p>
            <ul>
               <li>
                  Response
                  <ul>
                     <li>Header</li>
                  </ul>
               </li>
            </ul>
            <hr>
            <p>Get information of user loggedin.</p>
            <ul>
               <li>Set data using a chainable metod. Provide two strings or an array of data.</li>
            </ul>
            <p>
            <pre data-codetype="json response"><code class="language-php"> get_user_data($field_name)</code></pre>
            </p>
            <ul>
               <li>
                  Parameters
                  <ul>
                     <li><b>$field_name</b> String - field name provided in the user database</li>
                  </ul>
               </li>
               <li>
                  Response
                  <ul>
                     <li>String - data information of user</li>
                  </ul>
               </li>
            </ul>
            <hr>
            <ul>
               <li>Generate a captcha.</li>
            </ul>
            <p>
            <pre data-codetype="json response"><code class="language-php"> get_captcha()</code></pre>
            </p>
            <ul>
               <li>
                  Response
                  <ul>
                     <li>array - data information of captcha</li>
                  </ul>
               </li>
            </ul>
            <hr>
            <ul>
               <li>Get the url extension.</li>
            </ul>
            <p>
            <pre data-codetype="json response"><code class="language-php"> url_extension($ext = null)</code></pre>
            </p>
            <ul>
               <li>
                  Parameters
                  <ul>
                     <li><b>$ext</b> String - the extension name default is null</li>
                  </ul>
               </li>
               <li>
                  Response
                  <ul>
                     <li>String - base url extension ex : <?= url_extension(); ?><b class="text-danger">my-extension</b></li>
                  </ul>
               </li>
            </ul>
            <hr>
            <ul>
               <li>Get option.</li>
            </ul>
            <p>
            <pre data-codetype="json response"><code class="language-php"> get_option($ext = null)</code></pre>
            </p>
            <ul>
               <li>
                  Parameters
                  <ul>
                     <li><b>$ext</b> String - the extension name default is null</li>
                  </ul>
               </li>
               <li>
                  Response
                  <ul>
                     <li>String - base url extension ex : <?= url_extension(); ?><b class="text-danger">my-extension</b></li>
                  </ul>
               </li>
            </ul>
            <hr>
            <ul>
               <li>Get option.</li>
            </ul>
            <p>
            <pre data-codetype="json response"><code class="language-php"> add_option($option_name = null, $option_value = null) </code></pre>
            </p>
            <ul>
               <li>
                  Parameters
                  <ul>
                     <li><b>$option_name</b> String - option name</li>
                     <li><b>$option_value</b> String - value of option you add</li>
                  </ul>
               <li>
                  Response
                  <ul>
                     <li>Boolean - Option Value <b class="text-danger">true</b> or <b class="text-danger">false</b></li>
                  </ul>
               </li>
               </li>
            </ul>
            <hr>
            <ul>
               <li>Set option.</li>
            </ul>
            <p>
            <pre data-codetype="json response"><code class="language-php"> set_option($option_name = null, $option_value = null) </code></pre>
            </p>
            <ul>
               <li>
                  Parameters
                  <ul>
                     <li><b>$option_name</b> String - option name</li>
                     <li><b>$option_value</b> String - value of option you add</li>
                  </ul>
               <li>
                  Response
                  <ul>
                     <li>Boolean - Option Value <b class="text-danger">true</b> or <b class="text-danger">false</b></li>
                  </ul>
               </li>
               </li>
            </ul>
            <hr>
            <ul>
               <li>Delete option from database.</li>
            </ul>
            <p>
            <pre data-codetype="json response"><code class="language-php"> delete_option($option_name = null) </code></pre>
            </p>
            <ul>
               <li>
                  Parameters
                  <ul>
                     <li><b>$option_name</b> String - option name</li>
                  </ul>
               <li>
                  Response
                  <ul>
                     <li>Boolean- <b class="text-danger">true</b> or <b class="text-danger">false</b></li>
                  </ul>
               </li>
               </li>
            </ul>
            <hr>
            <ul>
               <li>check whether the option is there or not.</li>
            </ul>
            <p>
            <pre data-codetype="json response"><code class="language-php"> option_exists($option_name = null) </code></pre>
            </p>
            <ul>
               <li>
                  Parameters
                  <ul>
                     <li><b>$option_name</b> String - option name</li>
                  </ul>
               <li>
                  Response
                  <ul>
                     <li>Boolean - Option Value <b class="text-danger">true</b> or <b class="text-danger">false</b></li>
                  </ul>
               </li>
               </li>
            </ul>
            <hr>
            <ul>
               <li>Get base theme url, theme is active.</li>
            </ul>
            <p>
            <pre data-codetype="json response"><code class="language-php"> theme_url($url_additional = null) </code></pre>
            </p>
            <ul>
               <li>
                  Parameters
                  <ul>
                     <li><b>$url_additional</b> String - url additional</li>
                  </ul>
               <li>
                  Response
                  <ul>
                     <li>String - base url of theme : <?= theme_url(); ?></li>
                  </ul>
               </li>
               </li>
            </ul>
            <hr>
            <ul>
               <li>Get site name information.</li>
            </ul>
            <p>
            <pre data-codetype="json response"><code class="language-php"> site_name() </code></pre>
            </p>
            <ul>
               <li>
                  Response
                  <ul>
                     <li>String - the site name : <?= site_name(); ?></li>
                  </ul>
               </li>
            </ul>
            <hr>
            <ul>
               <li>Get menu type contains.</li>
            </ul>
            <p>
            <pre data-codetype="json response"><code class="language-php"> get_menu($menu_type = null) </code></pre>
            </p>
            <ul>
               <li>
                  Parameters
                  <ul>
                     <li><b>$menu_type</b> String - Menu type name</li>
                  </ul>
               <li>
                  Response
                  <ul>
                     <li>Array </li>
                  </ul>
               </li>
               </li>
            </ul>
            <pre data-codetype="json response"><code class="language-php"><?php print_r(get_menu('top-menu')); ?></code></pre>
            <hr>
            <ul>
               <li>Get header frontend active theme.</li>
            </ul>
            <p>
            <pre data-codetype="json response"><code class="language-php"> get_header() </code></pre>
            </p>
            <ul>
               <li>
                  Response
                  <ul>
                     <li>String - html header partial </li>
                  </ul>
               </li>
            </ul>
            <hr>
            <ul>
               <li>Get footer frontend active theme.</li>
            </ul>
            <p>
            <pre data-codetype="json response"><code class="language-php"> get_footer() </code></pre>
            </p>
            <ul>
               <li>
                  Response
                  <ul>
                     <li>String - html footer partial </li>
                  </ul>
               </li>
            </ul>
            <hr>
            <ul>
               <li>Get navigation frontend active theme.</li>
            </ul>
            <p>
            <pre data-codetype="json response"><code class="language-php"> get_navigation() </code></pre>
            </p>
            <ul>
               <li>
                  Response
                  <ul>
                     <li>String - html navigation partial </li>
                  </ul>
               </li>
            </ul>
         </div>
      </div>
   </section>
</div>
<script src="https://google-code-prettify.googlecode.com/svn/loader/run_prettify.js?lang=css&skin=sunburst"></script>
<script src="<?= BASE_ASSET; ?>web-doc/js/layout.js"></script>
<script type="text/javascript">
   $(document).ready(function(){
     $('.web-body').addClass('sidebar-collapse');
   })
</script>

