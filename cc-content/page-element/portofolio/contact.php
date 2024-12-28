<cc-element cc-id="style">
    <link data-src="stylesheet-bootstrap" href="{base_element}package/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link data-src="stylesheet-freelancer" href="{base_element}package/css/freelancer.min.css" rel="stylesheet">
    <link data-src="stylesheet-font-awesome" href="{base_element}package/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link data-src="stylesheet-bootstrap" href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link data-src="stylesheet-bootstrap" href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">
</cc-element>

<cc-element cc-id="content">
     <section id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Contact Me</h2>
                    <hr class="star-primary">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <div class="form-builder">{form_builder(replace_with_id)}</div>
                </div>
            </div>
        </div>
    </section>
</cc-element>


<cc-element cc-id="script" cc-placement="top">
    <script src="{base_element}package/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="{base_element}package/js/jqBootstrapValidation.js"></script>
    <script src="{base_element}package/js/contact_me.js"></script>
    <script src="{base_element}package/js/freelancer.min.js"></script>
    <script type="text/javascript">
    </script>
</cc-element>