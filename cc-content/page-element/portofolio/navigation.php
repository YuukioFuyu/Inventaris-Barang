<cc-element cc-id="style">
    <link data-src="stylesheet-bootstrap" href="{base_element}package/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link data-src="stylesheet-freelancer" href="{base_element}package/css/freelancer.min.css" rel="stylesheet">
    <link data-src="stylesheet-font-awesome" href="{base_element}package/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link data-src="stylesheet-bootstrap" href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link data-src="stylesheet-bootstrap" href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">
</cc-element>

<cc-element cc-id="content">
  <div class="wrapper">
        <div class="container">
            <nav role="navigation" class="navbar navbar-inverse navbar-embossed navbar-lg">
                <div class="container">
                    <div class="navbar-header">
                        <button data-target="#navbar-collapse-02" data-toggle="collapse" class="navbar-toggle" type="button">
                            <span class="sr-only">Toggle navigation</span>
                        </button>
                        <a href="#" class="navbar-brand brand"> Cicool Builder</a>
                    </div>
                    <div id="navbar-collapse-02" class="collapse navbar-collapse">
                        <ul class="nav navbar-nav">
                            <li class="active propClone"><a href="#">Home</a>
                            </li>
                            <li class="propClone"><a href="#">Work</a>
                            </li>
                            <li class="propClone"><a href="#">Blog</a>
                            </li>
                            <li class="propClone"><a href="#">Contact</a>
                            </li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li class="propClone">
                                <a href="#">Login <span class="fa fa-lock"></span></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <div class="row banner">
               
            </div>
        </div>
    </div>
</cc-element>

<cc-element cc-id="script" cc-placement="top">
   
</cc-element>


<cc-element cc-id="script" cc-placement="top">
    <script src="{base_element}package/vendor/bootstrap/js/bootstrap.min.js"></script>
</cc-element>

<cc-element cc-id="script" cc-placement="bottom">
    <script type="text/javascript">
        $(document).ready(function(){
            $('.navbar').addClass('navbar-fixed-top');
        })
    </script>
</cc-element>

